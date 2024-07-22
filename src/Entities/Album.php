<?php

class Album
{
    private int $id;
    private string $album_name;
    private string $artwork_url;
    private int $artist_id;
    private int $album_id;
    private int $song_id;
    private int $song_count;

    public function getSongCount(): int
    {
        return $this->song_count;
    }


    public function getAlbumId(): int
    {
        return $this->album_id;
    }

    public function getSongId(): int
    {
        return $this->song_id;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getAlbumName(): string
    {
        return $this->album_name;
    }

    public function getArtworkUrl(): string
    {
        return $this->artwork_url;
    }

    public function getArtistId(): int
    {
        return $this->artist_id;
    }

}