<?php
    include '../bd_connection/bd_connection.php';

    $nom = $_POST['name'];
    $prenom = $_POST['surname'];
    $login = $_POST['login'];
    $login = strtolower($login);
    $mdp = $_POST['password'];
    $mdp_confirm = $_POST['password_confirm'];
    $php_errormsg = "";

    $connexion = OpenCon();
    $results = $connexion->query("SELECT * FROM USER WHERE USER_LOGIN = '$login'");
    $results->setFetchMode(PDO::FETCH_OBJ);
    $row = $results->fetch();
    if ($row) {
        $php_errormsg = "WrongLOGIN";
    }
    else{
        if($mdp == $mdp_confirm){
            $connexion->query("INSERT INTO USER (USER_NAME, USER_SURNAME, USER_LOGIN, USER_PASSWD) VALUES ('$prenom', '$nom', '$login', '$mdp')");
            header('Location: ../index.html');
        }
        else{
            $php_errormsg = "WrongPASSWD";
        }
    }
    CloseCon($connexion);

    $HTMLLine = "<!DOCTYPE html>\n";
    $HTMLLine .= "<html lang=\"fr\">\n";
    $HTMLLine .= "<head>\n";
    $HTMLLine .= "    <meta charset=\"UTF-8\">\n";
    $HTMLLine .= "    <link rel=\"shortcut icon\" href=\"../img/favicon.ico\" type=\"image/x-icon\">\n";
    $HTMLLine .= "    <title>MusicPalace - Inscription</title>\n";
    $HTMLLine .= "    <link rel=\"stylesheet\" href=\"css/style.css\">\n";
    $HTMLLine .= "   <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">\n";

    if ($php_errormsg == "WrongLOGIN" or $php_errormsg == "WrongPASSWD") {
        $HTMLLine .= "    <link rel=\"stylesheet\" href=\"css/error.css\">\n";
    }

    $HTMLLine .= "    <link rel=\"stylesheet\" href=\"https://fonts.googleapis.com/css?family=Inter-Medium\"\n>";
    $HTMLLine .= "</head>\n";
    $HTMLLine .= "<body>\n";
    $HTMLLine .= "  <div class=\"container\">\n";
    $HTMLLine .= "      <a href='../index.html'><div class='left_part'>\n";
    $HTMLLine .= "      <img src=\"../img/ITunes_logo.svg.png\" alt=\"logo\">\n";
    $HTMLLine .= "      <h1>MusicPalace</h1>\n";
    $HTMLLine .= "  </div></a>\n";
    $HTMLLine .= "  <div class=\"right_part\">\n";
    $HTMLLine .= "      <h2>Inscription</h2>\n";
    $HTMLLine .= "        <form action=\"inscription.php\" method=\"post\">\n";
    $HTMLLine .= "            <div class=\"nom\">\n";
    $HTMLLine .= "                <h3>Nom</h3>\n";
    $HTMLLine .= "                <input type=\"text\" name=\"name\" placeholder=\"Nom\" id=\"nom\" required>\n";
    $HTMLLine .= "            </div>\n";
    $HTMLLine .= "           <div class=\"prenom\">\n";
    $HTMLLine .= "                <h3>Prénom</h3>\n";
    $HTMLLine .= "                <input type=\"text\" name=\"surname\" placeholder=\"Prénom\" id=\"prenom\" required>\n";
    $HTMLLine .= "            </div>\n";
    $HTMLLine .= "          <div class=\"login\">\n";
    $HTMLLine .= "                <h3>Login</h3>\n";
    $HTMLLine .= "                <input type=\"text\" name=\"login\" placeholder=\"Email\" id=\"login\" required>\n";
    $HTMLLine .= "            </div>\n";
    $HTMLLine .= "            <div class=\"password\">\n";
    $HTMLLine .= "                <h3>Mot de passe</h3>\n";
    $HTMLLine .= "                <input type=\"password\" name=\"password\" placeholder=\"Mot de passe\" id=\"password\" required>\n";
    $HTMLLine .= "            </div>\n";
    $HTMLLine .= "            <div class=\"password_confirm\">\n";
    $HTMLLine .= "                <h3>Confirmer le mot de passe</h3>\n";
    $HTMLLine .= "                <input type=\"password\" name=\"password_confirm\" placeholder=\"Confirmer le mot de passe\" id=\"password_confirm\" required>\n";
    $HTMLLine .= "            </div>\n";

    if ($php_errormsg == "WrongLOGIN") {
        $HTMLLine .= "            <p class='error-msg'>Cette adresse mail est déjà utilisée</p>\n";
    }
    else if ($php_errormsg == "WrongPASSWD") {
        $HTMLLine .= "            <p class='error-msg'>Le mot de passe doit être identique à sa confirmation</p>\n";
    }

    $HTMLLine .= "            <input id=\"connect_button\" type=\"submit\" value=\"Valider\">\n";
    $HTMLLine .= "        </form>\n";
    $HTMLLine .= "    </div>\n";
    $HTMLLine .= "  </div>\n";
    $HTMLLine .= "</body>\n";
    $HTMLLine .= "</html>\n";

    echo $HTMLLine;