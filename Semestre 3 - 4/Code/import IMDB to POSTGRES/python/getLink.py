import psycopg2
import traceback

def createLink():
    with open('credentials.txt','r') as f:
        creds = f.read().split('\n')[1].split('|')
    params = {
        "host": creds[0],
        "dbname": creds[1],
        "user": creds[2],
        "password": creds[3],
        "port": int(creds[4]),
    }
    try:
        conn = psycopg2.connect(**params)
        conn.autocommit = True
        print("Connection Opened!")
        return conn
    except:
        print("Connection Failed")
        print(traceback.format_exc())
