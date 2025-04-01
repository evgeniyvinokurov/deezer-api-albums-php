<?php

include_once("../lib/apicon.php");
include_once("../lib/templater.php");

// work with params
$songid = $_GET["song"];
$playlistid = $_GET["p"];

// work with apicon methods
apicon::addToPlaylist($songid, $playlistid);

echo templater::getHeader();
echo "</br>1 added;</br>";
echo templater::getFooter();

?>