<?php

class deezer {
    public static function get($url) {
        $curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => [
                "X-RapidAPI-Host: deezerdevs-deezer.p.rapidapi.com",
                "X-RapidAPI-Key: 01bdd9d177msha985ece080690d7p108c6ajsn96963e833a8f"
            ],
        ]);

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        $result = [];

        if ($err) {
            $result["text"] = "cURL Error #:" . $err;
        } else {
            $result["response"] = $response;
        }
        
        return $result;
    }   

    public static function get_query_deezer_albums($text) {
        $url = "https://deezerdevs-deezer.p.rapidapi.com/search?q=".htmlspecialchars($text);
        return self::get($url);        
    }   
    
    public static function get_query_deezer_tracks($id) {
        $url = "https://deezerdevs-deezer.p.rapidapi.com/album/".$id;
        return self::get($url);
    }
}
?>
