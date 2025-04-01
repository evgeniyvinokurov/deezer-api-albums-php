<?php

include_once("../lib/templater.php");
include_once("../lib/apicon.php");

//getting param of artist
$id = str_replace(" ", "", $_GET["id"]);

$tracks = apicon::getTracksFromPlaylist($id);
$playlist = apicon::getPlaylistById($id)[0];

//print results
echo templater::getHeader();
echo "<h2>".$playlist["playlistname"]."</h2>";

$count = 1;
foreach($tracks as $t){    
    // tracks entries
    echo "<div>".$count.". ".$t["artist"]." - ".$t["title"]."</div>";
    $count++;
}

echo "</div>";
echo templater::getFooter();
?>
