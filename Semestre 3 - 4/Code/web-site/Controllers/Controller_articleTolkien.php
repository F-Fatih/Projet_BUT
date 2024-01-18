<?php


class Controller_articleTolkien extends Controller {

    public function action_default () {
        $model = Model::getModel();
        // $nb = $model->getNbNobelPrizes();
        $this->render("articleTolkien");
    }







}