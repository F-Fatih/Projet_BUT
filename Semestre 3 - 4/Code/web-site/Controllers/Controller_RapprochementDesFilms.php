<?php

class Controller_RapprochementDesFilms extends Controller{

    public function action_initialisation() {
        $data=[];
        $this->render("RapprochementDesFilms", $data);
    }
    
    public function action_default(){
        $this->action_initialisation();
    }
    
    public function action_RapprochementDesFilms(){

        //Parametrage
        require_once("PATH.php");
        ini_set('memory_limit', '10G');
        set_time_limit(480);

        //Connexion DB
        $db = Model::getModel();
	$stockage=array();
        //Algorithme
        $algorithme = $db->getRapprochementDesFilms($_POST['start'], $_POST['stop']);
        if($algorithme != null) {

	$resultatAlgo = json_decode($algorithme);
        //$resultatAlgo=array("tt1260582", "nm0467558", "tt0124971", "nm0119876", "tt3681484", "tt0124971", "nm0119876", "tt3681484", "tt0124971", "nm0119876", "tt3681484");

        //Recuperation des données
        foreach ($resultatAlgo as $key => $value) {

            if ($value != null){

                //echo $value;

                if (str_starts_with($value, 'nm')){
                    $nconstData = $db->getActorInformationByNconst($value);
                    $data = array(
                        'const' => $value, 
                        'primaryname' => $nconstData[0]['primaryname'],
                        'birthyear' => $nconstData[0]['birthyear'],
                        'deathyear' => $nconstData[0]['deathyear'],
                        'primaryprofession' => $nconstData[0]['primaryprofession'],
                        "affiche" => $db->getActorPoster($value),
                        'knownfortitles' => array()
                    );
            
                    $knownfortitles = $nconstData[0]['knownfortitles'];
                    $knownfortitlesTconst = explode(",", str_replace(array('{', '}'), "", $knownfortitles)); 
                    foreach ($knownfortitlesTconst as $cle => $valeur) {
                        $tconstData = $db->getMovieInformationByTconst($valeur);
                        $data['knownfortitles'][$valeur] = $tconstData[0]['primarytitle'];
                    }
                
                }
            
                if (str_starts_with($value, 'tt')){
                  $tconstData = $db->getTitreAndRatingInformationByTconst($value);
                  
                  $data = array(
                      'const' => $value,
                      'primarytitle' => $tconstData[0]['primarytitle'],
                      'startyear' => $tconstData[0]['startyear'],
                      'genres' => $tconstData[0]['genres'],
                      'averagerating' => $tconstData[0]['averagerating'],
                      'numvotes' => $tconstData[0]['numvotes'],
                      'description' => $db->getOmdbDescription($value),
                      'affiche' => $db->getOmdbPoster($value),
                  );

                }

                $stockage[$key]=$data;

            }
        
        }

        $finalData = array(
            "data" => $stockage,
        );

	$this->render("RapprochementDesFilms", $finalData);
	} else {
	$this->render("RapprochementDesFilms", $stockage);}


        }

}

?>
