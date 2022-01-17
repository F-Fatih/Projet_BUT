# TO DO

import biology as bio

def test_est_base():
    assert bio.est_base("A")==True
    assert bio.est_base("T")==True
    assert bio.est_base("G")==True
    assert bio.est_base("C")==True
    assert bio.est_base("A")!=False
    assert bio.est_base("T")!=False
    assert bio.est_base("G")!=False
    assert bio.est_base("C")!=False
    print("Test de la fonction est_base : Ok ")
    
    
def test_est_adn():
    assert bio.est_adn("ATGC")==True
    assert bio.est_adn("AATTGGCC")==True
    assert bio.est_adn("opcjmqldi")!=True
    assert bio.est_adn("dqsdzavrzm")!=True   
    assert bio.est_adn("ATGC")!=False 
    assert bio.est_adn("AATTGGCC")!=False
    assert bio.est_adn("atgc")==False
    assert bio.est_adn("AbfATazTGdsfGCCcs")==False
    print("Test de la fonction est_adn : Ok ")
    
    
def test_est_arn():
    assert bio.arn("ATTGCA")=="AUUGCA"
    assert bio.arn("ATTGCA")!="auugca"
    assert bio.arn("ATTTGTCTAT")=="AUUUGUCUAU"
    assert bio.arn("TTTTTT")=="UUUUUU"
    assert bio.arn("azerty")==None
    assert bio.arn("ATTazertyGCA")==None
    assert bio.arn("attgca")==None
    assert bio.arn("123456")==None
    print("Test de la fonction est_arn : Ok")

    
def test_arn_to_codons():
    assert bio.arn_to_codons("CGUUAGGGG")==["CGU","UAG","GGG"]
    assert bio.arn_to_codons("CCCGGGUUU")==["CCC","GGG","UUU"]
    assert bio.arn_to_codons("CGUUAGGGGCGUUAGGGG")==["CGU","UAG","GGG","CGU","UAG","GGG"]
    assert bio.arn_to_codons("CCCGGGUUUUUUGGGCCC")==["CCC","GGG","UUU","UUU","GGG","CCC"]
    assert bio.arn_to_codons("CGUUAGGGG")!=["CGU","UUAG","GGGG"]
    assert bio.arn_to_codons("CGUUAGGGG")!=["C","CG","CGU","CGUU","CGUUA","CGUUAG","CGUUAGG","CGUUAGGG","CGUUAGGGG"]
    assert bio.arn_to_codons("CGUUAGGGG")!=["CG","UU","AG","GG","G"]
    assert bio.arn_to_codons("CGUUAGGGG")!=["CGU","GUU","UUA","UAG","AGG","GGG","GGG"]
    print("Test de la fonction arn_to_codons : Ok")
    
    
def test_load_dico_codons_aa():
    assert bio.load_dico_codons_aa('data/codons_aa.json')=={'UUU': 'Phenylalanine', 'UUC': 'Phenylalanine', 'UUA': 'Leucine', 'UUG': 'Leucine', 'CUU': 'Leucine','CUC': 'Leucine','CUA': 'Leucine','CUG': 'Leucine','AUU': 'Isoleucine','AUC': 'Isoleucine','AUA': 'Isoleucine','AUG': 'Methionine','GUU': 'Valine','GUC': 'Valine','GUA': 'Valine','GUG': 'Valine','UCU': 'Serine','UCC': 'Serine','UCA': 'Serine','UCG': 'Serine','CCU': 'Proline','CCC': 'Proline','CCA': 'Proline','CCG': 'Proline','ACU': 'Threonine','ACC': 'Threonine','ACA': 'Threonine','ACG': 'Threonine','GCU': 'Alanine','GCC': 'Alanine','GCA': 'Alanine','GCG': 'Alanine','UAU': 'Tyrosine','UAC': 'Tyrosine','CAU': 'Histidine','CAC': 'Histidine','CAA': 'Glutamine','CAG': 'Glutamine','AAU': 'Asparagine','AAC': 'Asparagine','AAA': 'Lysine','AAG': 'Lysine','GAU': 'Aspartic acid','GAC': 'Aspartic acid','GAA': 'Glutamic acid','GAG': 'Glutamic acid','UGU': 'Cysteine','UGC': 'Cysteine','UGG': 'Tryptophan','CGU': 'Arginine','CGC': 'Arginine','CGA': 'Arginine','CGG': 'Arginine','AGU': 'Serine','AGC': 'Serine','AGA': 'Arginine','AGG': 'Arginine','GGU': 'Glycine','GGC': 'Glycine','GGA': 'Glycine','GGG': 'Glycine'}
    assert bio.load_dico_codons_aa('data/codons_aa.json')!={}
    print("Test de la fonction load_dico_codons_aa : Ok")

    
