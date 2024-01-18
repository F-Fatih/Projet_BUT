<?php
class Recherche {
    private $db;
    private $personnes;
    private $films;
    private static $instance = null;
 

    private function __construct() {
        $this->db = Model::getModel();
        $this->personnes = array();
        $this->films = array();
    }

    public static function getRecherche()
        {
            if (self::$instance === null) {
                self::$instance = new self();
            }
            return self::$instance;
        }


    public function search($arguRecherche) {
        try {
           
            $this->films = $this->db->rechercheTitreAvecArgu($arguRecherche);
            
            $this->personnes = $this->db->recherchePersonneAvecArgu($arguRecherche);

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

