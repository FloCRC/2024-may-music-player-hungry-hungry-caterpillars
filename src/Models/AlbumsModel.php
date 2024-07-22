<?php
require_once('src/Entities/Album.php');
class AlbumsModel
{
    private PDO $db;
    public function __construct(PDO $db)
    {
        $this->db = $db;
    }
    public function getSongCount($albumId): array
    {
        $query = $this->db->prepare("SELECT `albums`.`id` AS 'album_id', `songs`.`id` AS 'song_id', COUNT(`songs`.`album_id`)
FROM `albums`
INNER JOIN `songs`
ON `albums`.`id` = `songs`.`album_id`
WHERE `albums`.`id` = $albumId;");
        $query->setFetchMode(PDO::FETCH_CLASS, Album::class);
        $query->execute();
        return $query->fetch();
    }
}

