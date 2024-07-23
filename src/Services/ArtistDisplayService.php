<?php

declare(strict_types=1);

require_once ('src/DatabaseConnector.php');
require_once ('src/Models/ArtistsModel.php');





class ArtistDisplayService
{

    public static function getArtistSummaryDisplay(array $artists, ArtistsModel $artistsModel): string
    {
        $summaryDisplay = '';
        foreach ($artists as $artist) {
            $artistId = $artist->getId();
            $artistAlbumCount = $artistsModel->getArtistsAlbumCount($artistId);
            $aristAlbumArtworks = $artistsModel->getArtistAlbumArtworks($artistId);
            $artworkDisplay = '';
            foreach ($aristAlbumArtworks as $aristAlbumArtwork) {
                $artworkDisplay .= "<img src={$aristAlbumArtwork->getArtworkUrl()} />";
            }
            $summaryDisplay .= "<a href='artist.php?{$artistId}' class='rounded bg-cyan-950 p-3 hover:bg-cyan-800 hover:cursor-pointer'>
                                    <div class='flex gap-2 h-8'>
                                        {$artworkDisplay}
                                    </div>
                                    <h4 class='text-xl font-bold'>{$artist->getArtistName()}</h4>
                                    <p>{$artistAlbumCount->getAlbumCount()} Albums</p>
                                </a>";
        }
            return
                $summaryDisplay;
        }
}

