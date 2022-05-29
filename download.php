<?php
    
    include "auth.php";
    
    if(!controllo()) header("Location: home.php");

    $name = $_SESSION["username"];
    $foto = $_POST["foto"];

    $db = "hw1";
    $conn = mysqli_connect("localhost","root","",$db);
    $name = mysqli_real_escape_string($conn, $name);
    $query="INSERT into post(username, url) VALUES('$name','$foto')";
    $res = mysqli_query($conn, $query) or die(mysqli_error($conn));
    mysqli_close($conn);
    if(!$res){
        $res="errore con la query";
    }

    echo json_encode($res);
?> 