<?php

class RestrictedModel {
    private $db;

    public function __construct() {
        $this->db = Connection::connection();
    }

    public function getCardByID($cardID): array|bool|null {
        $query = "
            SELECT 
                A.IdAnuncio, 
                A.Titulo, 
                A.Foto, 
                A.Precio, 
                A.Texto, 
                A.Ciudad, 
                A.Pais, 
                A.Superficie, 
                A.Nhabitaciones, 
                A.Nbanyos, 
                A.Planta, 
                A.Anyo, 
                A.FRegistro, 
                A.Usuario, 
                TA.NomTAnuncio, 
                TV.NomTVivienda, 
                U.NomUsuario
            FROM 
                Anuncios A
            JOIN 
                TiposAnuncios TA ON A.TAnuncio = TA.IdTAnuncio
            JOIN 
                TiposViviendas TV ON A.TVivienda = TV.IdTVivienda
            JOIN 
                Usuarios U ON A.Usuario = U.IdUsuario
            WHERE 
                A.IdAnuncio = ?
        ";

        $sentence = $this->db->prepare( $query );
        $sentence->bind_param("i", $cardID );
        $sentence->execute();

        $result = $sentence->get_result();
        $card = $result->fetch_assoc();
        $sentence->close();

        return $card;

    }

    public function getPhotosByID( $cardID ): array|bool|null {
        $query = "
            SELECT 
                F.IdFoto, 
                F.Titulo, 
                F.Fichero, 
                F.Alternativo, 
                F.Anuncio
            FROM 
                Fotos F
            WHERE 
                F.Anuncio = ?
        ";

        $sentence = $this->db->prepare( $query );
        $sentence->bind_param("i", $cardID );
        $sentence->execute();

        $result = $sentence->get_result();

        $photos = [];

        while ($row = $result->fetch_assoc()) {
            $photos[] = $row;
        }
        
        $sentence->close();

        return $photos;
    }

    public function __destruct() {
        $this->db->close();
    }
}