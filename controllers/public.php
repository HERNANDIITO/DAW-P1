<?php

class PublicController {
    public function index() {
        require_once "models/PublicModel.php";

        $public = new PublicModel();
        $newest = $public->getNewest();

        $data['title'] = "Página principal";
        $data['newest'] = $newest;

        require_once "views/public/public.php";
    }

    public function accessInfo() {

        $data['title'] = "Información sobre accesibilidad";
        require_once "views/public/accessInfo.php";

    }

    public function cookiesInfo() {

        $data['title'] = "Información sobre cookies";
        require_once "views/public/cookiesInfo.php";

    }

    public function errorRegister() {

        $data['title'] = "Error en el registro";
        require_once "views/public/errorRegister.php";

    }

    public function latest() {

        $data['title'] = "Historial de visitas";
        require_once "views/public/latest.php";

    }

    public function login() {

        $data['title'] = "Inicio de sesión";
        require_once "views/public/login.php";

    }

    public function register() {

        $data['title'] = "Registro";
        require_once "views/public/register.php";

    }

    public function search() {

        $data['title'] = "Búsqueda";
        require_once "views/public/search.php";

    }

    public function styles() {

        $data['title'] = "Estilos";
        require_once "views/public/styles.php";

    }


}