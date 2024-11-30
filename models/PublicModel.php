<?php

class PublicModel {
    private $db;
    

    public function __construct() {
        $this->db = Connection::connection();
    }

    public function getNewest(): array {
        $query = "SELECT * FROM Anuncios ORDER BY FRegistro DESC LIMIT 5";
        $result = $this->db->query($query);

        $newest = array();
        while ($row = $result->fetch_assoc()) {
            $newest[] = $row;
        }

        return $newest;
    }

    public function getSearch($adType, $workType, $country, $city, $minPrice, $maxPrice, $minDate, $maxDate): array {
        // Construir consulta dinámica
        $query = "SELECT * FROM Anuncios WHERE 1=1";
        if ($adType) {
            $query .= " AND TAnuncio = " . intval($adType);
        }
        if ($workType) {
            $query .= " AND TVivienda = " . intval($workType);
        }
        if ($city) {
            $query .= " AND LOWER(Ciudad) LIKE LOWER('%" . $this->db->real_escape_string($city) . "%')";
        }
        if ($country) {
            $query .= " AND Pais = " . intval($country);
        }
        if ($minPrice) {
            $query .= " AND Precio >= " . floatval($minPrice);
        }
        if ($maxPrice) {
            $query .= " AND Precio <= " . floatval($maxPrice);
        }
        if ($minDate) {
            $query .= " AND FRegistro >= '" . $this->db->real_escape_string($minDate) . "'";
        }
        if ($maxDate) {
            $query .= " AND FRegistro <= '" . $this->db->real_escape_string($maxDate) . "'";
        }

        $resultados = array();

        $result = $this->db->query($query);
        if ($result && mysqli_num_rows($result) > 0) {
            while ($row = $result->fetch_assoc()) {
                $resultados[] = $row;
            }
        }
        
        return $resultados;
    }

    public function getAdTypes() {
        $queryAnuncios = "SELECT IdTAnuncio, NomTAnuncio FROM TiposAnuncios";
        $result = $this->db->query($queryAnuncios);
        $anuncios = [];
        if ($result && mysqli_num_rows($result) > 0) {
            while ($row = $result->fetch_assoc()) {
                $anuncios[] = $row;
            }
        }

        return $anuncios;
    }

    public function getBuildingTypes() {
        $queryViviendas = "SELECT IdTVivienda, NomTVivienda FROM TiposViviendas";
        $result = $this->db->query($queryViviendas);
        $viviendas = [];
        if ($result && mysqli_num_rows($result) > 0) {
            while ($row = $result->fetch_assoc()) {
                $viviendas[] = $row;
            }
        }

        return $viviendas;
    }

    public function getCountries() {
        $queryPaises = "SELECT IdPais, Nombre FROM Paises";
        $result = $this->db->query($queryPaises);
        $paises = [];

        if ($result && mysqli_num_rows($result) > 0) {
            while ($row = $result->fetch_assoc()) {
                $paises[] = $row;
            }
        }

        return $paises;
    }

    function isAuthorized($username, $password):array|bool {
        $query = "SELECT IdUsuario, NomUsuario, Email, Sexo, FNacimiento, Ciudad, P.Nombre AS Pais, Foto, FRegistro, E.Nombre AS Estilo FROM Usuarios U JOIN Paises P ON U.Pais = P.IdPais LEFT JOIN Estilos E ON U.Estilo = E.IdEstilo WHERE U.NomUsuario = ? AND U.Clave = ?";
        
        $stmt = $this->db->prepare( $query );
        $stmt->bind_param("ss", $username, $password);
        $stmt->execute();

        $result = $stmt->get_result();
        $user = $result->fetch_assoc();

        $stmt->close();

        if ( $user ) {
            return $user;
        }
    
        return false;
    }

    public function __destruct() {
        $this->db->close();
    }

}