def test_codons_stop():
    assert bio.codons_stop(bio.load_dico_codons_aa('data/codons_aa.json'))==['UAA', 'UAG', 'UGA']
    assert bio.codons_stop(bio.load_dico_codons_aa('data/codons_aa.json'))!=['UAA', 'UAG']
    assert bio.codons_stop(bio.load_dico_codons_aa('data/codons_aa.json'))!=['UAA']
    assert bio.codons_stop(bio.load_dico_codons_aa('data/codons_aa.json'))!=['AAU', 'GAU', 'AGU']
    assert bio.codons_stop(bio.load_dico_codons_aa('data/codons_aa.json'))!=['AAA', 'GGG', 'UUU']
    assert bio.codons_stop(bio.load_dico_codons_aa('data/codons_aa.json'))!=['AAA', 'GGG', 'UUU', 'CCC']
    assert not bio.codons_stop(bio.load_dico_codons_aa('data/codons_aa.json'))==['aaa', 'ggg', 'uuu', 'ccc']
    assert not bio.codons_stop(bio.load_dico_codons_aa('data/codons_aa.json'))==['uaa','uag','uga']
    print("Test de la fonction codons_stop : Ok")

    
def test_codons_to_aa():
    assert bio.codons_to_aa(["CGU", "AAU", "UAA", "GGG", "CGU"],bio.load_dico_codons_aa('data/codons_aa.json'))==["Arginine", "Asparagine"]
    assert bio.codons_to_aa(['CGU', 'CGG', 'UUU', 'CUU'],bio.load_dico_codons_aa('data/codons_aa.json'))==['Arginine', 'Arginine', 'Phenylalanine', 'Leucine']
    assert bio.codons_to_aa(['CGU', 'CGG', 'UAA', 'CUU'],bio.load_dico_codons_aa('data/codons_aa.json'))==['Arginine', 'Arginine']
    assert bio.codons_to_aa(['UAA'], bio.load_dico_codons_aa('data/codons_aa.json'))==[]
    assert bio.codons_to_aa(["CGU", "AAU", "UAA", "GGG", "CGU"],bio.load_dico_codons_aa('data/codons_aa.json'))!=[]
    print("Test de la fonction codons_to_aa : Ok")

    
def test_nextIndice():
    assert bio.nextIndice(["bonjour", "hello", "buongiorno", "ciao", "bye"],0,["hello", "bye"])==1
    assert bio.nextIndice(["bonjour", "hello", "buongiorno", "ciao", "bye"],1,["hello", "bye"])==1
    assert bio.nextIndice(["bonjour", "hello", "buongiorno", "ciao", "bye"],2,["hello", "bye"])==4
    assert bio.nextIndice(["bonjour", "hello", "buongiorno", "ciao", "bye"],3,["hello", "bye"])==4
    assert bio.nextIndice(["bonjour", "hello", "buongiorno", "ciao", "bye"],4,["hello", "bye"])==4
    assert not bio.nextIndice(["bonjour", "hello", "buongiorno", "ciao", "bye"],0,["hello", "bye"])==4
    assert not bio.nextIndice(["bonjour", "hello", "buongiorno", "ciao", "bye"],1,["hello", "bye"])==4
    assert not bio.nextIndice(["bonjour", "hello", "buongiorno", "ciao", "bye"],2,["hello", "bye"])==1
    assert not bio.nextIndice(["bonjour", "hello", "buongiorno", "ciao", "bye"],3,["hello", "bye"])==1
    assert not bio.nextIndice(["bonjour", "hello", "buongiorno", "ciao", "bye"],4,["hello", "bye"])==1
    print("Test de la fonction nextIndice : Ok")
    
    
