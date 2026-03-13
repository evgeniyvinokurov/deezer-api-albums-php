<?php

include_once("../lib/apicon.php");
include_once("../lib/templater.php");

// work with params
$songs = $_GET["songs"];
$playlistid = $_GET["p"];

$count = 0;

// work with apicon methods
foreach($songs as $songid) {
    apicon::addToPlaylist($songid, $playlistid);
    $count++;   
}

echo templater::getHeader();
echo "</br>".$count." added;</br>";
echo templater::getFooter();

?>