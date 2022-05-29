<?php

    include "auth.php";
        
    if(!controllo())
        header("Location: home.php");

    switch($_GET['type']) {
        case 'serie tv': serie(); break;
        case 'musica': musica(); break;
        case 'cibo': cibo(); break;
        default: break;
    }

    function musica(){
        $client_id = '958f24b517194c07a32cfe14a9515fbb';
        $client_secret = '7c06ad57169743058c164b48ba9c3358';

        // ACCESS TOKEN
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://accounts.spotify.com/api/token' );
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        # Eseguo la POST
        curl_setopt($ch, CURLOPT_POST, 1);
        # Setto body e header della POST
        curl_setopt($ch, CURLOPT_POSTFIELDS, 'grant_type=client_credentials'); 
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Authorization: Basic '.base64_encode($client_id.':'.$client_secret))); 
        $token=json_decode(curl_exec($ch), true);
        curl_close($ch);    

        // QUERY EFFETTIVA
        $query = urlencode($_GET["q"]);
        $url = 'https://api.spotify.com/v1/search?type=track&q='.$query;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        # Imposto il token
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Authorization: Bearer '.$token['access_token'])); 
        $res=curl_exec($ch);
        curl_close($ch);
        echo($res);
    }

    function cibo(){
        /*
        $url = 'https://foodish-api.herokuapp.com/api/images/'.urlencode($_GET["q"]); 
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $res=curl_exec($ch);
        curl_close($ch);
        echo $res;*/
        $array = array();
        for($i = 0 ; $i<3 ; $i++){
            $url = 'https://foodish-api.herokuapp.com/api/images/'.urlencode($_GET["q"]); 
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            $res=curl_exec($ch);
            $json = json_decode($res, true);
            $array[]= array($i =>$json['image']);
            curl_close($ch);            
        }
        echo json_encode($array);
    }

    function serie(){
        $url= 'https://api.tvmaze.com/search/shows?q='.urlencode($_GET["q"]);
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $res=curl_exec($ch);
        curl_close($ch);
        echo $res;
    }

?>