def test_decoupe_sequence():
    assert bio.decoupe_sequence(["val1", "début", "val2", "val3", "end", "val4", "fin", "begin", "val5", "fin", "val6"], ["début", "begin"], ["fin", "end"])==[['val2', 'val3'], ['val5']]
    assert bio.decoupe_sequence(["val1", "début", "val2", "val3", "end", "val4", "fin", "begin", "val5", "fin"], ["début", "begin"], ["fin", "end"])==[['val2', 'val3'], ['val5']]
    assert bio.decoupe_sequence(["val1", "début", "val2", "val3", "end", "val4", "fin", "begin", "fin"], ["début", "begin"], ["fin", "end"])==[['val2', 'val3'], []]
    assert bio.decoupe_sequence(["début", "val2", "val3", "end", "val4", "fin", "begin", "fin"], ["début", "begin"], ["fin", "end"])==[['val2', 'val3'], []]
    assert not bio.decoupe_sequence(["val1", "début", "val2", "val3", "end", "val4", "fin", "begin", "val5", "fin", "val6"], ["début", "begin"], ["fin", "end"])==[['val2', 'val3'], []]
    assert not bio.decoupe_sequence(["val1", "début", "val2", "val3", "end", "val4", "fin", "begin", "val5", "fin"], ["début", "begin"], ["fin", "end"])==[['val2', 'val3'], []]
    assert not bio.decoupe_sequence(["val1", "début", "val2", "val3", "end", "val4", "fin", "begin", "fin"], ["début", "begin"], ["fin", "end"])==[['val2', 'val3'], ['val5']]
    assert not bio.decoupe_sequence(["début", "val2", "val3", "end", "val4", "fin", "begin", "fin"], ["début", "begin"], ["fin", "end"])==[['val2', 'val3'], ['val5']]
    print("Test de la fonction decoupe_sequence : Ok")
    

def test_codons_to_seq_codantes():
    assert bio.codons_to_seq_codantes(["CGU", "UUU", "AUG", "CGU", "AUG", "AAU", "UAA", "AUG", "GGG", "CCC",  "CGU", "UAG", "GGG"],bio.load_dico_codons_aa("data/codons_aa.json"))==[['CGU', 'AUG', 'AAU'], ['GGG', 'CCC', 'CGU']]
    assert bio.codons_to_seq_codantes(["AUG", "AAU", "UAA", "AUG", "UAG", "GGG"],bio.load_dico_codons_aa("data/codons_aa.json"))==[['AAU'], []]
    assert not bio.codons_to_seq_codantes(["CGU", "UUU", "AUG", "CGU", "AUG", "AAU", "UAA", "AUG", "GGG", "CCC",  "CGU", "UAG", "GGG"],bio.load_dico_codons_aa("data/codons_aa.json"))==[[], []]
    assert not bio.codons_to_seq_codantes([],bio.load_dico_codons_aa("data/codons_aa.json"))==[['CGU', 'AUG', 'AAU'], ['GGG', 'CCC', 'CGU']]
    assert not bio.codons_to_seq_codantes(["AUG", "AAU", "UAA", "AUG", "UAG", "GGG"],bio.load_dico_codons_aa("data/codons_aa.json"))==[[], []]
    assert not bio.codons_to_seq_codantes([],bio.load_dico_codons_aa("data/codons_aa.json"))==[['AAU'], []]
    print("Test de la fonction codons_to_seq_codantes : Ok")

    
