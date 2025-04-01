<?php

include_once("deezer.php");
include_once("db.php");

class apicon {
    
    // albums

    static public function add($idsalbums){
            $db = new database();
            $ids = $db->get_tolisten_ids();
            $parsed = [];
            foreach($idsalbums as $ia) {
                if (!in_array($ia, $ids)){
                    $db->insert_row_to_listen($ia);            
                }
                $parsed[] = $ia;
            }        
            return $parsed;
    } 

    static public function delete($ids){
            $count = 0;
            $db = new database();

            foreach($ids as $id) {
                $db->delete_from_tolisten($id);
                $count++;
            }
            return $count;
    }

    static public function parseAlbums($artist){        
        $response = deezer::get_query_deezer_albums($artist);
        $albums = json_decode($response["response"])->data;

        $dump = [];
        $artist = $albums[0]->artist->name;
        $ids = [];

        foreach($albums as $al){
            $item = [];
            $item["deezerid"] = $al->album->id;
            
            if (!in_array($item["deezerid"], $ids)) {
                $item["title"] = $al->album->title;
                $ids[] = $item["deezerid"];
                $dump[] = $item;
            }
        }

        $db = new database();
        $ids = $db->get_ids();
                
        $parsed = [];

        foreach($dump as $dumpitem) {              
            if (!in_array($dump["deezerid"], $ids)){
                $db->insert_row_albums($dumpitem["title"], $artist, $dumpitem["deezerid"]);
                $parsed[] = $dumpitem;
            }       
        }

        return $parsed;
    }

    static public function getArtistsAndAlbums(){
        $db = new database();
        $albums = $db->get_albums();

        $artist = "";
        $count = 0;
        $filledalbums = [];

        foreach($albums as $al){ 
            $item = $al;
            $item["parsed"] = $db->get_tracks($al["deezerid"]) ? true : false;
            $filledalbums[] = $item;
        }

        return $filledalbums;
    }

    static public function getFavs(){
        $db = new database();
        return $db->get_tolisten();
    } 

    static public function getAlbumById($album){
        $db = new database();
        return $db->get_albums_by_id($album);
    }


    // tracks

    static public function getTracks($album){
        $db = new database();
        return $db->get_tracks($album);
    }

    static public function parseTracks($album, $artist){
        $response = deezer::get_query_deezer_tracks($album);

        $decodedresponse = json_decode($response["response"]);        
        
        $tracks = $decodedresponse->tracks->data;

        $dump = [];

        foreach($tracks as $t){
            $item = [];
            $item["deezerid"] = $t->id;
            $item["title"] = $t->title;
            $dump[] = $item;
        }

        $db = new database();
        $ids = $db->get_tracks_ids($album);

        $parsed = [];

        foreach($dump as $dumpitem) {      
            $in = in_array($dumpitem["deezerid"], $ids);

            if (!$in){
                $db->insert_row_tracks($dumpitem["title"], $artist, $dumpitem["deezerid"], $album);
                $parsed[] = $dumpitem;
            }       
        }

        return $parsed;
    }



    // playlists

    static public function makePlaylist($name){
        $db = new database();
        return $db->insert_row_playlistnames($name);
    }

    static public function getPlaylists(){
        $db = new database();
        return $db->get_playlits();
    }

    static public function getPlaylistById($id){
        $db = new database();
        return $db->get_playlits_by_id($id);
    }

    static public function addToPlaylist($songid, $playlistid){
        $db = new database();
        return $db->insert_row_playlist($playlistid, $songid);
    }

    static public function getTracksFromPlaylist($list){
        $db = new database();
        return $db->get_tracks_from_playlist($list);
    }
}

?>