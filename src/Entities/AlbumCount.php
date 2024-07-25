<?php

declare(strict_types=1);
class AlbumCount
{
    private int $album_count;

    public function getAlbumCount(): int
    {
        return $this->album_count;
    }
}