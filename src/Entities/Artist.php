<?php

declare(strict_types=1);

class Artist
{
    private int $id;
    private string $artist_name;
    private int $album_count;
    private string $artwork_url;
    private string $album_name;
    private string $song_name;
    private string $length;
    private int $song_id;
    private int $album_id;
    private int $play_count;
    private int $favourite;

    public function getFavourite(): int
    {
        return $this->favourite;
    }

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

    public function getSongId(): int
    {
        return $this->song_id;
    }

    public function getPlayCount(): int
    {
        return $this->play_count;
    }

    public function getAlbumId(): int
    {
        return $this->album_id;
    }
}