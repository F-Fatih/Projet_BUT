<?php


class Controller_home extends Controller {

    public function action_default () {
        $model = Model::getModel();
        // $nb = $model->getNbNobelPrizes();
        $this->render("home");
    }







}