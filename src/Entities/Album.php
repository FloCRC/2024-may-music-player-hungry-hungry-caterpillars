<?php

class Album
{
    private int $id;
    private string $album_name;
    private string $artwork_url;
    private int $artist_id;

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