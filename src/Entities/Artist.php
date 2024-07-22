<?php

class Artist
{
    private int $id;
    private string $artist_name;

    public function getId(): int
    {
        return $this->id;
    }

    public function getArtistName(): string
    {
        return $this->artist_name;
    }

}