def test_seq_codantes_to_seq_aas():
    assert bio.seq_codantes_to_seq_aas([['CGU', 'AUG', 'AAU'], ['GGG', 'CCC', 'CGU']],bio.load_dico_codons_aa("data/codons_aa.json"))==[['Arginine', 'Methionine', 'Asparagine'], ['Glycine', 'Proline', 'Arginine']]
    assert bio.seq_codantes_to_seq_aas([["AAU"],[]],bio.load_dico_codons_aa("data/codons_aa.json"))==[['Asparagine'], ['Asparagine']]
    assert not bio.seq_codantes_to_seq_aas([['CGU', 'AUG', 'AAU'], ['GGG', 'CCC', 'CGU']],bio.load_dico_codons_aa("data/codons_aa.json"))==[[], []]
    assert not bio.seq_codantes_to_seq_aas([],bio.load_dico_codons_aa("data/codons_aa.json"))==[['Arginine', 'Methionine', 'Asparagine'], ['Glycine', 'Proline', 'Arginine']]
    assert not bio.seq_codantes_to_seq_aas([['AAU'], []],bio.load_dico_codons_aa("data/codons_aa.json"))==[[], []]
    assert not bio.seq_codantes_to_seq_aas([],bio.load_dico_codons_aa("data/codons_aa.json"))==[['Asparagine'], ['Asparagine']]
    print("Test de la fonction seq_codantes_to_seq_aas : Ok")
    

def test_adn_encode_molecule():
    assert bio.adn_encode_molecule(bio.load_dico_codons_aa('data/codons_aa.json'), "CGTTTTATGCGTATGAATTAAATGGGGCCCCGTTAGGGG", ["Glycine", "Proline", "Arginine"])==True
    assert bio.adn_encode_molecule(bio.load_dico_codons_aa('data/codons_aa.json'), "CGTTTTATGCGTATGAATTAAATGGGGCCCCGTTAGGGG", ["Glycine", "Proline", "Arginine"])!=False
    assert not bio.adn_encode_molecule(bio.load_dico_codons_aa('data/codons_aa.json'), "CGTTTTATGCGTATGAATTAAATGGGGCCCCGTTAGGGG", ["Glycine", "Proline", "Arginine"])!=True
    assert not bio.adn_encode_molecule(bio.load_dico_codons_aa('data/codons_aa.json'), "CGTTTTATGCGTATGAATTAAATGGGGCCCCGTTAGGGG", ["Glycine", "Proline", "Arginine"])==False
    assert bio.adn_encode_molecule(bio.load_dico_codons_aa('data/codons_aa.json'), "CGTTTTATGCGTAGGGG", ["Glycine", "Proline", "Arginine"])==True
    assert bio.adn_encode_molecule(bio.load_dico_codons_aa('data/codons_aa.json'), "CGTTTTATGCGTAGGGG", ["Glycine", "Proline", "Arginine"])!=False
    assert not bio.adn_encode_molecule(bio.load_dico_codons_aa('data/codons_aa.json'), "CGTTTTATGCGTAGGGG", ["Glycine", "Proline", "Arginine"])!=True
    assert not bio.adn_encode_molecule(bio.load_dico_codons_aa('data/codons_aa.json'), "CGTTTTATGCGTAGGGG", ["Glycine", "Proline", "Arginine"])==False
    assert bio.adn_encode_molecule(bio.load_dico_codons_aa('data/codons_aa.json'), "GGG", ["Arginine"])==False
    assert bio.adn_encode_molecule(bio.load_dico_codons_aa('data/codons_aa.json'), "GGG", ["Arginine"])!=True
    assert not bio.adn_encode_molecule(bio.load_dico_codons_aa('data/codons_aa.json'), "GGG", ["Arginine"])!=False
    assert not bio.adn_encode_molecule(bio.load_dico_codons_aa('data/codons_aa.json'), "GGG", ["Arginine"])==True
    print("Test de la fonction adn_encode_molecule : Ok")
