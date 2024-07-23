<?php

declare(strict_types=1);

namespace Services;
require_once 'src/Services/ArtistDisplayService.php';
require_once 'src/Entities/AlbumArtWork.php';
require_once 'src/Entities/AlbumCount.php';
require_once 'src/Entities/Artist.php';
require_once 'src/Models/AlbumsModel.php';

use PHPUnit\Framework\TestCase;

class ArtistDisplayServiceTest extends TestCase
{
    public function testMalformedArtists(): void
    {
        $artistsInput = 2;
        $artistsModelMock = $this->createMock(\ArtistsModel::class);
        $this->expectException(\TypeError::class);
        \ArtistDisplayService::getArtistSummaryDisplay($artistsInput, $artistsModelMock);
    }

    public function testMalformedModel(): void
    {

        $artistsInput = [];
        $modelInput = 'test';
        $this->expectException(\TypeError::class);
        \ArtistDisplayService::getArtistSummaryDisplay($artistsInput, $modelInput);
    }

    public function testSuccess(): void
    {
        $artistsMock = $this->createMock(\Artist::class);
        $artistsMock->method('getId')->willReturn(1);
        $artistsMock->method('getArtistName')->willReturn('test name');

        $albumArtworkMock = $this->createMock(\AlbumArtWork::class);
        $albumArtworkMock->method('getArtworkUrl')->willReturn('testUrl');
        $albumCountMock = $this->createMock(\AlbumCount::class);
        $albumCountMock->method('getAlbumCount')->willReturn(3);
        $artistsModelMock = $this->createMock(\ArtistsModel::class);
        $artistsModelMock->method('getArtistAlbumArtworks')->willReturn([$albumArtworkMock]);
        $artistsModelMock->method('getArtistsAlbumCount')->willReturn($albumCountMock);

        $result = \ArtistDisplayService::getArtistSummaryDisplay([$artistsMock], $artistsModelMock);
        $expected = "<a href='artist.php?1' class='rounded bg-cyan-950 p-3 hover:bg-cyan-800 hover:cursor-pointer'>
                                    <div class='flex gap-2 h-8'>
                                        <img src=testUrl />
                                    </div>
                                    <h4 class='text-xl font-bold'>test name</h4>
                                    <p>3 Albums</p>
                                </a>";

        $this->assertEquals($result, $expected);
    }
}