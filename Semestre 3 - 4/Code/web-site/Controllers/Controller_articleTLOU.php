<?php


class Controller_articleTLOU extends Controller {

    public function action_default () {
        $model = Model::getModel();
        // $nb = $model->getNbNobelPrizes();
        $this->render("articleTLOU");
    }







}