<?php
require_once('src/Entities/Song.php');
class SongsModel
{
    private PDO $db;
    public function __construct(PDO $db)
    {
        $this->db = $db;
    }
}