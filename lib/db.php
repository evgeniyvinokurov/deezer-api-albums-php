<?php

class database {
    public $dbhandle = false;

    public function __construct() {
        $this->dbhandle = new SQLite3("../songs.sqlite3");
    }

    function sqlite_query($dbhandle, $query){
        return $dbhandle->query($query);
    }

    function sqlite_fetch_array($result){
        $results = [];
        while ($row = $result->fetchArray()) {
            $results[] = $row;
        }
        return $results;
    }

    public function get_ids() {
        $res = $this->get_albums();
        $ids = [];

        foreach($res as $r) {
            $ids[] = $r["deezerid"];
        }

        return $ids;
    }

    public function get_tracks_ids($album) {
        $res = $this->get_tracks($album);
        $ids = [];

        foreach($res as $r) {
            $ids[] = $r["deezerid"];
        }

        return $ids;
    }

    public function get_tolisten_ids() {
        $res = $this->get_tolisten();
        $ids = [];

        foreach($res as $r) {
            $ids[] = $r["deezerid"];
        }

        return $ids;
    }

    public function get_albums() {
        $result = $this->sqlite_query($this->dbhandle, "select * from albums;");
        return $this->sqlite_fetch_array($result);
    }

    public function get_albums_by_id($id) {
        $result = $this->sqlite_query($this->dbhandle, "select * from albums where deezerid=".$id);
        return $this->sqlite_fetch_array($result);
    }

    public function get_tolisten() {
        $result = $this->sqlite_query($this->dbhandle, "select albums.title, albums.artist, albums.deezerid from albums inner join tolisten where albums.deezerid=tolisten.deezerid");
        return $this->sqlite_fetch_array($result);
    }

    public function get_tracks($album) {
        $result = $this->sqlite_query($this->dbhandle, "select * from tracks where deezeralbum=".$album);                       
        return $this->sqlite_fetch_array($result);
    }

    public function get_playlits() {
        $result = $this->sqlite_query($this->dbhandle, "select * from playlistnames");
        return $this->sqlite_fetch_array($result);
    }
    public function get_playlits_by_id($id) {
        $result = $this->sqlite_query($this->dbhandle, "select * from playlistnames where playlistid=".$id);
        return $this->sqlite_fetch_array($result);
    }

    public function get_tracks_from_playlist($id) {
        $result = $this->sqlite_query($this->dbhandle, "select * from playlist inner join tracks on playlist.songid=tracks.deezerid where playlistid=".$id);
        return $this->sqlite_fetch_array($result);
    }



    public function delete_from_tolisten($id) {
        $this->dbhandle->exec("delete from tolisten where deezerid='" . $id . "';");
    }



    public function insert_row_albums($title, $artist, $id) {
        $this->dbhandle->exec("INSERT INTO albums(artist, title, deezerid) VALUES('" . $artist . "', '" . $title . "', " . $id . ");");
    }

    public function insert_row_playlistnames($name) {
        $this->dbhandle->exec("INSERT INTO playlistnames(playlistname) VALUES('" . $name . "');");
    }

    public function insert_row_playlist($playlitsid, $songid) {
        $this->dbhandle->exec("INSERT INTO playlist(songid, playlistid) VALUES(" . $songid . ", " . $playlitsid . ");");
    }

    public function insert_row_tracks($title, $artist, $deezerid, $deezeralbum) {
        $query = "INSERT INTO tracks(deezerid, title, deezeralbum, artist) VALUES(" . $deezerid . ", '" . $title . "'," . $deezeralbum . ",'" . $artist . "');";
        $this->dbhandle->exec($query);
    }

    public function insert_row_to_listen($id) {
        $this->dbhandle->exec("INSERT INTO tolisten(deezerid) VALUES(" . $id . ");");
    }
}

?>

