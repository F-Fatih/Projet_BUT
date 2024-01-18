<?php


class Controller_list extends Controller {

    public function action_default() {
        $this->action_last();
    }

    public function action_last() {
        $model = Model::getModel();
        $nobelPrizes = $model->getLast();
        $this->render("list", ["liste_np" => $nobelPrizes]);
    }







}