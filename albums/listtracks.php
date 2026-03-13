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
$playlistsselecthtml = "<br/><br/>Add to playlist, checkboxes: <br/><select name='p'>";

foreach($playlists as $p){ 
    $playlistsselecthtml = $playlistsselecthtml."<option value='".$p["playlistid"]."'>".$p["playlistname"]."</option>";
}

$playlistsselecthtml = $playlistsselecthtml."</select>";


$formstart = "<form method='get' action='/api/addtoplaylist.php'>";
$form = "";

$count = 1;
foreach($tracks as $t){
    // tracks links    
    $checkboxtrack = "<input type='checkbox' name='songs[]' value='".$t["deezerid"]."'/>";  
    $listitemtrack = "<span>".$count. ". " . $t["title"]. "</span>";
    $form = $form . $checkboxtrack . $listitemtrack. "<br/>";
    $count++;
}
$submit = "<input type='submit' value='add' />";
$formend = "</form>";

$html = $formstart . $form . $playlistsselecthtml . $submit . $formend;
echo $html;
// echo "</div>";


echo templater::getFooter();

?>