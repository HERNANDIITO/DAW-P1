<?php

class PrivateModel {
    private $db;
    

    public function __construct() {
        $this->db = Connection::connection();
    }

    public function __destruct() {
        $this->db->close();
    }

}