from sklearn.metrics.pairwise import cosine_similarity
from sklearn.feature_extraction.text import TfidfVectorizer
from read_news import read_data, result_preprocesing_data
import pandas as pd

tfidf = TfidfVectorizer()


def reads_news_index():
    datas = pd.read_csv("src/bbc_news.csv")
    return datas.to_json()


def calculation_tfidf():
    data = result_preprocesing_data("src/bbc_news.csv")
    embed_tfidf_data_news_bbc = tfidf.fit_transform(data)
    return embed_tfidf_data_news_bbc


def query(q):
    data = {}
    embed_tfidf_data_news_bbc = calculation_tfidf()
    query_vector = tfidf.transform([q])
    cosine_similarities_tfidf = cosine_similarity(
        query_vector, embed_tfidf_data_news_bbc
    ).flatten()
    data_score_tfidf = pd.DataFrame({
        "description":read_data("src/bbc_news.csv")["description"],
        "title":read_data("src/bbc_news.csv")["title"],
        "score":cosine_similarities_tfidf
    })
    # data_score_tfidf = pd.DataFrame(
    #     cosine_similarities_tfidf,
    #     columns=[q],
    #     index=read_data("bbc_news.csv")["description"],
    # )
    result_score_tfidf = data_score_tfidf.sort_values(by="score", ascending=False).head(10)
    data = {
        "query":q,
        "title":result_score_tfidf["title"].to_list(),
        "news_description":result_score_tfidf["description"].to_list(),
        "score":result_score_tfidf["score"].to_list()
    }
    return pd.DataFrame(data)
