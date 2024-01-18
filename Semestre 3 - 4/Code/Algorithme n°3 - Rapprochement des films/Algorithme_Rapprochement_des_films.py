import heapq
import json


def ouvertureJSON(fichier):
    with open(fichier, 'r') as f:
        data = json.load(f)
    return data


def find_shortest_path(graph, start, stop):
    visite = set()
    distances = {}
    parent = {}
    queue = []
    heapq.heappush(queue, (0, start))
    distances[start] = 0
    parent[start] = None

    while queue:
        distance, noeud = heapq.heappop(queue)
        if noeud not in visite:
            visite.add(noeud)
            if noeud == stop:
                break
            voisins = graph[noeud]
            for voisin in voisins:
                newDistance = distance + 1
                if voisin not in distances or newDistance < distances[voisin]:
                    distances[voisin] = newDistance
                    parent[voisin] = noeud
                    heapq.heappush(queue, (newDistance, voisin))

    shortest_path = []
    noeudActuel = stop

    while noeudActuel is not None:
        shortest_path.insert(0, noeudActuel)
        noeudActuel = parent[noeudActuel]

    return shortest_path


start="tt1260582"
stop="tt3681484"

graphe = ouvertureJSON("graphe.json")
resultat = find_shortest_path(graphe, start, stop)

print(resultat)
#resultat = ['tt1260582', 'nm0467558', 'tt0124971', 'nm0119876', 'tt3681484']