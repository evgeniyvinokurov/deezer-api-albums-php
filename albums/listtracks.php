<?php

include_once("../lib/apicon.php");
include_once("../lib/templater.php");

// work with params
$album = $_GET["album"];

// call to apicon method to get tracks of an album
$tracks = apicon::getTracks($album);
$albumitem = apicon::getAlbumById($album)[0];

//print results
echo templater::getHeader();
echo "<h2>".$tracks[0]["artist"]." - ".$albumitem["title"]."</h2>";


$playlists = apicon::getPlaylists();
$playlistshtml = "";

foreach($playlists as $p){ 
    $playlistshtml = $playlistshtml."&nbsp;<a href='/api/addtoplaylist.php?p=" .$p["playlistid"] . "&song=songid'> add to " . $p["playlistname"] . "</a>&nbsp;";
}

$count = 1;
foreach($tracks as $t){
    // tracks links    
    $html = str_replace("songid", $t["deezerid"], $playlistshtml);

    //tracks entries
    echo "<div>".$count.". ".$t["title"].$html."</div>";
    $count++;
}

echo "</div>";
echo templater::getFooter();

?>