<?php
    
    include "auth.php";
    
    if(!controllo())
        header("Location: home.php")
?> 

<html>
<head>
<title>Profilo</title>
<link href="https://fonts.googleapis.com/css?family=Pangolin:400,700|Proxima+Nova" rel="stylesheet" type="text/css">
<meta charset="utf-8">
<link rel="stylesheet" href="css/profilo.css">
<script src="js/profilo.js" defer="true"></script>
<meta name="viewport" content="width=device width, initial scale=1">
</head>
<body>

    <nav>
        <img id="logo" src="img/logo1.png">
        <div class="link">
            <a href='Homepage.php'>Homepage</a>
            <a href='logout.php'> Logout </a>
        </div>
    </nav>
    
    <div id="modale" class="hidden">
        <div id="flex0">
            <div id="picture"></div>
            <div id="flex1">
                <div id="info"></div>
                <div id="commento"></div>
            </div>
        </div>
        <div id="exit">x</div>

    </div>
    
    <section id="pagina">    
            <div id="nome">
                <?php
                    echo($_SESSION["nome"]);
                    echo(" ".$_SESSION["cognome"]);
                ?>
            </div>
            <div id="dati">
                <div>
                    <p>Email: </p>
                    <?php
                        echo($_SESSION["email"]);
                    ?>
                </div>
                <div>
                    <p>Username: </p>
                    <?php
                        echo($_SESSION["username"]);
                    ?>
                </div>
            </div>
    </section>

    <h2>La mia libreria</h2>

    <div id=album>
        <?php
            $db = "hw1";
            $conn = mysqli_connect("localhost","root","",$db);
            $name = $_SESSION["username"];
            $query = "SELECT url FROM post WHERE username = '$name'";
            $res = mysqli_query($conn, $query) or die(mysqli_error($conn));
            
            while($row = mysqli_fetch_assoc($res)){
                echo"<div class=\"box\"><img class=\"foto\" src=".($row["url"])." \"></div>";
            }
        ?>
        
    </div>
    

    <footer>
        <div>
            <span>Lorenzo Greco</span>
            <span>1000001091</span>
            <span>MyLibrary</span>
        </div>
    </footer>
</body>

</html>