<?php
    function aggiorna(){
        $db = "hw1";
        $conn = mysqli_connect("localhost","root","",$db);
        $query = "SELECT post, email FROM download";
        $res = mysqli_query($conn, $query) or die(mysqli_error($conn));
        $i = mysqli_num_rows($res);
        while($row = mysqli_fetch_assoc($res)){
            echo "
                <div class=\"picture\">
                    <div class=\"email\">
                        <img class=\"fotoprofilo\" src=\"img/persona.png\" >".$row["email"]." 
                    </div>
                    <img class=\"foto\" src=\"".$row["post"]." \">
                </div>

            ";
            
        }
    }
?>   