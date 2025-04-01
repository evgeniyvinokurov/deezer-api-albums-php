<?php

include_once("../lib/templater.php");
include_once("../lib/apicon.php");

// call to apicon class to get artists and albums
$filledalbums = apicon::getArtistsAndAlbums();
$artist = "";

//print results
echo templater::getHeader();

foreach($filledalbums as $al){    

    //form title
    if ($artist !== $al["artist"]) {  
        if ($count > 0)
            echo "<input type='submit' value='add' /></form></div>";

        echo "<h2>".$al["artist"]."</h2>";
        $artist = $al["artist"];
        echo "<div><form method='post' action='/api/add.php'><input type='hidden' name='artist' value='" .$al["artist"]. "' />";
    }

    // albums links
    $firsthref = $al["parsed"] ? "<a href='/albums/listtracks.php?album=". $al["deezerid"] . "'>tracks</a>" : "";
    $secondhref = $al["parsed"] ? "" : "<a href='/api/parsealbumstracks.php?album=". $al["deezerid"] . "&artist=". $al["artist"] . "'>parse tracks</a>";
    
    $hrefs = $firsthref . " "  . $secondhref;

    //  albums entries
    echo "<div><input type='checkbox' name='deezerid".$count."' value='".$al["deezerid"]."'>".$al["title"]."</input> ".$hrefs."</div>";
    $count++;
}
echo "<input type='submit' value='add' /></form></div>";

echo templater::getFooter();

?>