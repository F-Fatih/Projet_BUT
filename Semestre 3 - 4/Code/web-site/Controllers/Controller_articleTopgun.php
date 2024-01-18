<?php


class Controller_articleTopgun extends Controller {

    public function action_default () {
        $model = Model::getModel();
        // $nb = $model->getNbNobelPrizes();
        $this->render("articleTopgun");
    }







}