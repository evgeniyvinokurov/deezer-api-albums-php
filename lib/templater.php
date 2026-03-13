<?php
class templater {
    static public function getFooter(){
        echo '
        <h4>Sorry deezer rapidapi banned. Only locals things</h4>
        <ul>
            <li><a href="/albums/index.html">Search for Artists and Albums</a></li>
            <li><a href="/albums/listtolisten.php">Favs</a></li>
            <li><a href="/albums/list.php">Albums and Artists</a></li>
            <li><a href="/playlists/create.html">Create local playlist</a></li>
            <li><a href="/playlists/index.php">Local Playlists</a></li>
            <li><a href="/playlists/random15.php">Random Parsed Tracks Playlist</a></li>
        </ul>';
    }

    static public function getHeader(){
        echo '<h1>Deezer api music titles Parser and SQLite store</h1>';
    }
}

?>