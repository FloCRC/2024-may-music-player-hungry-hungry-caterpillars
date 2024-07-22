<?php
require_once('src/Entities/Artist.php');
class ArtistsModel
{
    private PDO $db;
    public function __construct(PDO $db)
    {
        $this->db = $db;
    }
}