<?php

class Connection {
    public static function connection(): mysqli {
        $connection = new mysqli("localhost:3306", "admin", "admin", "fotocasa2");
        return $connection;
    }
}