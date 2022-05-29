 <?php
    session_start();

    if(isset($_SESSION["username"]))
       header("Location: login.php");

    if (!empty($_POST["email"]) && !empty($_POST["password"]) && !empty($_POST["name"]) && !empty($_POST["surname"])&& !empty($_POST["username"])&& !empty($_POST["password_conf"])){
        $error = array();
        $db = "hw1";
        $conn = mysqli_connect("localhost","root","",$db);
        $username = mysqli_real_escape_string($conn, $_POST['username']);
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $password = mysqli_real_escape_string($conn, $_POST['password']);
        $name = mysqli_real_escape_string($conn, $_POST['name']);
        $surname = mysqli_real_escape_string($conn, $_POST['surname']);

        if(!preg_match('/^[a-zA-Z0-9_]{1,15}$/', $_POST['username'])) {
            $error[] = "Username non valido";
        } else {
            $username = mysqli_real_escape_string($conn, $_POST['username']);
            $query = "SELECT username FROM clienti WHERE username = '$username'";
            $res = mysqli_query($conn, $query);
            if (mysqli_num_rows($res) > 0) {
                $error[] = "Username già utilizzato";
            }
        }

        if (strlen($_POST["password"]) < 8) {
            $error[] = "Caratteri password insufficienti";
        } 
        if (strcmp($_POST["password"], $_POST["password_conf"]) != 0) {
            $error[] = "Le password non coincidono";
        }
        if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
            $error[] = "Email non valida";
        } else {
            $email = mysqli_real_escape_string($conn, strtolower($_POST['email']));
            $res = mysqli_query($conn, "SELECT email FROM clienti WHERE email = '$email'");
            if (mysqli_num_rows($res) > 0) {
                $error[] = "Email già utilizzata";
            }
        }

        if(count($error) == 0){
                     

            $query = "INSERT INTO clienti(Nome, Cognome,Email,password,username) VALUES('$name', '$surname','$email','$password','$username')";

            if (mysqli_query($conn, $query)) {

                $_SESSION["username"] = $username;
                $_SESSION["nome"]= $name;
                $_SESSION["cognome"]= $surname;
                $_SESSION["email"]= $email;
                mysqli_close($conn);
                header("Location: homepage.php");
                exit;
            } else {
                $error[] = "Errore di connessione al Database";
            }
        }

        mysqli_close($conn);

            
    }else if (isset($_POST["email"]) || isset($_POST["password"])) {
        $error[] = "Inserisci email e/o password.";
        }


    
        

?>  

<!DOCTYPE html>
<html>

<head>

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Pangolin:400,700|Proxima+Nova" rel="stylesheet" type="text/css">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Registrati</title>
    <link rel="stylesheet" href="css/registrati.css">
    <script src="js\registrati.js" defer="true"></script>

</head>

<body>

    <section>
        <div class="page">
            <h1>Benvenuto!</h1>
            
            <img id="logoimg" src="img/logo.png">
            <h2>MyLibrary</h2>
        </div>
        <div class="page">
            <form name='signup' method='post'>

                <div id="nome" class="blocco">
                    <div class="box">
                        <label for="name">Nome</label>
                        <input type="text" name="name"<?php if(isset($_POST["name"])){echo "value=".$_POST["name"];} ?>>
                    </div>
                    <span>Nome non adatto</span>
                </div>

                <div id="cognome"class="blocco">
                    <div Class="box">
                        <label for="surname">Cognome</label>
                        <input type="text" name="surname" <?php if(isset($_POST["surname"])){echo "value=".$_POST["surname"];} ?>>
                    </div>
                    <span>Cognome non adatto</span>
                </div>

                <div id="username"class="blocco">
                    <div Class="box">
                        <label for="username">Username</label>
                        <input type="text" name="username" >
                    </div>
                    <span id="nomeutente">Nome utente non disponibile</span>
                </div>

                <div id="email"class="blocco">
                    <div Class="box">
                        <label for="email">Email</label>
                        <input type="text" name="email">
                    </div>
                    <span id="email_r">Indirizzo email non valido</span>
                </div>

                <div id="password"class="blocco">
                    <div Class="box">
                        <label for='password'>Password</label>
                        <input type='password' name='password'<?php if(isset($_POST["password"])){echo "value=".$_POST["password"];} ?>>
                    </div>
                    <span>Inserisci almeno 8 caratteri</span>
                </div>

                <div id="password_conf"class="blocco">
                    <div Class="box">
                        <label for='password_conf'> Conferma Password</label>
                        <input type='password' name='password_conf' <?php if(isset($_POST["confirm_password"])){echo "value=".$_POST["confirm_password"];} ?>>
                    </div>
                    <span>Le password non coincidono</span>
                </div>

                <div id="submit">
                    <input type='submit' value="Registrati">
                </div>
            </form>
            <div class="signup">Hai già un account ? <a href="login.php ">Fai il login !</a></div>
        </div>
    </section>



</body>

</html>