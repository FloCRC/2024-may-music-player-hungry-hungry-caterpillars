<?php
require_once('src/Entities/Artist.php');
class ArtistsModel
{
    private PDO $db;
    public function __construct(PDO $db)
    {
        $this->db = $db;
    }

    /**
     * @param string $artistID
     * @return Artist[]
     */
    public function getArtistSongsAlbumByID(int $artistID, int $artistAlbum):Array
    {
        $query = $this->db->prepare("SELECT `artist_name`, `album_name`, `artwork_url`, `song_name`, `length` , `songs`.`id` AS 'songID'
            FROM `albums`
                INNER JOIN `artists`
                    ON `artists`.`id` = `albums`.`artist_id`
                INNER JOIN `songs`
                    ON `songs`.`album_id` = `albums`.`id`
                    WHERE `artists`.`id` = :artistID AND `album_id` = :artistAlbum
                    ORDER BY `artist_name`,`album_name`;");
        $query->setFetchMode(PDO::FETCH_CLASS,Artist::class);
        $query->execute(['artistID'=> $artistID, 'artistAlbum'=> $artistAlbum]);
        return $query->fetchAll();
    }

    /**
     * @param $artistID
     * @return Artist[]
     */
    public function getArtistAlbumList($artistID):Array
    {
        $query = $this->db->prepare("SELECT `album_name`
            FROM `albums`
                INNER JOIN `artists`
                    ON `artists`.`id` = `albums`.`artist_id`
                INNER JOIN `songs`
                    ON `songs`.`album_id` = `albums`.`id`
                    WHERE `artists`.`id` = :artistID
                    GROUP BY `album_name`
                    ORDER BY `artist_name`,`album_name`;");
        $query->setFetchMode(PDO::FETCH_CLASS,Artist::class);
        $query->execute(['artistID'=> $artistID]);
        return $query->fetchAll();
    }
}