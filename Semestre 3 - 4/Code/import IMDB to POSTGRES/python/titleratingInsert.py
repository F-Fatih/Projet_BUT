from time import time

def injectFiles(cur,dataPath) -> bool:
    start = time()
    print("Started title.rating")
    with open(dataPath+"title.ratings.csv","r", encoding="utf8") as f:
        sql = "copy titleratings FROM stdin DELIMITER E'\\t' CSV HEADER ENCODING 'UTF8' QUOTE '\"' NULL '\\N' ESCAPE ''''"
        cur.copy_expert(sql=sql,file=f)
    print("Finished title.rating in " + str(time()-start) + " seconds")