<?php
class Song
{
    private int $id;
    private string $song_name;
    private float $length;
    private int $album_id;
    private int $play_count;
    private int $favourite;
    private string $time_played;
    private string  $artist_name;
    private int $artist_id;

    public function getArtistId(): int
    {
        return $this->artist_id;
    }

    public function getArtistName(): string
    {
        return $this->artist_name;
    }

    public function getFavourite(): int
    {
        return $this->favourite;
    }

    public function getTimePlayed(): int
    {
        return $this->time_played;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getSongName(): string
    {
        return $this->song_name;
    }

    public function getLength(): float
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