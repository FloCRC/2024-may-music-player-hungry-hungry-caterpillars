<?php
require_once('src/Entities/Album.php');
class AlbumsModel
{
    private PDO $db;
    public function __construct(PDO $db)
    {
        $this->db = $db;
    }
}