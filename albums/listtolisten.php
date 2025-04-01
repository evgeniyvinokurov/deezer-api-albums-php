<?php

include_once("../lib/templater.php");
include_once("../lib/apicon.php");

// call to apicon class to get favorites albums
$albums = apicon::getFavs();

// print results
echo templater::getHeader();
echo "<h2>to listen, list of albums</h2>";

$count = 0;
foreach($albums as $al){
    echo "<div><form method='post' action='/api/remove.php'>";

    // favs entries
    echo "<div><input type='checkbox' name='deezerid".$count."' value='".$al["deezerid"]."'/><span>" .$al["artist"]. "</span> - <span>" .$al["title"]. "</span><input type='hidden' name='artist".$count."' value='" .$al["artist"]. "' /></div>";    
    $count++;
}
echo "<input type='submit' value='remove' /></form></div>";

echo templater::getFooter();

?>