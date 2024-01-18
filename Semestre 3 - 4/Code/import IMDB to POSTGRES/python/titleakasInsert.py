from time import time

def injectFiles(cur,dataPath) -> bool:
    start = time()
    print("Started title.akas")
    with open(dataPath+"title.akas.csv","r", encoding="utf8") as f:
        sql = "copy titleakas FROM stdin DELIMITER E'\\t' CSV HEADER ENCODING 'UTF8' QUOTE '\"' NULL '\\N' ESCAPE ''''"
        cur.copy_expert(sql=sql,file=f)
    print("Finished title.akas in " + str(time()-start) + " seconds")