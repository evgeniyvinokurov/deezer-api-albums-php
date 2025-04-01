<?php

include_once("../lib/apicon.php");
include_once("../lib/templater.php");


// work with params
$ids = [];
foreach($_REQUEST as $k => $value) {
    if (strpos($k, "deezerid") !== false) {
        $ids[] = $value;
    }
};

// call to apicon method add, to delete albums with ids from favs
$count = apicon::delete($ids);

echo templater::getHeader();
echo "</br>Deleted ".$count." entries.</br>";
echo templater::getFooter();
?>