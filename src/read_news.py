import pandas as pd
import json
from processing import preprocessing_text


def read_data(filename):
    return pd.read_csv(filename)


    
  

    


def result_preprocesing_data(file):
    data = read_data(file)
    data["clean"] = data["description"].apply(preprocessing_text)
    return data["clean"]