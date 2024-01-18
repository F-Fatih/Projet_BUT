import heapq
import json
import os
import psycopg2

path = "/home/DraCorporation/public_html/Content/json/"

def ouvertureJSON(fichier):
    with open(path + fichier, 'r') as f:
        data = json.load(f)
    return data

conn = psycopg2.connect(
    host="*********",
    database="*********",
    user="*********",
    password="*********"
)

cur = conn.cursor()
cur.execute("SELECT sconst, econst FROM shortestPath ORDER BY date DESC LIMIT 1")
result = cur.fetchone()
cur.close()


def find_shortest_path(graph, start, end):
    visited = set()
    distances = {}
    parent = {}
    queue = []
    heapq.heappush(queue, (0, start))
    distances[start] = 0
    parent[start] = None

    while queue:
        distance, node = heapq.heappop(queue)
        if node not in visited:
            visited.add(node)
            if node == end:
                break
            neighbors = graph[node]
            for neighbor in neighbors:
                new_distance = distance + 1
                if neighbor not in distances or new_distance < distances[neighbor]:
                    distances[neighbor] = new_distance
                    parent[neighbor] = node
                    heapq.heappush(queue, (new_distance, neighbor))

    shortest_path = []
    current_node = end

    while current_node is not None:
        shortest_path.insert(0, current_node)
        current_node = parent[current_node]

    return shortest_path


graphe = ouvertureJSON("graphe.json")
resultat = find_shortest_path(graphe,result[0], result[1])

cur = conn.cursor()
requete = "UPDATE shortestPath set path='" + str(resultat).replace("'",'"') + "' where sconst='" + result[0] + "' and  econst = '" + result[1] +"'"
insert = conn.cursor()
insert.execute(requete)
conn.commit()
insert.close()
cur.close()
