<?php


class Controller_auth extends Controller
{

    public function action_default()
    {
        $this->render("auth");
    }

    public function action_verifyCredentials()
    {
        if (isset($_POST['email']) and isset($_POST['passw'])) {
            $model = Model::getModel();
            $result = $model->verifyCredentials($_POST['email'], $_POST['passw']);
            if ($result) {
                $_SESSION["name"] = $model->getName($_POST['email']);
                $_SESSION["email"] = $_POST["email"];
                header("Location: ./index.php?controller=home");
                exit();
            } else {
                $this->render("auth", ['error' => 'Votre email ou mot de passe est incorrect. Essayez à nouveau.']);
            }
        } else {
            $this->render("auth", ['error' => 'Il y a eu une erreur, essayez à nouveau.']);
        }
    }

    public function action_createAccount()
    {
        if (isset($_POST['email']) and isset($_POST['passw']) and isset($_POST['username'])) {
            $model = Model::getModel();
            $result = $model->createAccount($_POST['email'], $_POST['passw'], $_POST['username']);
            if ($result) {
                $_SESSION["name"] = $model->getName($_POST['email']);
                $_SESSION["email"] = $_POST["email"];
                header("Location: ./index.php?controller=home");
                exit();
            } else {
                $this->render("auth", ['error' => 'Avez-vous déjà un compte ? Essayez de vous connecter.']);
            }
        } else {
            $this->render("auth", ['error' => 'Il y a eu une erreur lors de la connexion.']);
        }
    }

    public function action_disconnect()
    {
        session_destroy();
        session_start();
        header("Location: ./index.php?controller=auth");
        exit();
    }
}
