<?php
require_once "models/PublicModel.php";

class PublicController {
    public function index() {


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
        $public = new PublicModel();

        $data["adTypes"] = $public->getAdTypes();
        $data["buildingTypes"] = $public->getBuildingTypes();
        $data["countries"] = $public->getCountries();

        $data["searchParamAdType"]      = $_GET['adType'] ?? null;;
        $data["searchParamWorkType"]    = $_GET['workType'] ?? null;;
        $data["searchParamCountry"]     = $_GET['country'] ?? null;;
        $data["searchParamCity"]        = $_GET['city'] ?? null;;
        $data["searchParamMinPrice"]    = $_GET['minPrice'] ?? null;;
        $data["searchParamMaxPrice"]    = $_GET['maxPrice'] ?? null;;
        $data["searchParamMinDate"]     = $_GET['minDate'] ?? null;;
        $data["searchParamMaxDate"]     = $_GET['maxDate'] ?? null;;

        $data["filteredSearch"] = $public->getSearch(
            $data["searchParamAdType"],
            $data["searchParamWorkType"],
            $data["searchParamCountry"],
                $data["searchParamCity"],
            $data["searchParamMinPrice"],
            $data["searchParamMaxPrice"],
            $data["searchParamMinDate"],
            $data["searchParamMaxDate"]
        );

        require_once "views/public/search.php";

    }

    public function styles() {

        $data['title'] = "Estilos";
        require_once "views/public/styles.php";

    }


}