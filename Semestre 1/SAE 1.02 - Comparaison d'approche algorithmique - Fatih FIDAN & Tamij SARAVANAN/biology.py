from json import *

def est_base(c):
    if c!="A" and c!="T" and c!="G" and c!="C":
        return False
    else:
        return True
    pass


def est_adn(s):
    i=0
    while i<len(s):
        if est_base(s[i])==False:
            return False
        i+=1
    return True
    pass


def arn(adn):
    i=0
    while i<len(adn):
        if est_adn(adn)==True:
            remplace = adn.replace('T','U')
            return remplace
        else :
            return None
        i+=1
    pass


def arn_to_codons(arn):
    i=0
    tab=[]
    while i<len(arn):
        tab.append(arn[i:3+i])
        i+=3
    return tab
    pass


def load_dico_codons_aa(filename):
    codons_aa = open (filename,"r")
    codons_aa_json = codons_aa.read()
    dico = loads(codons_aa_json)
    codons_aa.close()
    return dico
    pass


def codons_stop(dico):
    i = 0
    codons_json=list(dico)
    codons_found=[]
    codons='AUGC'
    while i<len(codons):
        codons_stop=''
        codons_stop+=codons[i]
        j=0
        while j<len(codons):
            codons_stop=codons_stop[0]
            codons_stop+=codons[j]
            k=0
            while k<len(codons):
                if len(codons_stop)>=3:
                    codons_stop=codons_stop[0]+codons_stop[1]
                codons_stop+=codons[k]
                if codons_stop not in codons_json :
                    codons_found.append(codons_stop)
                k+=1
            j+=1
        i+=1   
    return codons_found
    pass


def codons_to_aa(table,dico):
    i=0
    t=[]
    tfin=True
    cd=codons_stop(dico)
    while i<len(table) and tfin==True:
        j=0
        while j<len(dico) and i==len(t):
            if list(dico)[j]==table[i]:
                t.append(list(dico.values())[j])
            elif table[i]==cd[j%len(cd)]:
                tfin=False
            j+=1
        i+=1
    return t
    pass




def nextIndice(tab, ind, elements):
    while ind<len(tab):
        j=0
        while j<len(elements):
            if tab[ind]==elements[j]:
                return ind
            j+=1
        ind+=1
    return ind
    pass


def decoupe_sequence(seq,start,stop):
    t=[]
    i=0
    while i<len(seq):
        p=[]
        if seq[i] in start:
            i+=1
            while seq[i] not in stop and i<len(seq):
                p.append(seq[i])
                i+=1
            t.append(p)
        i+=1
    return t
    pass


def codons_to_seq_codantes(seq, dico):
    start=["AUG"]
    stop=codons_stop(dico)
    resultat=decoupe_sequence(seq,start,stop)
    return resultat
    pass


def seq_codantes_to_seq_aas(tab, dico):
    i=0
    tableau=[]
    while i<len(tab):
        j=0
        while j<len(tab[i]):
            resultat=codons_to_aa(tab[i], dico)
            j+=1
        tableau.append(resultat)
        i+=1
    return tableau
    pass


def adn_encode_molecule(dico, adn, molecule):
    arn_3=arn_to_codons(arn(adn))
    stop=codons_stop(dico)
    i=0
    while i<len(arn_3):
        j=0
        k=0
        while j<len(stop):
            if stop[j] in arn_3[i]:
                arn_3.remove(stop[j])
            j+=1
        nom_codons=codons_to_aa(arn_3, dico)
        while k<len(molecule):
            if molecule[k] in nom_codons[i]:
                return True
            k+=1
        i+=1
    return False
    pass
