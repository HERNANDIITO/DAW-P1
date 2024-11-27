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

}