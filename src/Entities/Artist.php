<?php

namespace Example\Entities;
class Artist
{
    private int $id;
    private string $artist_name;
    private int $album_count;
    private string $artwork_url;
    private string $album_name;
    private string $song_name;
    private float $length;
    private int $songID;
    private int $albumID;
    private int $play_count;
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

    public function getAlbumName(): string
    {
        return $this->album_name;
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

    public function getPlayCount(): int
    {
        return $this->play_count;
    }

    public function getAlbumID(): int
    {
        return $this->albumID;
    }


}