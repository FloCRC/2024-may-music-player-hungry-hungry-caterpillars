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
}