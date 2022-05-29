<?php
    
    include "auth.php";
    
    if(!controllo()) header("Location: home.php");

    $name = $_SESSION["username"];
    $commento = $_POST["commento"];
    $url = $_POST["url"];

    $db = "hw1";
    $conn = mysqli_connect("localhost","root","",$db);
    $name = mysqli_real_escape_string($conn, $name);
    $commento = mysqli_real_escape_string($conn, $commento);
    $query="INSERT into comments(username, post, text) VALUES('$name','$url' ,'$commento')";
    $res = mysqli_query($conn, $query) or die(mysqli_error($conn));
    mysqli_close($conn);
    if(!$res){
        $res="errore con la query";
        echo json_encode($res);
    }else{
        $array[] = array('username' => $name,'commento' => $commento);
        echo json_encode($array);
    }

    

    

?> 