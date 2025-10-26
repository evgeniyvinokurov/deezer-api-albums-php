<?php

include_once("../lib/templater.php");
include_once("../lib/apicon.php");

// work with apicon methods
$tracks = apicon::makeRandomPlaylist();

$num = 1;
foreach($tracks as $t){
    $html .= $num.". ". $t["artist"]." - ".$t["title"]."</br>";
    $num++;
}

echo templater::getHeader();
echo $html;
echo templater::getFooter();

?>