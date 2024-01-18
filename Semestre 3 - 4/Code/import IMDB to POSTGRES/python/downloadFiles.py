import requests
import gzip
import io
import csv
import shutil
from os import listdir, mkdir, remove
from os.path import isfile, join, exists, isdir

def getUrl() -> list:
    """
    :obj: Return the url of every tsv.gz file from IMDb
    :in: None
    :out: List -> every url from IMDb
    """
    urls = ['https://datasets.imdbws.com/name.basics.tsv.gz',
            'https://datasets.imdbws.com/title.akas.tsv.gz',
            'https://datasets.imdbws.com/title.basics.tsv.gz',
            'https://datasets.imdbws.com/title.crew.tsv.gz',
            'https://datasets.imdbws.com/title.episode.tsv.gz',
            'https://datasets.imdbws.com/title.principals.tsv.gz',
            'https://datasets.imdbws.com/title.ratings.tsv.gz']
    return urls


def downloadFiles(urls: list, dataPath:str):
    """
    :obj: Download every IMDb's tsv.gz file in subfolder called "data"
    :in: List -> urls of the files
    :out: None
    """
    if(exists(dataPath) and isdir(dataPath)):
        shutil.rmtree(dataPath)
        mkdir(dataPath)
    else:
        mkdir(dataPath)
    for link in urls:
        filename = link.split("/")[-1]
        with open(dataPath+filename, "wb") as f:
            r = requests.get(link)
            f.write(r.content)

        print("Finished " + link.split("/")[-1]+".")


def unzipFiles(dataPath:str):
    """
    :obj: Unzip every "gz" file that is in "./data"
    :in: None
    :out: None
    """
    gzipFiles = [f for f in listdir(
        dataPath) if (isfile(join(dataPath, f)) and f[-2:] == "gz")]
    for file in gzipFiles:
        with gzip.open(dataPath+file, 'rb') as f_in:
            with open(dataPath+file[:-6]+'csv', 'wb') as f_out:
                shutil.copyfileobj(f_in, f_out)
        remove(dataPath+file)

def download(dataPath:str):
    print("Downloading...")
    links = getUrl()
    downloadFiles(links, dataPath)
    unzipFiles(dataPath)
    print("Done!")