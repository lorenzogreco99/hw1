<?php 

    $db = "hw1";
    $conn = mysqli_connect("localhost","root","",$db);

    $email = mysqli_real_escape_string($conn, $_GET["q"]);

    $query = "SELECT username FROM clienti WHERE email = '$email'";

    $res = mysqli_query($conn, $query) or die(mysqli_error($conn));

    echo mysqli_num_rows($res);

    mysqli_close($conn);
?>