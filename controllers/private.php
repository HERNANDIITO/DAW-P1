<?php
require_once "models/PublicModel.php";

class PrivateController {

    public function index() {


        $public = new PublicModel();
        $newest = $public->getNewest();

        $data['title'] = "Página principal";
        $data['newest'] = $newest;

        require_once "views/public/public.php";

    }
    
}