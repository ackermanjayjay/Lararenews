from typing import Union
import uvicorn
from fastapi import FastAPI, Query
from fastapi.middleware.cors import CORSMiddleware

app = FastAPI()
from calculation import query, reads_news_index
import pandas as pd

app.add_middleware(
    CORSMiddleware,
    allow_origins=["*"],  # Adjust this to limit access to specific origins if needed
    allow_credentials=True,
    allow_methods=[
        "GET",
        "POST",
        "PUT",
        "DELETE",
        "OPTIONS",
        "XMLHttpRequest",
    ],  # Adjust the HTTP methods as needed
    allow_headers=["*"],  # Allow all headers, adjust according to your requirements
)


def allData():
    datas = pd.read_csv("src/bbc_news.csv")
    return datas


@app.get("/")
def get_news(
    page: int = Query(1, alias="page"), per_page: int = Query(6, alias="per_page")
):
    start = (page - 1) * per_page
    end = start + per_page
    total = len(allData())
    return {
        "news": allData().iloc[start:end].to_dict(orient="records"),
        "total": total,
        "page": page,
        "per_page": per_page,
    }


@app.get("/news/{query_search}")
async def search_bar(
    query_search: str,
    q: str,
    page: int = Query(1, alias="page"),
    per_page: int = Query(6, alias="per_page"),
):
    start = (page - 1) * per_page
    end = start + per_page
    total = len(query(q))
    return {
        "news": query(q).iloc[start:end].to_dict(orient="records"),
        "total": total,
        "page": page,
        "per_page": per_page,
    }


# if __name__ == "__main__":
#     uvicorn.run(app, host="0.0.0.0", port=8080)
