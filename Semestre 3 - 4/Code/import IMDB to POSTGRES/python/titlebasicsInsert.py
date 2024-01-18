from time import time


def injectFiles(cur,dataPath) -> bool:
    start = time()
    print("Started title.basics")
    with open(dataPath+"title.basics.csv","r", encoding="utf8") as f:
        sql = "copy titlebasics FROM stdin DELIMITER E'\\t' CSV HEADER ENCODING 'UTF8' QUOTE '\"' NULL '\\N' ESCAPE ''''"
        cur.copy_expert(sql=sql,file=f)

    print("Finished title.basics in " + str(time()-start) + " seconds")