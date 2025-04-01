<?php

include_once("../lib/templater.php");
include_once("../lib/apicon.php");

//getting param of artist
$artist = str_replace(" ", "", $_GET["text"]);


// work with apicon method parse albums for artist
$parsed = apicon::parseAlbums($artist);

echo templater::getHeader();
echo "</br>Parsed ".count($parsed)." entries;</br>";
echo templater::getFooter();
?>