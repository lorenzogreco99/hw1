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
<script src="js/cerca.js" defer="true"></script>
<link rel="stylesheet" href="css/cerca.css">
<meta name="viewport" content="width=device width, initial scale=1">
</head>
<body>

    <nav>
    <div id="box0">
            <img id="logo" src="img/logo1.png">
            <div class="nome">
                <?php
                    echo($_SESSION["nome"]);
                    echo(" ".$_SESSION["cognome"]);
                ?>
            </div>
        </div>
        <div class="link">
            <a href='Homepage.php'>Homepage</a>
            <a href='profilo.php'>Profilo </a>
        </div>
    </nav> 

    <section id="menu">
        <div id="box1">
            <h2>CERCA UNA FOTO</h2>
            <form class="campi" id="domanda1">
                <label for="sezione">Genere</label>
                <select name="genere" id="sezione">
                    <option value="musica">musica</option>
                    <option value="cibo">cibo</option>
                    <option value="serie tv">Serie TV</option>
                </select>
                <label for="oggetto">Cosa cerchi?</label>
                <input type="text" id="oggetto">
                <input type="submit" class="cerca" value="cerca">
            </form>
            
        </div>
    </section>

    <div id="modale" class="hidden">
        <div id="select">
            <div id="blocco">
                <span id="txt" class="hidden">Carica questa foto sul tuo profilo</span>
                <form id="form_b" method='post'>
                    <input type="submit" id="bottone" value="Download">
                </form>
            </div>
            <div id="bloccofoto"></div>
        </div>
        <div id="exit">x</div>
    </div>

    <section id="pagina">
        <div class="risposta"></div>

    </section>
    <footer>
        <div>
            <span>Lorenzo Greco</span>
            <span>1000001091</span>
            <span>MyLibrary</span>
        </div>
    </footer>

</body>