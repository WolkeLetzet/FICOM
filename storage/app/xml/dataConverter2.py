import pandas as pd
from os import getenv as env
from dotenv import load_dotenv
import mysql.connector
import sys

load_dotenv()
mydb = mysql.connector.connect(
      host=env("DB_HOST"),
      user=env("DB_USERNAME"),
      password=env("DB_PASSWORD"),
      database=env("DB_DATABASE")
)

cursor= mydb.cursor()

excel_data = pd.read_excel(sys.argv[1])

data = pd.DataFrame(excel_data, columns=['RUN'])
if data.empty:
   raise Exception 

datos = list(data.to_dict()['RUN'].values())

for dato in datos:
   cursor.execute(
      """
      UPDATE ficom.estudiantes SET prioridad = 'Prioritario' WHERE rut = %s 
      """,
      (dato,)
   )
mydb.commit() 
mydb.close()