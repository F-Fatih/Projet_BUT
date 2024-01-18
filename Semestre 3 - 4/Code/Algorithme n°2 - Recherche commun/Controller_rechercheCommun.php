<?php

class Controller_rechercheCommun extends Controller
{

    public function action_default()
    {
        $this->action_creationRecherche();
    }

    public function action_creationRecherche()
    {
        $_SESSION['type'] = 'personnes';
        $rechercheCommun = RechercheCommun::getRechercheCommun();
        $this->render("rechercheCommun", ['type' => $_SESSION['type']]);
    }

    public function action_rechercheCommun()
    {
        try {
            $rechercheCommun = RechercheCommun::getRechercheCommun();
            $dataConst = array();
            if (isset($_POST['listRecherche'])) {
                $type = $_SESSION['type'];
                $list = json_decode($_POST['listRecherche'], true);
                $dataConst = $rechercheCommun->rechercheCommun($list);
                $affichage = Affichage::getAffichage();
                $result = $affichage->getInformationCommun($dataConst);
                $result['type'] = $type;
                $result['listRecherche'] = $list;
                $result['noResult'] = empty($dataConst);
                $this->render('rechercheCommun', $result);
            }
            else{
                $this->render("home", ['error' => 'Une erreur est apparue, veuillez contacter les admins']);
            }

        } catch (Exception $e) {
            $this->render("home", ['error' => 'Une erreur est apparue, veuillez contacter les admins']);
        }



    }

    public function action_changementRecherche()
    {

        try {
            $dataConst = array();
            $rechercheCommun = RechercheCommun::getRechercheCommun();
            $rechercheCommun->changementType();
            $affichage = Affichage::getAffichage();
            $result = $affichage->getInformationCommun($dataConst);
            $result['type'] = $_SESSION['type'];
            $this->render('rechercheCommun', $result);

        } catch (Exception $e) {
            echo 'Exception reçue : ' . $e->getMessage() . "\n";
            $this->render("home", ['error' => 'Une erreur est apparue, veuillez contacter les admins']);
        }



    }

}