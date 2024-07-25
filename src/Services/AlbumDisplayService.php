<?php

declare(strict_types=1);

class AlbumDisplayService
{
    public static function displayPopularAlbums(string $artWork, string $albumTitle, string $albumArtist, int $albumArtistID): string
    {
       return "<div class='border-b border-slate-500 pb-5 mb-3 flex justify-between items-center'>
                            <img class='w-[50px]' src=$artWork />
                            <div class='w-3/4 px-3'>
                                <h4 class='font-bold text-lg'>$albumTitle</h4>
                                <p class='text-sm'>$albumArtist</p>
                            </div>
                            <a href='artist.php?artist=$albumArtistID' class='hover:text-slate-500 hover:cursor-pointer'>
                                <svg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke-width='1.5' stroke='currentColor' class='size-6'>
                                    <path stroke-linecap='round' stroke-linejoin='round' d='m12.75 15 3-3m0 0-3-3m3 3h-7.5M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z' />
                                </svg>
                            </a>
                        </div>";

    }
}
