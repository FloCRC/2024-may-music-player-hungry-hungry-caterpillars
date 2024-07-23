<?php
require_once('src/Entities/Artist.php');
class ArtistsModel
{
    private PDO $db;
    public function __construct(PDO $db)
    {
        $this->db = $db;
    }
    public function getArtistsAlbumCount(int $artistId): Artist
    {
        $query = $this->db->prepare("SELECT COUNT(`albums`.`id`) AS 'album_count'
                                                FROM `artists`
                                                    INNER JOIN `albums`
                                                        ON `artists`.`id` = `albums`.`artist_id`
                                                            WHERE `artists`.`id` = :artistId;");
        $query->setFetchMode(PDO::FETCH_CLASS, Artist::class);
        $query->execute(['artistId' => $artistId]);
        return $query->fetch();
    }

    /**
     * @return Artist[] array
     */
    public function getArtistsSummary(): array
    {
        $query = $this->db->prepare('SELECT `artists`.`id`, `artists`.`artist_name`
                                                FROM `artists` ORDER BY RAND() LIMIT 3;');
        $query->setFetchMode(PDO::FETCH_CLASS, Artist::class);
        $query->execute();
        return $query->fetchAll();
    }
    public function getAllArtists(): array
    {
        $query = $this->db->prepare('SELECT `artists`.`id`, `artists`.`artist_name`
                                                FROM `artists`;');
        $query->setFetchMode(PDO::FETCH_CLASS, Artist::class);
        $query->execute();
        return $query->fetchAll();
    }

    public function getArtistAlbumArtworks(int $artistId): array
    {
        $query = $this->db->prepare('SELECT `artists`.`id`, `albums`.`artwork_url`
                                                FROM `artists`
                                                    INNER JOIN `albums`
                                                        ON `artists`.`id` = `albums`.`artist_id`
                                                            WHERE `artists`.`id` = :artistId
                                                                    LIMIT 2;');
        $query->setFetchMode(PDO::FETCH_CLASS, Artist::class);
        $query->execute(['artistId' => $artistId]);
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