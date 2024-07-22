<?php
require_once('src/Entities/Artist.php');
class ArtistsModel
{
    private PDO $db;
    public function __construct(PDO $db)
    {
        $this->db = $db;
    }
    public function getArtists(): array
    {
        $query = $this->db->prepare('SELECT `artists`.`id`, `artists`.`artist_name`, `albums`.`id`, `albums`.`album_name`, `albums`.`artwork_url`, `songs`.`song_name`
                                                FROM `artists`
                                                    INNER JOIN `albums`
                                                    ON `artists`.`id`=`albums`.`artist_id`
                                                        INNER JOIN `songs`
                                                        ON `albums`.`id`=`songs`.`album_id`;');
        $query->setFetchMode(PDO::FETCH_CLASS, Artist::class);
        $query->execute();
        return $query->fetchAll();
    }
//    public function getArtists(): array
//    {
//        $query = $this->db->prepare('SELECT `artists`.`id`, `artists`.`artist_name`, `albums`.`id`, `albums`.`album_name`, `albums`.`artwork_url`, `songs`.`song_name`
//                                                FROM `artists`
//                                                    INNER JOIN `albums`
//                                                    ON `artists`.`id`=`albums`.`artist_id`
//                                                        INNER JOIN `songs`
//                                                        ON `albums`.`id`=`songs`.`album_id`;');
//        $query->setFetchMode(PDO::FETCH_CLASS, Artist::class);
//        $query->execute();
//        return $query->fetchAll();
//    }
}