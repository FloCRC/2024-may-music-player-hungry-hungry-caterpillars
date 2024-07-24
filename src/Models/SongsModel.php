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

    /**
     * @return Song[] array
     */
    public function getRecentSong(): array
    {
        $query=$this->db->prepare("SELECT `songs`.`id` AS id, `song_name`, `artist_name`, `length`, `album_id`, `play_count`, `time_played`,`favourite`,`artists`.`id` AS `artist_id`
            FROM `albums`
            INNER JOIN `artists`
            ON `artist_id` = `artists`.`id`
            INNER JOIN `songs`
            ON `albums`.`id` = `album_id`
            WHERE `time_played` > 0
            ORDER BY `time_played` DESC LIMIT 5;");
        $query->setFetchMode(PDO::FETCH_CLASS, Song::class);
        $query->execute([]);
        return $query->fetchAll();
    }

    public function updateTimePlayed(int $songId): bool
    {
        $query=$this->db->prepare("UPDATE `songs`
            SET `time_played` = CURRENT_TIMESTAMP
            WHERE `id` = :songId;");
        return $query->execute(['songId'=>$songId]);
    }
}