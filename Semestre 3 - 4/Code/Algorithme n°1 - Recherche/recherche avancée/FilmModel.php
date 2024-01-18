<?php
class FilmModel {
    private $db;
    private $personnes;
    private $films;
    private $limit = 10;
    private $offset = 0;
    public function __construct($db) {
        $this->db = $db;
    }
    public function search($name, $birth_date, $sort_by, $limit, $offset) {
        try {
            $queryFilm ="SELECT tconst, primarytitle FROM titlebasics WHERE similarity(lower(unaccent(primarytitle)), lower(unaccent(:name))) > 0.4";
            $resultFilms = $this->db->prepare($queryFilm);
            $resultFilms->bindValue(':name', $this->db->quote($name));
            $resultFilms->execute();
            $this->films = $resultFilms->fetchAll(PDO::FETCH_ASSOC);

            $queryPerso = "SELECT nconst, primaryname, birthyear FROM namebasics WHERE similarity(lower(unaccent(primaryname)), lower(unaccent(:name))) > 0.4 AND birthyear >= :birth_date";
            $resultPerso = $this->db->prepare($queryPerso);
            $resultPerso->bindValue(':name', $this->db->quote($name));
            $resultPerso->bindValue(':birth_date', $birth_date);
            if ($sort_by == 'name') {
                $queryPerso .= " ORDER BY primaryname";
            }
            else if($sort_by == 'birth_date'){
                $queryPerso .= " ORDER BY birthyear";
            }
            $this->limit = $limit;
            $this->offset = $offset;
            $resultPerso->bindValue(':limit', $this->limit, PDO::PARAM_INT);
            $resultPerso->bindValue(':offset', $this->offset, PDO::PARAM_INT);
            $resultPerso->execute();
            $this->personnes = $resultPerso->fetchAll(PDO::FETCH_ASSOC);

        } catch (Exception $e) {
            echo $e->getMessage();
        }
        return $this->getResult();
    }
    public function getResult() {
                return ['titres' => $this->films, 'personnes'=>$this->personnes];
    }
}

