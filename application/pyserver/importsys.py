import sys
from langchain_openai import ChatOpenAI
from langchain_core.messages import HumanMessage, SystemMessage
from langchain.chains.conversation.memory import ConversationBufferWindowMemory

def get_chatopenai_response(text):
    llm = ChatOpenAI(
        openai_api_key='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',
        temperature=1,
        model_name="gpt-3.5-turbo"
    )

    messages = [
        SystemMessage(
            content="I am your Customer Care Support."
        ),
        HumanMessage(
            content=f"{text}"
        ),
    ]

    response = llm.invoke(messages)
    return response

def getData():
    if len(sys.argv) > 1:
        msg = sys.argv[1]
        return msg
    else:
        return "No question provided"

msg = getData()
response = get_chatopenai_response(msg)
print(response.content)
