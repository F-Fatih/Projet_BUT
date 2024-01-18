import psycopg2
import time
import json


credentials = {}
with open("credentials.txt", "r") as f:
    for line in f:
        key, value = line.strip().split("=")
        credentials[key] = value


conn = psycopg2.connect(
    host=credentials["host"],
    database=credentials["database"],
    user=credentials["user"],
    password=credentials["password"]
)


def detectionTemps(tps):
    if tps>=3600:
        return (str(round((tps/60)/60,2))) + " heures"
    if tps>60:
        return str(round(tps/60,2)) + " minutes"
    else:
        return str(round(tps,2)) + " secondes"


def createGRAPHE():
    graphe={}
    
    cur = conn.cursor()
    cur.execute("SELECT tconst FROM titlebasics")
    for tconst in cur:
        graphe[tconst[0]] = []
    cur.close()

    cur = conn.cursor()
    cur.execute("SELECT nconst FROM namebasics")
    for nconst in cur:
        graphe[nconst[0]] = []
    cur.close()

    cur = conn.cursor()
    cur.execute("SELECT tconst, nconst FROM titleprincipals where category='actor' or category='actress';")
    for données in cur:
        tconst = données[0]
        nconst = données[1]
        graphe[tconst].append(nconst)
        graphe[nconst].append(tconst)
    cur.close()
    
    return graphe


def createJSON(graphe):
    data = json.dumps(graphe, indent=4)
    with open("graphe.json", "w") as f:
        f.write(data)

print("Demarrage de la creation du graphe . . .")
tps_start = time.time()

graphe = createGRAPHE()
print("Creation du graphe terminer.\n\nDemarrage de la creation du fichier JSON . . .")
createJSON(graphe)
print("Creation du JSON terminer.")

tps_stop = time.time()
print("\nLa creation du 'graphe' et du json a durée : ", detectionTemps(tps_stop-tps_start))