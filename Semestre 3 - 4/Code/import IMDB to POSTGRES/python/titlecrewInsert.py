from time import time

def injectFiles(cur,dataPath) -> bool:
    start = time()
    print("Started title.crew")
    with open(dataPath+"title.crew.csv","r", encoding="utf8") as f:
        sql = "copy titlecrew FROM stdin DELIMITER E'\\t' CSV HEADER ENCODING 'UTF8' QUOTE '\"' NULL '\\N' ESCAPE ''''"
        cur.copy_expert(sql=sql,file=f)
    print()
    print("Finished title.crew in " + str(time()-start) + " seconds")