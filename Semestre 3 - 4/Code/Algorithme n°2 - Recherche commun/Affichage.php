<?php

    class Affichage{

        private $result;

        private $model;

        private static $instance = null;

        private function __construct(){
            $this->model = Model::getModel();
            
        }

        /**
         * Méthode permettant de récupérer un modèle car le constructeur est privé (Implémentation du Design Pattern Singleton)
         */
        public static function getAffichage()
        {
            if (self::$instance === null) {
                self::$instance = new self();
            }
            return self::$instance;
        }


        public function getPersonneInfoComplet($nconst){
            $data = array();

            try{

                $personne = $this->model->getPersonneInformation($nconst);
                if (empty($personne)){
                    return array();
                }
                $data['personne'] = $personne[0];
                $data['personne']['poster'] = $this->model->getActorPoster($nconst);
                $data['personne']['primaryprofession'] = str_replace(['{','}'],"",$data['personne']['primaryprofession']);
                $knwonForTitles = array();
                if ($data['personne']['knownfortitles'] != null){

                    $data['personne']['knownfortitles'] = str_replace(['{','}'],"",$data['personne']['knownfortitles']);
                    $data['personne']['knownfortitles'] = explode(",",$data['personne']['knownfortitles']);
                    foreach($data['personne']['knownfortitles'] as $tconst){
                        $dataTitre = $this->getTitreInfo($tconst);
                        if (!empty($dataTitre)){
                            $knwonForTitles[] = $dataTitre['titre'];
                        }
                    }
                }
                $data['personne']['titres'] = $knwonForTitles;



            }catch (Exception $e){
                echo 'Exception reçue : '. $e->getMessage(). "\n";

            }

            return $data;
        }

        public function getPersonneInfo($nconst){
            $data = array();

            try{

                $personne = $this->model->getPersonneInformation($nconst);
                if (empty($personne)){
                    return array();
                }
                $data['personne'] = $personne[0];
                $data['personne']['poster'] = $this->model->getActorPoster($nconst);
                $data['personne']['primaryprofession'] = str_replace(['{','}'],"",$data['personne']['primaryprofession']);
                if ($data['personne']['knownfortitles'] != null){
                    $data['personne']['knownfortitles'] = str_replace(['{','}'],"",$data['personne']['knownfortitles']);
                    $data['personne']['knownfortitles'] = explode(",",$data['personne']['knownfortitles']);
                }

            }catch (Exception $e){
                echo 'Exception reçue : '. $e->getMessage(). "\n";

            }

            return $data;
        }

        public function getTitreInfo($tconst){
            $data = array();

            try{

                $titre = $this->model->getTitreAndRatingInformationByTconst($tconst);
                if (empty($titre)){
                    return array();
                }
                $data['titre'] = $titre[0];
                if (isset($data['titre']['genres'])){
                    $data['titre']['genres'] = str_replace(['{','}'],"",$data['titre']['genres']);
                }else{
                    $data['titre']['genres'] = "Pas de genre pour ce film.";
                }
                
                $data['titre']['poster'] = $this->model->getOmdbPoster($tconst);
                $data['titre']['description'] = $this->model->getOmdbDescription($tconst);

            }catch (Exception $e){
                echo 'Exception reçue : '.  $e->getMessage(). "\n";

            }

            return $data;
        }

        public function getTitreInfoComplet($tconst){
            $data = array();

            try{

                $titre = $this->model->getTitreAndRatingInformationByTconst($tconst);
                if (empty($titre)){
                    return array();
                }
                $data['titre'] = $titre[0];
                $acteurs = $this->model->getPersonneByTconst($tconst);
                $dataActeurs = array();
                if (!empty($acteurs)){
                    foreach ($acteurs as $personne){
                        $dataActeur = $this->getPersonneInfo($personne['nconst']);
                        if (!empty($dataActeur)){
                            $dataActeurs[] = $dataActeur['personne'];
                        }
                    }
                }
                $data['titre']['personnes'] = $dataActeurs;
                $data['titre']['genres'] = str_replace(['{','}'],"",$data['titre']['genres']);
                $data['titre']['poster'] = $this->model->getOmdbPoster($tconst);
                $data['titre']['description'] = $this->model->getOmdbDescription($tconst);

                $data['notationDraCorporation'] = $this->model->getNotationDraCorportaion($tconst);
                if(empty($data['notationDraCorporation'])){
                    unset($data['notationDraCorporation']);
                }else{
                    $data['notationDraCorporation'] =  $data['notationDraCorporation'][0];
                }

                if (isset($_SESSION['email'])){
                    $data['noteGiven'] =  $this->model->getNotationByUserOnTconst($_SESSION['email'],$tconst);
                    if (empty($data['noteGiven'])){
                        unset($data['noteGiven']);
                    }else{
                        $data['noteGiven'] = $data['noteGiven'][0];
                    }
                }

            }catch (Exception $e){
                echo 'Exception reçue : '.  $e->getMessage(). "\n";
                $data = null;
            }

            return $data;
        }

        public function getInformation($recherche){
            $data = array();

            try{
                
                $dataPersonnes = array();
                $dataTitres = array();
                if (isset($recherche['personnes'])){
                    foreach ($recherche['personnes'] as $personne){
                        $dataUniquePersonne = $this->getPersonneInfo($personne['nconst']);
                        if (!empty($dataUniquePersonne)){
                            $dataPersonnes[] = $dataUniquePersonne['personne'];
                        }
                        
                    }
                    $data['personnes'] = $dataPersonnes;
                }
                
                if (isset($recherche['titres'])){
                    foreach ($recherche['titres'] as $titre){
                        $dataUniqueTitre = $this->getTitreInfo($titre['tconst']);
                        if (!empty($dataUniqueTitre)){
                            $dataTitres[] = $dataUniqueTitre['titre'];
                        }
                        
                    }
                    $data['titres'] = $dataTitres;
                }
                
            }catch (Exception $e){
                echo 'Exception reçue : '.  $e->getMessage(). "\n";

            }

            return $data;
            
        }

        public function getInformationCommun($recherche){
            $data = array();

            try{
                
                $dataPersonnes = array();
                $dataTitres = array();
                if (isset($recherche['personnes'])){
                    foreach ($recherche['personnes'] as $nconst){
                        $dataUniquePersonne = $this->getPersonneInfo($nconst);
                        if (!empty($dataUniquePersonne)){
                            $dataPersonnes[] = $dataUniquePersonne['personne'];
                        }
                        
                    }
                    $data['personnes'] = $dataPersonnes;
                }
                
                if (isset($recherche['titres'])){
                    foreach ($recherche['titres'] as $tconst){
                        $dataUniqueTitre = $this->getTitreInfo($tconst);
                        if (!empty($dataUniqueTitre)){
                            $dataTitres[] = $dataUniqueTitre['titre'];
                        }
                        
                    }
                    $data['titres'] = $dataTitres;
                }
                
            }catch (Exception $e){
                echo 'Exception reçue : '.  $e->getMessage(). "\n";

            }

            return $data;
            
        }

    }

