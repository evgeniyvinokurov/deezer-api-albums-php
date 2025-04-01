<?php

include_once("../lib/apicon.php");
include_once("../lib/templater.php");


// call to apicon method to get tracks of an album
$lists = apicon::getPlaylists();

//print results
echo templater::getHeader();

$count = 1;
foreach($lists as $t){    
    
    // playlits entries

    echo "<div><a href='/playlists/one.php?id=" . $t["playlistid"] . "'>".$t["playlistname"]."</a></div>";
    $count++;
}

echo templater::getFooter();

?>