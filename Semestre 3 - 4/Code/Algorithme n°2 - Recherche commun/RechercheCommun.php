<?php

    class RechercheCommun {
        
        private $model; //La connexion avec la base de données
        private $resultat; //Tableau avec le résultat final de la recherche

        private static $instance = null;

        private function __construct(){
            /*
                Initialisation des variables
            */
            $this->model = Model::getModel();
            $this->resultat = array();
        }

        public static function getRechercheCommun()
        {
            if (self::$instance === null) {
                self::$instance = new self();
            }
            return self::$instance;
        }

        public function rechercheCommun($arrayConst){

            try{
                $first = true;
                foreach($arrayConst as $const){
                    $resultatParRequete = [];
                    if($_SESSION['type'] == 'titres'){
                        $resultatRequeteSql = $this->model->getPersonneByTconst($const);//tableau : { indice => [nconst]}
                    }else{
                        $resultatRequeteSql = $this->model->getTitreByNconst($const);//tableau : { indice => [tconst]}
                    }
                    

                    foreach ($resultatRequeteSql as $val ){ 
                        $resultatParRequete[] = $val[0];
                    }
                    
                    if($first){
                        $this->resultat = $resultatParRequete;
                        $first = false;
                    }else{
                        
                        $this->resultat = array_intersect($this->resultat,$resultatParRequete); //Intersection du résultat présent avec la nouvelle recherche
                        
                        if (empty($this->resultat)){
                            break;
                        }
                    }
                }

                


            }catch (Exception $e){
                echo 'Exception reçue : '.  $e->getMessage(). "\n";

            }
            return $this->getRecherche();

        }

        public function getRecherche(){
            /*
                Renvoie le résultat actuel des films ou personnes commun
            */
            
            return [ $this->getResultType() =>$this->resultat];
        }

        private function getResultType(){
            if ($_SESSION['type'] == 'personnes'){
                return 'titres';
            }else{
                return 'personnes';
            }
        }

        public function changementType(){
            /*
                in : Personne ou Titre
                Change le type de recherche commun et remets tout à 0
            */
            try {
                $this->resultat = array();
                if ($_SESSION['type'] == 'personnes'){
                    $_SESSION['type'] = 'titres';
                }else{
                    $_SESSION['type'] = 'personnes';
                }
                
                
            }catch (Exception $e){
                echo 'Exception reçue : '.  $e->getMessage(). "\n";
            }
        }

    }

