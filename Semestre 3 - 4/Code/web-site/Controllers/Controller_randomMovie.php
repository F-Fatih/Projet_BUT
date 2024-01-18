<?php

class Controller_randomMovie extends Controller{

    public function action_initialisation() {
        $db = Model::getModel();
        $data=[
            'allgenres' => $db->getGenresMovie()
        ];
        $this->render("randomMovie", $data);
    }
    
    public function action_default(){
        $this->action_initialisation();
    }
    
    public function action_randomMovie(){
        $db = Model::getModel();
        $genres = $_POST['genres'];

        $tconst = $db->getRandomMovie($genres);
        $tconstData = $db->getMovieAndRatingInformationByTconst($tconst[0]['tconst']);

        $data = array(
            'const' => $tconst[0]['tconst'],
            'primarytitle' => $tconst[0]['primarytitle'],
            'startyear' => $tconst[0]['startyear'],
            'genres' => $tconst[0]['genres'],
            'description' => $db->getOmdbDescription($tconst[0]['tconst']),
            'affiche' => $db->getOmdbPoster($tconst[0]['tconst']),
            'allgenres' => $db->getGenresMovie(),
        );

        if (count($tconstData) > 0) {
            $data['averagerating'] = $tconstData[0]['averagerating'];
            $data['numvotes'] = $tconstData[0]['numvotes'];
        } else {
            $data['averagerating'] = "x";
            $data['numvotes'] = "x";
        }

        $this->render("randomMovie", $data);
    }

}

?>
