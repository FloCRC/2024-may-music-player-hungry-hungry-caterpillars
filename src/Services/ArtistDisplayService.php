<?php

class ArtistDisplayService {
    public static function getArtistDisplay(Artist $artist) {
//        $albums = $artist[] ;
        return "<a class='rounded bg-cyan-950 p-3 hover:bg-cyan-800 hover:cursor-pointer'>
                            <div class='flex gap-2 h-8'>
                                 <img class='rounded' src='https://via.placeholder.com/400x400/386641/6A994E?text=The+Memory+of+Trees' />
                                <img class='rounded' src='https://via.placeholder.com/400x400/386641/6A994E?text=The+Memory+of+Trees' />
                            </div>
                            <h4 class='text-xl font-bold'>{$artist->getArtistName()}</h4>
                            <p>3 Albums</p>
                        </a>";
    }
}

