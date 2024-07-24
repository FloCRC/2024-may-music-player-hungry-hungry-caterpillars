<?php
require_once('src/Entities/Song.php');
class SongsModel
{
    private PDO $db;

    public function __construct(PDO $db)
    {
        $this->db = $db;
    }

    public function updatePlayCount(int $songId): bool
    {
        $query=$this->db->prepare("UPDATE `songs`
        SET `play_count`=`play_count`+1
        WHERE `id` = :songsId;");

        return $query->execute(['songsId'=>$songId]);
    }

    public function getSongById(int $songId): Song
    {
        $query=$this->db->prepare("SELECT `id`, `song_name`, `length`, `album_id`, `play_count`, `time_played`, `favourite`
            FROM `songs`
            WHERE `id` = :songId;");
        $query->setFetchMode(PDO::FETCH_CLASS, Song::class);
        $query->execute(['songsId'=>$songId]);
        return $query->fetch();
    }
}