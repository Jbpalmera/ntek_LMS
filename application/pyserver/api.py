from fastapi import FastAPI, Request
from ailita import agent_executor  # Import your chatbot setup
import uvicorn

app = FastAPI()

@app.post("/chat")
async def chat(request: Request):
    data = await request.json()
    user_input = data.get("message")
    
    if not user_input:
        return {"error": "No input provided"}
    
    # Pass user input to the chatbot and get the result
    result = agent_executor.invoke({
        "input": user_input,
        "sql_query": "",
        "tools": agent_executor.tools,
        "agent_scratchpad": ""
    })
    
    # Prepare response
    response = {
        "input": user_input,
        "output": result.get("output", "No response available")
    }
    return response

if __name__ == "__main__":
    uvicorn.run(app, host="0.0.0.0", port=8000)
