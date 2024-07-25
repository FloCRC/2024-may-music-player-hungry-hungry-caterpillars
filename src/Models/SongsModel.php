<?php
declare(strict_types=1);
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
        $query->execute(['songId'=>$songId]);
        return $query->fetch();
    }

    public function updateFavourite(int $songId): bool
    {
        $query=$this->db->prepare("UPDATE `songs`
	SET `favourite` = CASE `favourite`
							WHEN 1 THEN 0
							WHEN 0 THEN 1
						END
		WHERE `id` = :songId;");
        return $query->execute(['songId'=>$songId]);
    }

    /**
     * @return Song[]
     */
    public function getFavoritedSongsByArtistId(int $artistID): array
    {
        $query = $this->db->prepare("SELECT `artists`.`id` AS 'artistID', `songs`.`id`, `songs`.`song_name`, `songs`.`play_count`, `songs`.`length`, `songs`.`favourite`
                                                FROM `songs`
                                                    INNER JOIN `albums`
                                                        ON `albums`.`id` = `songs`.`album_id`
                                                            INNER JOIN `artists`
                                                                ON `artists`.`id` = `albums`.`artist_id`
                                                                    WHERE `artists`.`id` = :artistID AND `songs`.`favourite` = 1;");
        $query->setFetchMode(PDO::FETCH_CLASS, Song::class);
        $query->execute(['artistID' => $artistID]);
        return $query->fetchAll();
    }

    /**
     * @return Song[] array
     */
    public function getRecentSong(): array
    {
        $query=$this->db->prepare("SELECT `songs`.`id` AS id, `song_name`, `artist_name`, `length`, `album_id`, `play_count`, `time_played`,`favourite`,`artists`.`id` AS `artistID`
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

    /**
     * @return Song[]
     */
    public function searchBySongName(string $search): array {
        $query=$this->db->prepare("SELECT `song_name`,`artist_name`, `artist_id` AS 'artistID', `songs`.`id` AS 'id', `favourite`, `length`, `play_count`
                                            FROM `albums`
                                            INNER JOIN `artists`
                                            ON `albums`.`artist_id` = `artists`.`id`
                                            INNER JOIN `songs`
                                            ON `songs`.`album_id`= `albums`.`id`
                                            WHERE `song_name` LIKE :search
                                            ORDER BY `artist_name`;");
        $query->setFetchMode(PDO::FETCH_CLASS, Song::class);
        $query->execute(['search'=>"%$search%"]);
        return $query->fetchAll();
    }
}