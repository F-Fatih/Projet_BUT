<?php


class Controller_articleMercredi extends Controller {

    public function action_default () {
        $model = Model::getModel();
        // $nb = $model->getNbNobelPrizes();
        $this->render("articleMercredi");
    }







}