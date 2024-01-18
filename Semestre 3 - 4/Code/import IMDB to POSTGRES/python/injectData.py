import psycopg2 as psycopg
from os import listdir
from os.path import isfile, join
import traceback
from time import time
from psycopg2.extensions import AsIs
from getLink import createLink
from psycopg2 import sql

import titlebasicsInsert
import titlecrewInsert
import titleakasInsert
import titleepisodeInsert
import titleratingInsert
import namebasicsInsert
import titleprincipalsInsert

def createTables(link,sqlPath) -> bool:
    cur = link.cursor()
    try:
        files = [sqlPath+f for f in listdir(sqlPath) if (
            isfile(join(sqlPath, f)) and f[-3:] == "sql")]
        for file in files:
            print("Starting "+file)
            with open(file, "r") as f:
                query = f.read()
                cur.execute(query)
            print("Finished "+file)
    except:
        print("Exited table creation with error code!")
        print(traceback.format_exc())
        if(link.closed):
            cur.close()
            link.close()
        return False
    return True

def createTriggers(link,sqlPath) -> bool:
    cur = link.cursor()
    try:
        file = sqlPath+'Trigger/TRIGGER.sql'
        with open(file, "r") as f:
            query = f.read()
            cur.execute(query)
        print("Finished "+file)
    except:
        print("Exited Trigger creation with error code!")
        print(traceback.format_exc())
        if(link.closed):
            cur.close()
            link.close()
        return False
    return True



def injectFiles(link,dataPath) -> bool:
    cur = link.cursor()
    start = time()
    titlebasicsInsert.injectFiles(cur,dataPath)
    namebasicsInsert.injectFiles(cur,dataPath)
    titlecrewInsert.injectFiles(cur,dataPath)
    titleakasInsert.injectFiles(cur,dataPath)
    titleepisodeInsert.injectFiles(cur,dataPath)
    titleratingInsert.injectFiles(cur,dataPath)
    #titleprincipalsInsert.injectFiles(cur,dataPath)

    return True

def injectData(conn,dataPath,sqlPath):
    #Table creation
    start = time()
    print("Starting table creation : ")
    if(createTables(conn,sqlPath)):
        print("Finished table creation in "+str(time()-start)+" seconds.")
    else:
        print("Stopping execution following error in table creation!")
        return False

    #Trigger creation
    start = time()
    print("Starting trigger creation : ")
    if(createTriggers(conn,sqlPath)):
        print("Finished triggers creation in "+str(time()-start)+" seconds.")
    else:
        print("Stopping execution following error in triggers creation!")
        return False

    #Data injection
    start = time()
    print("Starting data injection ... ")
    if(injectFiles(conn,dataPath)):
        print("Finished data injection in "+str(time()-start)+" seconds.")
    else:
        print("Stopping execution following error in data injection!")
        return False


    return True

if(__name__=="__main__"):
    link = createLink()
    injectFiles(link,"./data/")
