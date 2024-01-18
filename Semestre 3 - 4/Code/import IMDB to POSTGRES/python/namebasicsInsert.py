from time import time

def injectFiles(cur,dataPath) -> bool:
    start = time()
    print("Started name.basics")
    with open(dataPath+"name.basics.csv","r", encoding="utf8") as f:
        sql = "copy namebasics FROM stdin DELIMITER E'\\t' CSV HEADER ENCODING 'UTF8' QUOTE '\"' NULL '\\N' ESCAPE ''''"
        cur.copy_expert(sql=sql,file=f)
    print("Finished name.basics in " + str(time()-start) + " seconds")