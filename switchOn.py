#from gpiozero import OutputDevice
from time import sleep
from sys import exit
from dotenv import load_dotenv
import subprocess
import sqlite3
import os
import pyodbc

load_dotenv()

server = os.getenv("DB_HOST")
db = os.getenv("DB_DATABASE")
usr = os.getenv("DB_USERNAME")
pwd = os.getenv("DB_PASSWORD")

conn = pyodbc.connect('DRIVER={ODBC Driver 17 for SQL Server};SERVER='+server+';DATABASE='+ db+';UID='+usr+';PWD='+ pwd)
cursor = conn.cursor()
# Selecting from PyTable 
cursor.execute("SELECT * gpios") 
row = cursor.fetchone() 
while row: 
    print("%s   %s" % (row[0], row[1]))
    row = cursor.fetchone()
