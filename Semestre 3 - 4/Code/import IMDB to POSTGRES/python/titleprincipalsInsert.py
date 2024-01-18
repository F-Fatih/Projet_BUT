from time import time

def injectFiles(cur,dataPath) -> bool:
    e=0
    start = time()
    print("Started title.principals")  
    with open(dataPath+"title.principals.csv","r", encoding="utf8") as f:
        f.readline()
        line = f.readline()[:-1]
        i=0
        while(line!=""):
            try:
                val = line.split("\t")
                for j in range(len(val)):
                    if(val[j]=='\\N'):
                        val[j] = None
                cur.execute("""INSERT INTO titleprincipals VALUES
                            (%(tconst)s,%(ordering)s,%(nconst)s,
                            %(category)s,%(job)s,%(character)s)""",
                            {
                                "tconst":val[0],
                                "ordering":val[1],
                                "nconst":val[2],
                                "category":val[3],
                                "job":val[4],
                                "character":val[5],
                            })
            except:
                e+=1
            line = f.readline()[:-1] 
    print("Finished title.principals in " + str(time()-start) + " seconds with a total of "+ str(e) +" errors.")