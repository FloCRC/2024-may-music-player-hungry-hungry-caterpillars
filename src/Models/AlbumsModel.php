<?php
require_once('src/Entities/Album.php');
class AlbumsModel
{
    private PDO $db;
    public function __construct(PDO $db)
    {
        $this->db = $db;
    }

    /**
     * @param $artistId
     * @return Album[] array
     */
    public function getArtistsAlbums($artistId): array
    {
        $query = $this->db->prepare("SELECT `albums`.`id`, `albums`.`album_name`, `albums`.`artwork_url`
                                                FROM `albums`
                                                    INNER JOIN `artists`
                                                        ON `albums`.`artist_id` = `artists`.`id`
                                                            WHERE `artists`.`id` = :artistId;");
        $query->setFetchMode(PDO::FETCH_CLASS, Album::class);
        $query->execute(['artistId' => $artistId]);
        return $query->fetchAll();
    }
    public function getAlbumSongCount($albumId): Album
    {
        $query = $this->db->prepare("SELECT `albums`.`id` AS 'album_id', `albums`.`album_name`, `albums`.`artwork_url`, `songs`.`id` AS 'song_id', COUNT(`songs`.`album_id`) as 'song_count'
                                                FROM `albums`
                                                    INNER JOIN `songs`
                                                    ON `albums`.`id` = `songs`.`album_id`
                                                        WHERE `albums`.`id` = $albumId;");
        $query->setFetchMode(PDO::FETCH_CLASS, Album::class);
        $query->execute();
        return $query->fetch();
    }
}

