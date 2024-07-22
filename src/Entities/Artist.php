<?php

class Artist
{
    private int $id;
    private string $artist_name;
    private string $album_name;
    private string $artwork_url;
    private string $song_name;
    private string $length;
    private string $songID;

    public function getId(): int
    {
        return $this->id;
    }

    public function getArtistName(): string
    {
        return $this->artist_name;
    }

    public function getAlbumName(): string
    {
        return $this->album_name;
    }

    public function getArtworkUrl(): string
    {
        return $this->artwork_url;
    }

    public function getSongName(): string
    {
        return $this->song_name;
    }

    public function getLength(): string
    {
        return $this->length;
    }

    public function getSongID(): string
    {
        return $this->songID;
    }


}