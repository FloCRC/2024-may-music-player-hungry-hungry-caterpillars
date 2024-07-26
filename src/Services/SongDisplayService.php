<?php

declare(strict_types=1);

class SongDisplayService
{
    public static function displayRecentSong(int $songId,int $artistId, string $songTitle, string $artistName, string $songLength, int $isFavourite): string
    {
                    $textColour = '';
                    $fillColour = 'none';
                   if ($isFavourite == 1) {
                     $textColour = 'text-orange-500';
                     $fillColour = 'currentColor';
                   }
                    $songLengthFormatted = number_format((float)$songLength,2,':');
                    return "<div class='rounded bg-cyan-950 px-3 py-2 hover:bg-cyan-800 hover:cursor-pointer flex justify-between items-center mb-3'>
                        <div>
                            <h4 class='font-bold'>$songTitle</h4>
                            <p class='text-sm'>$artistName</p>
                        </div>
                        <div class='flex items-center justify-between w-24'>
                            <span class='text-slate-500'>$songLengthFormatted</span>
                            <a href='?playSong=1&songId=$songId&artist=$artistId' class='hover:text-slate-500 hover:cursor-pointer'>
                                <svg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke-width='1.5' stroke='currentColor' class='size-6 inline'>
                                    <path stroke-linecap='round' stroke-linejoin='round' d='M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z'></path>
                                    <path stroke-linecap='round' stroke-linejoin='round' d='M15.91 11.672a.375.375 0 0 1 0 .656l-5.603 3.113a.375.375 0 0 1-.557-.328V8.887c0-.286.307-.466.557-.327l5.603 3.112Z'></path>
                                </svg>
                            </a>
                            <a href='?favouriteId=$songId&artist=$artistId' class='hover:text-slate-500 hover:cursor-pointer $textColour'>
                                    <svg xmlns='http://www.w3.org/2000/svg' fill=$fillColour viewBox='0 0 24 24' stroke-width='1.5' stroke='currentColor' class='size-6'>
                                        <path stroke-linecap='round' stroke-linejoin='round' d='M17.593 3.322c1.1.128 1.907 1.077 1.907 2.185V21L12 17.25 4.5 21V5.507c0-1.108.806-2.057 1.907-2.185a48.507 48.507 0 0 1 11.186 0Z' />
                                    </svg>
                                </a>
                        </div>
                    </div>";
    }
}