import pandas as pd
import json
def reads_news_index():
    datas = pd.read_csv('src/bbc_news.csv').head(5)
    return datas.to_json()
def allData():
    result = {}
    title = []
    pubdate = []
    guid = []
    link = []
    description = []
    
    datas = pd.read_csv("src/bbc_news.csv").head(5)
    # json_data = datas.to_json(orient="records")  # List of dictionaries format

    json_list = []
    for _, row in datas.iterrows():
        json_list.append(row.to_dict())

    json_data = json.dumps(json_list, indent=4)

    return json_data
   