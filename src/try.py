import pandas as pd
def get_category_news():
    allData = pd.read_csv("src/bbc_news.csv")
    allData["description"].str.contains("kane")
    data_get_news =  allData.to_dict(orient="records")
    print(data_get_news)
   
print(get_category_news())
    