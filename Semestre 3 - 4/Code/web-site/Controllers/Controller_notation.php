<?php


class Controller_notation extends Controller
{

    public function action_default()
    {
        $this->render("home");
    }

    public function action_notation()
    {
        if (isset($_SESSION['email'])) {
            if (isset($_POST['tconst']) and isset($_POST['rating'])) {
                $model = Model::getModel();
                $result = $model->insererNotation($_SESSION['email'], $_POST['tconst'], $_POST['rating']);
                header("Location: ./index.php?controller=recherche&action=affichage&search=".$_POST['tconst']);
                if (!$result) {
                    $this->render("home", ['error' => 'Une erreur imprévue est apparu, veuillez contacter l\'administrateur.']);
                }
            }else{
                $this->render("home", ['error' => 'Une erreur imprévue est apparu, veuillez contacter l\'administrateur.']);
            }
        } else {
            $this->render("auth", ['error' => 'Connectez vous afin de noter']);
        }
    }

}