<?php
class FilmModel {
    private $db;
    private $personnes;
    private $films;
 

    public function __construct($db) {
        $this->db = $db;
    }

public function search($arguRecherche) {
    try {
        $start = microtime(true);
        $queryFilm ="SELECT tconst, primarytitle FROM titlebasics WHERE similarity(lower(unaccent(primarytitle)), lower(unaccent(:arg))) > 0.4";
        $resultFilms = $this->db->prepare($queryFilm);
        $resultFilms->bindValue(':arg', $this->db->quote($arguRecherche));
        $resultFilms->execute();
        $this->films = $resultFilms->fetchAll(PDO::FETCH_ASSOC);
        

        $queryPerso = "SELECT nconst, primaryname FROM namebasics WHERE similarity(lower(unaccent(primaryname)), lower(unaccent(:arg))) > 0.4";
        $resultPerso = $this->db->prepare($queryPerso);
        $resultPerso->bindValue(':arg', $this->db->quote($arguRecherche));
        $resultPerso->execute();
        $this->personnes = $resultPerso->fetchAll(PDO::FETCH_ASSOC);
        $end = microtime(true);
        $execution_time = ($end - $start);
        echo "Temps d'exécution : " . $execution_time . " secondes";
  
    }
    catch(Exception $e){
        echo $e->getMessage();
        
    }
    return $this->getResult();
}




    public function getResult() {
        return ['titres' => $this->films, 'personnes'=>$this->personnes];
        
    }
    
}
?>

