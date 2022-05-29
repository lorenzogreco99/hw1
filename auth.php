<?php
    
    session_start();

    function controllo() {
        // Se esiste già una sessione, la ritorno, altrimenti ritorno 0
        if(isset($_SESSION["username"])) {
            return $_SESSION["username"];
        } else 
            return 0;
    }
?> 