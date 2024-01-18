<?php


class Controller_articleDragon extends Controller {

    public function action_default () {
        $model = Model::getModel();
        // $nb = $model->getNbNobelPrizes();
        $this->render("articleDragon");
    }







}