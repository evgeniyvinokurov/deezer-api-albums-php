<?php

include_once("../lib/apicon.php");
include_once("../lib/templater.php");


// work with params
$idsalbums = [];
foreach($_REQUEST as $k => $album) {
    if (strpos($k, "deezerid") !== false) {
        $idsalbums[] = $album;
    }
};

// call to apicon method add, to add albums ids
$parsed = apicon::add($idsalbums);

echo templater::getHeader();
echo '</br>Parsed '.count($parsed).' albums<br/>';
echo templater::getFooter();


?>