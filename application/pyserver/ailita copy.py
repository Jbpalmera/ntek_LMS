import json
import re
from typing import Union
from dotenv import load_dotenv
from langchain.chains import RetrievalQA
from langchain_community.llms.ollama import Ollama
from langchain_community.chat_models.ollama import ChatOllama
from langchain_community.embeddings import OllamaEmbeddings
from langchain_openai import OpenAIEmbeddings
from langchain.memory import ConversationBufferMemory
from langchain.memory import SQLChatMessageHistory
from langchain_community.vectorstores import Chroma
from langchain.callbacks.streaming_stdout import StreamingStdOutCallbackHandler
from langchain_openai import ChatOpenAI
from langchain.agents import (
    Tool, create_react_agent, AgentExecutor, AgentOutputParser)
from langchain import hub
from langchain.tools.retriever import create_retriever_tool
from langchain_community.utilities import SQLDatabase
from langchain_experimental.sql import SQLDatabaseChain
from langchain.prompts import PromptTemplate, ChatPromptTemplate
from datetime import date
from langchain_core.agents import AgentAction, AgentFinish
from langchain_core.prompts import FewShotChatMessagePromptTemplate
from langchain_groq import ChatGroq


if __name__ == '__main__':
    #LOAD .ENV FILE
    load_dotenv()

    # EMBEDDING MODEL AND FUNCTION TO RETRIEVE DOCUMENTS INFORMATION FROM VECTOR DB
    book_collection = 'books_collection'
    library_guidelines = 'library_guidelines'
    embedding = OllamaEmbeddings(
        base_url="http://192.168.1.103:11434",
        model="nomic-embed-text"
    )
    # embedding = OpenAIEmbeddings()

    #EMBEDDED PERSISTING VECTOR OF LIBRARY GUIDELINES
    library_guidelines_vector = Chroma(persist_directory=library_guidelines, 
                    embedding_function=embedding)
    
    books_collection_vector = Chroma(persist_directory=book_collection,
                                    embedding_function=embedding)


    llm = ChatGroq(
        temperature=0.2, 
        model_name="llama3-8b-8192"
    )
    #LLM
    # llm = ChatOpenAI(
    #     temperature=0,
    #     streaming = True, callbacks = [StreamingStdOutCallbackHandler()]
    # )

    # llm = ChatOllama(base_url="http://43.203.211.242/ollama",
    #             model="llama3",
    #             temperature=0,
    #             streaming = True, callbacks = [StreamingStdOutCallbackHandler()])

    # llm = ChatOpenAI(
    # api_key="ollama",
    # model="llama3:8b-instruct-fp16",
    # base_url="http://43.203.211.242/ollama/v1",
    # )

    #RETRIEVAL QA OF LIBRARY GUIDELINE FILE
    # guidelines = RetrievalQA.from_chain_type(
    # llm=llm, chain_type="stuff", retriever=library_guidelines_vector.as_retriever()
    # )

    #SQL DATABASE CONNECTION AND CHAIN
    db = SQLDatabase.from_uri("mysql+mysqlconnector://root:ntek1234@localhost:3306/mlibrary",
                                ignore_tables=['admin', 'tblstudents', 'tbljournal'])
    db_chain = SQLDatabaseChain.from_llm(
        llm, 
        db, 
        verbose=False,
        use_query_checker=True)
        
    
    # SQL Database Chain Tool
    booksDB_Tool = Tool(
        name="Books Collection",
        func=db_chain.run,
        description="Useful for answering questions about the collection of books, authors, issued books, and other related records. No pre-amble when using this tool. Do not put (```sql ```) in your query. Do not explain the code. No pre-amble. and explanation."
    )

    # guidelinesTool = Tool(
    #     name="Library Guidelines QA System",
    #     func=guidelines.run,
    #     description="useful for when you need to answer questions about the library policy, guidelines, use of library, library privileges, borrowing privileges, fees and overall library guideline.",
    # )

    # Library Guidelines Retriever Tool
    guidelinesTool = create_retriever_tool(
        retriever=library_guidelines_vector.as_retriever(),
        name="Library Guidelines",
        description="Useful for answering questions about the library policy, guidelines, use of library, library privileges, borrowing privileges, fees, and overall library guidelines."
    ) 

    books_recommendation_tool = create_retriever_tool(
        retriever=books_collection_vector.as_retriever(),
        name="Books Recommendation",
        description="Useful for answering questions about the recommendation of books and book genres."
    )
    
    #SET DEFINED TOOLS
    tools = [booksDB_Tool, guidelinesTool, books_recommendation_tool]

    # llm_with_tools = llm.bind_tools(tools)

    #DATE TODAY
    today = date.today()

    #USING SQLITE AS CHAT MESSAGE HISTORY AND TODAY'S DATE AS THE SESSION ID AND DB NAME
    message_history = SQLChatMessageHistory(
    session_id=today, connection_string=f"sqlite:///chat_history/{today}")

    #DECLARING THE MEMORY USING CONVERSATION BUFFER MEMORY
    memory = ConversationBufferMemory(
                memory_key="chat_history",
                input_key="input", 
                chat_memory=message_history)

    # prompt = hub.pull("hwchase17/react")
    # prompt = hub.pull("hwchase17/openai-tools-agent")
    
    # PROMPT TEMPLATE FOR AILITA
    template = """Assistant name is Ailita. Ailita is a librarian at the Mindanao State University.
    Be polite and hospitable. If the human greets, greet the human back. If the human ends the conversation, bid a farewell.
    Act and answer as if you are an actual librarian.
    Always refer to the Books Collection tool when answering question about book or author records. Don't give information about books that is not in the database.
    Address all human questions by acknowledging any information gaps respectfully and provide detailed responses based on known information.
    Avoid answering questions unrelated to library or book issues.

    TOOLS:
    ------
    Ailita has access to the following tools:
    {tools}

    To use a tool, please strictly use the following format:

    Thought: Do I need to use a tool? Yes
    Action: [the action to take, should be one of [{tool_names}]]
    Action Input: [the input to the action]
    Observation: [the result of the action]

    If you have a response to say to the human, or if you do not need to use a tool, use the following format:


    Thought: Do I need to use a tool? No
    Final Answer: [your response here]

    Begin!

    Previous conversation history:
    {chat_history}

    New input: {input}
    {agent_scratchpad}
    """

    #SET THE CUSTOM PROMPT TEMPLATE OF AILITA
    prompt = PromptTemplate(input_variables=["chat_history", "input"], 
                            template=template)


    #INITIALIZE THE AGENT WITH THE LLM, TOOL, AND THE PROMPT
    agent = create_react_agent(llm, 
                            tools, 
                            prompt,
                            )
    #SET THE AGENT EXECUTOR TO RUN THE AGENT
    agent_executor = AgentExecutor(agent=agent, 
                                tools=tools,
                                memory=memory,
                                handle_parsing_errors=True,
                                verbose=False)

    #RUN THE AGENT EXECUTOR AND OUTPUT THE FINAL RESULT IN JSON FORMAT
    while True:
        try:
            query = input(" > ")  # Get user input
            if not query:
                print("Please provide a valid query.")
                continue
            result = agent_executor.invoke({"input": query})  # Invoke the QA model
            print("\n")
            response_json = {
                "input": query,
                "output": result["output"]
            } 
            print(json.dumps(response_json, indent=4))
            
            # Check if the result contains a Final Answer
            if "Final Answer:" in result["output"]:
                break  # Terminate the loop when a Final Answer is received
            
        except Exception as e:
            print(f"An error occurred: {e}")