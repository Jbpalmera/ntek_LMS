import json
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
    # Load .env file
    load_dotenv()

    # Embedding model and function to retrieve documents information from vector DB
    book_collection = 'books_collection'
    library_guidelines = 'library_guidelines'
    embedding = OllamaEmbeddings(
        base_url="http://192.168.1.103:11434",
        model="nomic-embed-text"
    )
    # embedding = OpenAIEmbeddings()

    # Embedded persisting vector of library guidelines
    library_guidelines_vector = Chroma(persist_directory=library_guidelines, 
                    embedding_function=embedding)
    
    books_collection_vector = Chroma(persist_directory=book_collection,
                                    embedding_function=embedding)

    llm = ChatGroq(
        temperature=0.2, 
        model_name="llama3-70b-8192"
    )
    # LLM
    # llm = ChatOpenAI(
    #     temperature=0,
    #     streaming=True, callbacks=[StreamingStdOutCallbackHandler()]
    # )

    # llm = ChatOllama(base_url="http://43.203.211.242/ollama",
    #             model="llama3",
    #             temperature=0,
    #             streaming=True, callbacks=[StreamingStdOutCallbackHandler()])

    # llm = ChatOpenAI(
    # api_key="ollama",
    # model="llama3:8b-instruct-fp16",
    # base_url="http://43.203.211.242/ollama/v1",
    # )

    # SQL database connection and chain
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
        func=lambda query: db_chain.run(query).strip(),
        description="Useful for answering questions about the collection of books, authors, issued books, and other related records. Generate and execute the SQL query directly without any preambles, explanations, or extra formatting."
    )

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
    
    # Set defined tools
    tools = [booksDB_Tool, guidelinesTool, books_recommendation_tool]

    # Date today
    today = date.today()

    # Using SQLite as chat message history and today's date as the session ID and DB name
    message_history = SQLChatMessageHistory(
    session_id=today, connection_string=f"sqlite:///chat_history/{today}")

    # Declaring the memory using conversation buffer memory
    memory = ConversationBufferMemory(
                memory_key="chat_history",
                input_key="input", 
                chat_memory=message_history)

    # Prompt template for Ailita
    template = """Assistant name is Ailita. Ailita is a librarian at the Mindanao State University.
    Be polite and hospitable. If the human greets, greet the human back. If the human ends the conversation, bid a farewell.
    Act and answer as if you are an actual librarian.
    Always refer to the Books Collection tool when answering question about book or author records. Don't give information about books that is not in the database.
    Address all human questions by acknowledging any information gaps respectfully and provide detailed responses based on known information.
    Avoid answering questions unrelated to library or book issues.

    SQL Query: <SQL> {sql_query} </SQL>

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

    # Set the custom prompt template of Ailita
    first_prompt = PromptTemplate(input_variables=["sql_query","chat_history", "input", "tools", "agent_scratchpad"], 
                            template=template)
    
    # Second prompt template to convert SQL to natural language
    second_prompt_template = """You are an assistant that can translate SQL queries into natural language descriptions.
    Given the following SQL query, provide a detailed natural language description of what the query does.
    
    SQL Query:
    {sql_query}

    Natural Language Description:
    """
    
    second_prompt = PromptTemplate(input_variables=["sql_query"], template=second_prompt_template)
    
    # Function to convert SQL to natural language
    def sql_to_natural_language(sql_query, llm):
        return llm(second_prompt.format(sql_query=sql_query)).strip()

    # Initialize the agent with the LLM, tool, and the prompt
    agent = create_react_agent(llm, tools, first_prompt)
    
    # Set the agent executor to run the agent
    agent_executor = AgentExecutor(agent=agent, 
                                tools=tools,
                                memory=memory,
                                handle_parsing_errors=True,
                                verbose=False)

    # Run the agent executor and output the final result in JSON format
    while True:
        try:
            query = input(" > ")  # Get user input
            if not query:
                print("Please provide a valid query.")
                continue
            # Provide the necessary variables to the agent executor
            result = agent_executor.invoke({
                "input": query,
                "sql_query": "",  # Initialize with an empty SQL query
                "tools": tools,
                "agent_scratchpad": ""
            })  
            
            if 'sql_query' in result:
                sql_query = result['sql_query']
                natural_language_description = sql_to_natural_language(sql_query, llm)
                final_result = {
                    "SQL Query": sql_query,
                    "Natural Language Description": natural_language_description
                }
                print(json.dumps(final_result, indent=4))
            else:
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
