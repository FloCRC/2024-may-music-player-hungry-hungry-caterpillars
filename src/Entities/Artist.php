<?php

class Artist
{
    private int $id;
    private string $artist_name;
    private int $album_count;
    private string $artwork_url;

    public function getArtworkUrl(): string
    {
        return $this->artwork_url;
    }

    public function getAlbumCount(): int
    {
        return $this->album_count;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getArtistName(): string
    {
        return $this->artist_name;
    }
}