<?php

declare(strict_types=1);

class Song
{
    private int $id;
    private string $song_name;
    private string $length;
    private int $album_id;
    private int $play_count;
    private int $favourite;
    private string $time_played;
    private int $artist_id;
    private string  $artist_name;

    public function getArtistId(): int
    {
        return $this->artist_id;
    }

    public function getTimePlayed(): string
    {
        return $this->time_played;
    }

    public function getFavourite(): int
    {
        return $this->favourite;
    }

    public function getArtistName(): string
    {
        return $this->artist_name;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getSongName(): string
    {
        return $this->song_name;
    }

    public function getLength(): string
    {
        return $this->length;
    }

    public function getAlbumId(): int
    {
        return $this->album_id;
    }

    public function getPlayCount(): int
    {
        return $this->play_count;
    }
}