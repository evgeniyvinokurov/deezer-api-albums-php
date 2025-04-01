<?php

include_once("../lib/templater.php");
include_once("../lib/apicon.php");

//getting param of artist
$playlist = str_replace(" ", "", $_GET["name"]);


// work with apicon methods
apicon::makePlaylist($playlist);

echo templater::getHeader();
echo "</br>playlist ".$playlist." created;</br>";
echo templater::getFooter();

?>