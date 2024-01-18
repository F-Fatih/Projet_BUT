import os
import json
import psycopg2
import requests
from bs4 import BeautifulSoup


conn = psycopg2.connect(
    host="62.210.130.140",
    database="SAE",
    user="DraCorporation",
    password="PJFWf3EMjlNZ314C2sRg"
)

cur = conn.cursor()
cur.execute("SELECT nconst FROM afficheacteurs ORDER BY date DESC LIMIT 1")
result = cur.fetchone()
cur.close()


id = result[0]
lien = []

cur = conn.cursor()
cur.execute("SELECT nconst, primaryname FROM namebasics WHERE nconst='" + id + "'")
            
for nconst, prenom in cur:
    url = "https://fr.wikipedia.org/wiki/" + prenom
        
    response = requests.get(url)
    soup = BeautifulSoup(response.text, 'html.parser')
    
    img_div = soup.find("div", {"class": "images"})
    
    if img_div:
        img_element = img_div.find("img")
        img_src = img_element["src"]
        requete = "UPDATE afficheacteurs set lien='https:" + img_src + "' where nconst='" + nconst + "'"
    else : 
        requete = "UPDATE afficheacteurs set lien=null where nconst='" + nconst + "'"
    insert = conn.cursor()
    insert.execute(requete)
    conn.commit()
    insert.close()



cur.close()
