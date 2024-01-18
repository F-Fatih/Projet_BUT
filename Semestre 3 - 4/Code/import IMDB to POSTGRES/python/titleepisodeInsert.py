from time import time

def injectFiles(cur,dataPath) -> bool:
    start = time()
    print("Started title.episode")
    with open(dataPath+"title.episode.csv","r", encoding="utf8") as f:
        sql = "copy titleepisode FROM stdin DELIMITER E'\\t' CSV HEADER ENCODING 'UTF8' QUOTE '\"' NULL '\\N' ESCAPE ''''"
        cur.copy_expert(sql=sql,file=f)
    print("Finished title.episode in " + str(time()-start) + " seconds")