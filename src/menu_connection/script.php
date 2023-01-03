<?php
    include '../bd_connection/bd_connection.php';
    session_start();
    $login = $_POST['login'];
    $login = strtolower($login);
    $password = $_POST['password'];
    $php_errormsg = "";

    $connexion = OpenCon();
    $results = $connexion->query("SELECT * FROM USER WHERE USER_LOGIN = '$login'");
    $results->setFetchMode(PDO::FETCH_OBJ);
    $row = $results->fetch();
    if ($row) {
       $_SESSION['id'] = $row->USER_ID;
    }


    $file = fopen("wrong_infos.html", "w+");
    $inputHTML = "<!DOCTYPE html>\n";
    $inputHTML .= "<html lang=\"fr\">\n";
    $inputHTML .= "<head>\n";
    $inputHTML .= "  <meta charset=\"utf-8\">\n";
    $inputHTML .= "    <link rel=\"shortcut icon\" href=\"../img/favicon.ico\" type=\"image/x-icon\">\n";
    $inputHTML .= "  <title>MusicPalace</title>\n";
    $inputHTML .= "  <link rel=\"stylesheet\" href=\"css/style.css\">\n";
    $inputHTML .= "  <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">\n";


$connexion = OpenCon();
    $results = $connexion->query("SELECT * FROM USER WHERE USER_LOGIN = '$login' AND USER_PASSWD = '$password'");
    $results->setFetchMode(PDO::FETCH_OBJ);
    $row = $results->fetch();
    if (!$row) {
        $results = $connexion->query("SELECT * FROM USER WHERE USER_LOGIN = '$login'");
        $results->setFetchMode(PDO::FETCH_OBJ);
        $row = $results->fetch();
        if(!$row) {
            $php_errormsg = "WrongLOGIN";
            $inputHTML .= "   <link rel=\"stylesheet\" href=\"css/wrong_infos_login.css\">\n";
        }
        else {
            $results = $connexion->query("SELECT * FROM USER WHERE USER_PASSWD = '$password'");
            $results->setFetchMode(PDO::FETCH_OBJ);
            $row = $results->fetch();
            if(!$row) {
                $php_errormsg = "WrongPASSWD";
                $inputHTML .= "   <link rel=\"stylesheet\" href=\"css/wrong_infos_passwd.css\">\n";
            }
        }
    }
    else{
        header('Location: ../home/home.php');
    }

    CloseCon($connexion);

    $inputHTML .= "</head>\n";
    $inputHTML .= "<body>\n";
    $inputHTML .= "<img src=\"../img/ITunes_logo.svg.png\" alt=\"logo\">\n";
    $inputHTML .= "<h1>MusicPalace</h1>\n";
    $inputHTML .= "<form action=\"script.php\" method=\"post\">\n";
    $inputHTML .= "    <input type=\"text\" name=\"login\" placeholder=\"Email\" id=\"login\" required>\n";
    $inputHTML .= "    <input type=\"password\" name=\"password\" placeholder=\"Mot de passe\" id=\"password\" required>\n";

    if($php_errormsg == "WrongLOGIN" ){
        $inputHTML .= "    <p id=\"failed_message\">Email incorrect</p>\n";
    }
    else if ($php_errormsg == "WrongPASSWD") {
        $inputHTML .= "    <p id=\"failed_message\">Mot de passe incorrect</p>\n";
    }

    $inputHTML .= "    <input id=\"connect_button\" type=\"submit\" value=\"Se connecter\">\n";
    $inputHTML .= "    <p>ou</p>\n";
    $inputHTML .= "    <p id=\"inscription\">Pas encore inscrit ? <a href=\"../inscription/inscription.html\">Inscrivez-vous</a></p>\n";
    $inputHTML .= "</form>\n";
    $inputHTML .= "</body>\n";
    $inputHTML .= "</html>\n";

    fwrite($file, $inputHTML);
    fclose($file);

    if ($php_errormsg == "WrongLOGIN" || $php_errormsg == "WrongPASSWD") {
        header('Location: wrong_infos.html');
    }