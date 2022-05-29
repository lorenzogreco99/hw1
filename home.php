<?php
    include "auth.php";

?> 



<html>
<head>
<title>Homework1</title>
<link href="https://fonts.googleapis.com/css?family=Pangolin:400,700|Proxima+Nova" rel="stylesheet" type="text/css">
<meta charset="utf-8">
<link rel="stylesheet" href="css/home.css">
<meta name="viewport" content="width=device width, initial scale=1">
</head>
<body>

    <nav>
        <div class="link">

        <?php
            $text = "LOGIN";
            if(controllo())
                $text = "HOMEPAGE";

            echo "<a href='login.php'>$text</a>";
        ?>


        </div>

    </nav>

    <header>
        <img id="logoimg" src="img/logo.png">
        <h1>MyLibrary</h1>
    </header>

    <section>
        <div id="flex0">
            <div class="flex">
                <h2>Cerca</h2> nella sezione di ricerca puoi trovare qualsiasi genere e tipologia di foto
                <img class="homeimg" src="img/cerca.png">
            </div> 
            <div class="flex">
                <h2>Like</h2> metti un cuore se la foto di piace
                <img class="homeimg" src="img/like.png">
            </div>
            <div class="flex">
                <h2>Salvala</h2> mettendo like si salverà automaticamente nella libreria del tuo profilo
                <img class="homeimg" src="img/scarica.png">
            </div>
        </div>

    </section>

    <footer>
        <div>
            <span>Lorenzo Greco</span>
            <span>1000001091</span>
            <span>MyLibrary</span>
        </div>
    </footer>



</body>