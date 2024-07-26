<?php
declare(strict_types=1);
require_once 'src/Services/SongDisplayService.php';
use PHPUnit\Framework\TestCase;
class SongDisplayServiceTest extends TestCase
{
    public function testFavouritedSuccess(): void
    {
        $songId=1;
        $artistId=1;
        $songTitle='test';
        $artistName='test';
        $songLength='12.34';
        $isFavourite = 1;
        $fillColour='currentColor';
        $textColour='text-orange-500';
        $textColour = '';
        $fillColour = 'none';
        $result = SongDisplayService::displayRecentSong($songId,$artistId,$songTitle,$artistName,$songLength,$isFavourite);
        $expected = "<div class='rounded bg-cyan-950 px-3 py-2 hover:bg-cyan-800 hover:cursor-pointer flex justify-between items-center mb-3'>
                        <div>
                            <h4 class='font-bold'>test</h4>
                            <p class='text-sm'>test</p>
                        </div>
                        <div class='flex items-center justify-between w-24'>
                            <span class='text-slate-500'>12:34</span>
                            <a href='?playSong=1&songId=1&artist=1' class='hover:text-slate-500 hover:cursor-pointer'>
                                <svg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke-width='1.5' stroke='currentColor' class='size-6 inline'>
                                    <path stroke-linecap='round' stroke-linejoin='round' d='M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z'></path>
                                    <path stroke-linecap='round' stroke-linejoin='round' d='M15.91 11.672a.375.375 0 0 1 0 .656l-5.603 3.113a.375.375 0 0 1-.557-.328V8.887c0-.286.307-.466.557-.327l5.603 3.112Z'></path>
                                </svg>
                            </a>
                            <a href='?favouriteId=1&artist=1' class='hover:text-slate-500 hover:cursor-pointer text-orange-500'>
                                    <svg xmlns='http://www.w3.org/2000/svg' fill=currentColor viewBox='0 0 24 24' stroke-width='1.5' stroke='currentColor' class='size-6'>
                                        <path stroke-linecap='round' stroke-linejoin='round' d='M17.593 3.322c1.1.128 1.907 1.077 1.907 2.185V21L12 17.25 4.5 21V5.507c0-1.108.806-2.057 1.907-2.185a48.507 48.507 0 0 1 11.186 0Z' />
                                    </svg>
                                </a>
                        </div>
                    </div>";
        $this->assertEquals($expected,$result);
    }
    public function testUnfavouritedSuccess(): void
    {
        $songId=1;
        $artistId=1;
        $songTitle='test';
        $artistName='test';
        $songLength='12.34';
        $isFavourite = 0;
        $result = SongDisplayService::displayRecentSong($songId,$artistId,$songTitle,$artistName,$songLength,$isFavourite);
        $expected = "<div class='rounded bg-cyan-950 px-3 py-2 hover:bg-cyan-800 hover:cursor-pointer flex justify-between items-center mb-3'>
                        <div>
                            <h4 class='font-bold'>test</h4>
                            <p class='text-sm'>test</p>
                        </div>
                        <div class='flex items-center justify-between w-24'>
                            <span class='text-slate-500'>12:34</span>
                            <a href='?playSong=1&songId=1&artist=1' class='hover:text-slate-500 hover:cursor-pointer'>
                                <svg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke-width='1.5' stroke='currentColor' class='size-6 inline'>
                                    <path stroke-linecap='round' stroke-linejoin='round' d='M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z'></path>
                                    <path stroke-linecap='round' stroke-linejoin='round' d='M15.91 11.672a.375.375 0 0 1 0 .656l-5.603 3.113a.375.375 0 0 1-.557-.328V8.887c0-.286.307-.466.557-.327l5.603 3.112Z'></path>
                                </svg>
                            </a>
                            <a href='?favouriteId=1&artist=1' class='hover:text-slate-500 hover:cursor-pointer '>
                                    <svg xmlns='http://www.w3.org/2000/svg' fill=none viewBox='0 0 24 24' stroke-width='1.5' stroke='currentColor' class='size-6'>
                                        <path stroke-linecap='round' stroke-linejoin='round' d='M17.593 3.322c1.1.128 1.907 1.077 1.907 2.185V21L12 17.25 4.5 21V5.507c0-1.108.806-2.057 1.907-2.185a48.507 48.507 0 0 1 11.186 0Z' />
                                    </svg>
                                </a>
                        </div>
                    </div>";
        $this->assertEquals($expected,$result);
    }
    public function testMalformed(): void
    {
        $songId='123';
        $artistId='123';
        $songTitle=['test'];
        $artistName=Null;
        $songLength=1234;

        $this->expectException(\TypeError::class);
        SongDisplayService::displayRecentSong($songId,$artistId,$songTitle,$artistName,$songLength);
    }
}