<?php
include_once("../lib/templater.php");
include_once("../lib/apicon.php");

//getting param of album
$album = $_GET["album"];
$artist = $_GET["artist"];

// work with apicon method parse tracks for album
$parsed = apicon::parseTracks($album, $artist);

echo templater::getHeader();
echo "</br>Parsed ".count($parsed)." entries;</br>";
echo templater::getFooter();
?>