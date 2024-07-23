<?php

declare(strict_types=1);

class AlbumArtWork {
    private int $id;
    private string $artwork_url;

    public function getArtworkUrl(): string
    {
        return $this->artwork_url;
    }

    public function getId(): int
    {
        return $this->id;
    }
}
