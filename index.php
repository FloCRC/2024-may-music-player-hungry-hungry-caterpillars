<?php
require_once ('src/Models/ArtistsModel.php');
require_once ('src/DatabaseConnector.php');
require_once ('src/Models/AlbumsModel.php');
require_once ('src/Services/ArtistDisplayService.php');
require_once ('src/Models/SongsModel.php');
require_once ('src/Services/SongDisplayService.php');

$db = DatabaseConnector::connect();
$artistsModel = new ArtistsModel($db);
$artists = $artistsModel->getArtistsSummary();

$songModel = new SongsModel($db);
$recentSongs = $songModel->getRecentSong();

if (isset($_GET['favouriteId'])){
    $songsId = $songModel->updateFavourite((int)$_GET['favouriteId']);
    header('location:index.php');
}

if (isset($_GET['playSong'])&& isset($_GET['songID'])){
    $songID = (int)$_GET['songID'];
    $songModel->updateTimePlayed($songID);
    $songModel->updatePlayCount($songID);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Music Player</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="play.js"></script>
</head>
<body>
<div class="h-screen w-full bg-blue-950 flex text-white">
    <nav class="h-screen border-r bg-cyan-950 border-slate-500 flex flex-col justify-evenly items-center">
        <a href="index.php" class="p-12 hover:text-slate-500">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="m2.25 12 8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
            </svg>
        </a>
        <a href="search.php" class="p-12 hover:text-slate-500">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
            </svg>
        </a>
        <a href="favourites.php" class="p-12 hover:text-slate-500">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 3.75V16.5L12 14.25 7.5 16.5V3.75m9 0H18A2.25 2.25 0 0 1 20.25 6v12A2.25 2.25 0 0 1 18 20.25H6A2.25 2.25 0 0 1 3.75 18V6A2.25 2.25 0 0 1 6 3.75h1.5m9 0h-9" />
            </svg>
        </a>
        <button id="minimise" class="p-12 hover:text-slate-500 group open">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6 group-[.open]:hidden">
                <path fill-rule="evenodd" d="M2.25 4.5A.75.75 0 0 1 3 3.75h14.25a.75.75 0 0 1 0 1.5H3a.75.75 0 0 1-.75-.75Zm14.47 3.97a.75.75 0 0 1 1.06 0l3.75 3.75a.75.75 0 1 1-1.06 1.06L18 10.81V21a.75.75 0 0 1-1.5 0V10.81l-2.47 2.47a.75.75 0 1 1-1.06-1.06l3.75-3.75ZM2.25 9A.75.75 0 0 1 3 8.25h9.75a.75.75 0 0 1 0 1.5H3A.75.75 0 0 1 2.25 9Zm0 4.5a.75.75 0 0 1 .75-.75h5.25a.75.75 0 0 1 0 1.5H3a.75.75 0 0 1-.75-.75Z" clip-rule="evenodd" />
            </svg>

            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6 group-[:not(.open)]:hidden">
                <path fill-rule="evenodd" d="M2.25 4.5A.75.75 0 0 1 3 3.75h14.25a.75.75 0 0 1 0 1.5H3a.75.75 0 0 1-.75-.75Zm0 4.5A.75.75 0 0 1 3 8.25h9.75a.75.75 0 0 1 0 1.5H3A.75.75 0 0 1 2.25 9Zm15-.75A.75.75 0 0 1 18 9v10.19l2.47-2.47a.75.75 0 1 1 1.06 1.06l-3.75 3.75a.75.75 0 0 1-1.06 0l-3.75-3.75a.75.75 0 1 1 1.06-1.06l2.47 2.47V9a.75.75 0 0 1 .75-.75Zm-15 5.25a.75.75 0 0 1 .75-.75h9.75a.75.75 0 0 1 0 1.5H3a.75.75 0 0 1-.75-.75Z" clip-rule="evenodd" />
            </svg>
        </button>
    </nav>
    <main class="group grow h-screen">
        <section class="group-[.minimised]:h-[calc(100%-6rem)] h-3/4 p-12 overflow-auto">
            <h2 class="text-4xl font-bold">Home</h2>
            <div class="grid md:grid-cols-2 lg:grid-cols-3 mt-12 gap-5">
                <div class="">
                    <h3 class="text-xl font-bold mb-3">Artists</h3>
                    <div class="grid grid-cols-2 gap-3 mb-3">
                       <?php
                        echo ArtistDisplayService::getArtistSummaryDisplay($artists, $artistsModel)
                        ?>
                        <div class="rounded bg-cyan-950 p-3 flex items-center">
                            <h4 class="text-2xl text-slate-500">+ 16 more</h4>
                        </div>
                    </div>
                    <a href="artists.php" class="float-right border rounded-md bg-cyan-950 px-2 py-1 hover:bg-cyan-800">See all
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 inline">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m12.75 15 3-3m0 0-3-3m3 3h-7.5M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                        </svg>
                    </a>
                </div>
                <div class="">
                    <h3 class="text-xl font-bold mb-3">Recently Played Songs</h3>
                        <?php
                            foreach ($recentSongs as $recentSong) {
                                $songID = $recentSong->getId();
                                $songTitle = $recentSong->getSongName();
                                $songArtist = $recentSong->getArtistName();
                                $songArtistId  = $recentSong->getArtistID();
                                $songLength = $recentSong->getLength();
                                $songFavourite = $recentSong->getFavourite();

                                echo SongDisplayService::displayRecentSong($songID,$songArtistId,$songTitle,$songArtist,$songLength, $songFavourite);
                            }

                        ?>
                    </div>
                </div>
        </section>
    </main>
</div>
</body>
</html>
