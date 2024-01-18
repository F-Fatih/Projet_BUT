<?php

class Controller_recherche extends Controller {

    public function action_default() {
        $this->action_recherche();
    }

    public function action_recherche() {
        if (isset($_GET['search'])){
            $recherche = Recherche::getRecherche();
            $dataConst = $recherche->search($_GET['search']);
            $affichage = Affichage::getAffichage();
            $result = $affichage->getInformation($dataConst);
            $this->render('recherche',$result);
        }else{
            $this->action_error('Pas de recherche fourni');
        }
    }

    public function action_affichage(){
        if(isset($_GET['search'])){
            $affichage = Affichage::getAffichage();
            if (preg_match('/^tt.*/',$_GET['search'])){
                $result = $affichage->getTitreInfoComplet($_GET['search']);
                $this->render('film',$result);
            }elseif(preg_match('/^nm.*/',$_GET['search'])){
                $result = $affichage->getPersonneInfoComplet($_GET['search']);
                $this->render('acteur',$result);

            } else{
                $this->action_error('L\'argument n\'est pas un titre ni une personne');
            }
        }else{
            $this->action_error('Pas d\'argument fourni');
        }
    }

}