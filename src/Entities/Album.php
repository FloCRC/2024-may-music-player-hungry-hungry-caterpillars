<?php

declare(strict_types=1);

namespace Example\Entities;
class Album
{
    private int $id;
    private string $album_name;
    private string $artwork_url;
    private int $artist_id;
    private int $song_id;
    private int $song_count;
    private string $artist_name;
    private int $total_play_count;

    public function getSongCount(): int
    {
        return $this->song_count;
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

    public function getArtistName(): string
    {
        return $this->artist_name;
    }

    public function getTotalPlayCount(): int
    {
        return $this->total_play_count;
    }
}