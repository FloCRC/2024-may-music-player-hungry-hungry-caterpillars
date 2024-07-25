<?php

declare(strict_types=1);

use Example\Entities\Album;

require_once('src/Entities/Album.php');
class AlbumsModel
{
    private PDO $db;

    public function __construct(PDO $db)
    {
        $this->db = $db;
    }

    /**
     * @return Album[] array
     */
    public function getArtistsAlbums(int $artistId): array
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

    public function getAlbumSongCount(int $albumId): Album
    {
        $query = $this->db->prepare("SELECT `albums`.`id` AS 'album_id', `albums`.`album_name`, `albums`.`artwork_url`, `songs`.`id` AS 'song_id', COUNT(`songs`.`album_id`) as 'song_count'
                                                FROM `albums`
                                                    INNER JOIN `songs`
                                                    ON `albums`.`id` = `songs`.`album_id`
                                                        WHERE `albums`.`id` = :albumId;");
        $query->setFetchMode(PDO::FETCH_CLASS, Album::class);
        $query->execute(['albumId' => $albumId]);
        return $query->fetch();
    }

    public function getPopularAlbums(): array
    {
        $query = $this->db->prepare("SELECT 
                albums.id, 
                albums.album_name, artists.artist_name, artists.id AS artist_id, albums.artwork_url,
                SUM(songs.play_count) AS total_play_count
            FROM 
                albums
            INNER JOIN 
                songs ON albums.id = songs.album_id
            INNER JOIN artists ON artists.id = albums.artist_id
            GROUP BY 
                albums.id, albums.album_name
            ORDER BY 
                total_play_count DESC
            LIMIT 5;");
        $query->setFetchMode(PDO::FETCH_CLASS, Album::class);
        $query->execute();
        return $query->fetchAll();
    }
}

