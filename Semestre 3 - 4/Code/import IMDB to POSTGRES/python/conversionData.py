from time import time
from os import remove,rename

def conversionNameBasics(DATA_PATH):
    start = time()
    print("Started conversion name.basics")
    with open(DATA_PATH+"name.basics.csv","r", encoding="utf8") as f:
        header = f.readline()
        with open(DATA_PATH+"data.csv","w", encoding="utf8") as data:

            data.write(header)
            line = f.readline()[:-1]

            while(line!=""):
                val = line.split("\t")

                if(val[4]!='\\N'):
                    val[4] = '{' + val[4] + '}'

                if(val[5]!='\\N'):
                    val[5] = '{' + val[5] + '}'

                data.write('\t'.join(val)+'\n')
                line = f.readline()[:-1]

    remove(DATA_PATH+"name.basics.csv")
    rename(DATA_PATH+"data.csv",DATA_PATH+"name.basics.csv")

    print("Finished conversion name.basics in " + str(time()-start) + " seconds")



def conversionTitleAkas(DATA_PATH):
    start = time()
    print("Started conversion title.akas")
    with open(DATA_PATH+"title.akas.csv","r", encoding="utf8") as f:
        header = f.readline()
        with open(DATA_PATH+"data.csv","w", encoding="utf8") as data:

            data.write(header)
            line = f.readline()[:-1]

            while(line!=""):
                val = line.split("\t")

                if(val[5]!='\\N'):
                    val[5] = '{' + val[5] + '}'

                if(val[6]!='\\N'):
                    val[6] = '{' + val[6] + '}'

                data.write('\t'.join(val)+'\n')
                line = f.readline()[:-1]

    remove(DATA_PATH+"title.akas.csv")
    rename(DATA_PATH+"data.csv",DATA_PATH+"title.akas.csv")

    print("Finished conversion title.akas in " + str(time()-start) + " seconds")




def conversionTitleBasics(DATA_PATH):
    start = time()
    print("Started conversion title.basics")
    with open(DATA_PATH+"title.basics.csv","r", encoding="utf8") as f:
        header = f.readline()
        with open(DATA_PATH+"data.csv","w", encoding="utf8") as data:

            data.write(header)
            line = f.readline()[:-1]

            while(line!=""):
                val = line.split("\t")
                val= [item.replace('"','') for item in val]
                if(val[8]!='\\N'):
                    val[8] = '{' + val[8] + '}'

                data.write('\t'.join(val)+'\n')
                line = f.readline()[:-1]

    remove(DATA_PATH+"title.basics.csv")
    rename(DATA_PATH+"data.csv",DATA_PATH+"title.basics.csv")

    print("Finished conversion title.basics in " + str(time()-start) + " seconds")

def conversionTitlePrincipals(DATA_PATH):
    start = time()
    print("Started conversion title.principals")
    with open(DATA_PATH+"title.principals.csv","r", encoding="utf8") as f:
        header = f.readline()
        with open(DATA_PATH+"data.csv","w", encoding="utf8") as data:

            data.write(header)
            line = f.readline()[:-1]

            while(line!=""):
                val = line.split("\t")
                val= [item.replace('"','') for item in val]
                data.write('\t'.join(val)+'\n')
                line = f.readline()[:-1]

    remove(DATA_PATH+"title.principals.csv")
    rename(DATA_PATH+"data.csv",DATA_PATH+"title.principals.csv")

    print("Finished conversion title.basics in " + str(time()-start) + " seconds")


def conversionTitleCrew(DATA_PATH):
    start = time()
    print("Started conversion title.crew")
    with open(DATA_PATH+"title.crew.csv","r", encoding="utf8") as f:
        header = f.readline()
        with open(DATA_PATH+"data.csv","w", encoding="utf8") as data:

            data.write(header)
            line = f.readline()[:-1]

            while(line!=""):
                val = line.split("\t")

                if(val[1]!='\\N'):
                    val[1] = '{' + val[1] + '}'
                if(val[2]!='\\N'):
                    val[2] = '{' + val[2] + '}'

                data.write('\t'.join(val)+'\n')
                line = f.readline()[:-1]

    remove(DATA_PATH+"title.crew.csv")
    rename(DATA_PATH+"data.csv",DATA_PATH+"title.crew.csv")

    print("Finished conversion title.crew in " + str(time()-start) + " seconds")

def conversionData(DATA_PATH) -> bool:
    #conversion des données
    start = time()
    print("Starting data conversion.... ")
    conversionTitleBasics(DATA_PATH)
    #conversionTitlePrincipals(DATA_PATH)
    conversionNameBasics(DATA_PATH)
    conversionTitleAkas(DATA_PATH)
    conversionTitleCrew(DATA_PATH)
    print("Finished data conversion in "+str(time()-start)+" seconds.")
    return True


if(__name__=="__main__"):
    conversionData("./data/")