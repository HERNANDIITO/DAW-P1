<?php

require_once "models/RestrictedModel.php";

class RestrictedController {

    public function cardDetails() {

        $restrictedModel = new RestrictedModel();
        $data['card'] = $restrictedModel->getCardByID($_GET['id']);
        $data['photos'] = $restrictedModel->getPhotosByID($_GET['id']);

        $data['title'] = $data['card']['Titulo'];

        require_once "views/restricted/cardDetails.php";

    }

}