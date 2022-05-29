<?php
    include "auth.php";
    if(controllo()) 
        header("Location: homepage.php");
   

    $error = "";
    if (!empty($_POST["email"]) && !empty($_POST["password"]) )
    {   
        $db = "hw1";
        $conn = mysqli_connect("localhost","root","",$db);

        $email = mysqli_real_escape_string($conn, $_POST['email']);

        $password = mysqli_real_escape_string($conn, $_POST['password']);

        $query = "SELECT * FROM clienti WHERE Email = '$email'";

        $res = mysqli_query($conn, $query) or die(mysqli_error($conn));

        if(mysqli_num_rows($res) > 0 ){
            $stringa = mysqli_fetch_assoc($res);

            if($_POST["password"] === $stringa["password"]){
                $_SESSION["username"] = $stringa["username"];
                $_SESSION["email"] = $_POST["email"];    
                $_SESSION["nome"] = $stringa["nome"];
                $_SESSION["cognome"] = $stringa["cognome"];
                //$_SESSION["user_id"] = $stringa["id"]; vedere dopo!!!!!!!!!!!!!!!!!
                header("Location: homepage.php");
                mysqli_free_result($res);
                mysqli_close($conn);
                exit;
            }
        }

  
        
        $error = "Username e/o password errati.";
    }
    else if (isset($_POST["username"]) || isset($_POST["password"])) {
        $error = "Inserisci username e/o password.";

    }

    $_SESSION["error"] = $error
?> 
<!DOCTYPE html>
<html>

<head>

    <link href="https://fonts.googleapis.com/css?family=Pangolin:400,700|Proxima+Nova" rel="stylesheet" type="text/css">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Login</title>
    <link rel="stylesheet" href="css/login.css">
</head>

<body>
    

    <section>
    <h1>Benvenuto!</h1>
        
        <img id="logoimg" src="img/logo.png">
        <h2>MyLibrary</h2>

        <form name='login' method='post'>
            <label id="email">
                <label for='email'>Email</label>
                <input type='text' name='email' <?php if(isset($_POST["email"])){echo "value=".$_POST["email"];} ?>>
            </label>
            <label id="password">
                <label for='password'>Password</label>
                <input type='password' name='password'>
            </label>
            <label id="submit">
                <input type='submit' value="Accedi">
            </label>
            <span id="error"><?php echo($_SESSION["error"]); ?></span>
        </form>
        <div id="registati">Non hai un account ? <a href="registrati.php">Registrati !</a></div>
    </section>



</body>

</html>