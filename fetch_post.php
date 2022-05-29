<?php
    
    include "auth.php";
    
    if(!controllo()) header("Location: home.php");

    $name= $_SESSION["username"];

    $db = "hw1";
    $conn = mysqli_connect("localhost","root","",$db);
    $name = mysqli_real_escape_string($conn, $name);
    $query = "SELECT id, username, url, nlikes, ncomments,
                EXISTS(SELECT username FROM likes WHERE post = url AND username = '$name') as likeuser
                    from post ORDER BY id DESC limit 6";
    $res = mysqli_query($conn, $query) or die(mysqli_error($conn));
    $array = array();
    while($post = mysqli_fetch_assoc($res)) {
        $array[] = array('id' => $post['id'], 'username' => $post['username'],'nlikes' => $post['nlikes'], 
                        'ncomments' => $post['ncomments'], 'url' => $post['url'], 'likeuser' => $post['likeuser']);
    }
    mysqli_free_result($res);
    mysqli_close($conn);
    echo json_encode($array);
?> 