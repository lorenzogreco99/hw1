
<?php
    
    include "auth.php";
    
    if(!controllo()) header("Location: home.php");

    $name= $_SESSION["username"];
    $url=$_POST["foto"];

    $array =array();
    $db = "hw1";
    $conn = mysqli_connect("localhost","root","",$db);
    $foto = mysqli_real_escape_string($conn, $url);
    $query = "SELECT nlikes, ncomments, text, comments.username from post join comments on comments.post = post.url where post.url = '$foto'";
    $res = mysqli_query($conn, $query) or die(mysqli_error($conn));
    while($post = mysqli_fetch_assoc($res)) {
        $array[] = array('username' => $post['username'],'nlikes' => $post['nlikes'], 
                        'ncomments' => $post['ncomments'], 'text' => $post['text']);
    }
    mysqli_free_result($res);
    mysqli_close($conn);
    echo json_encode($array);
?> 