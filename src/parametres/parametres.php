<?php
    include '../bd_connection/bd_connection.php';
    session_start();
    $id = $_SESSION['id'];

    $inputHTML = "<!DOCTYPE html>\n";
    $inputHTML .= "<html lang=\"fr\">\n";
    $inputHTML .= "<head>\n";
    $inputHTML .= "    <meta charset=\"UTF-8\">\n";
    $inputHTML .= "    <link rel=\"shortcut icon\" href=\"../img/favicon.ico\" type=\"image/x-icon\">\n";
    $inputHTML .= "    <link rel=\"stylesheet\" href=\"css/commonStyle.css\">\n";
    $inputHTML .= "    <link rel=\"stylesheet\" href=\"css/styleParam.css\">\n";
    $inputHTML .= "    <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">\n";
    $inputHTML .= "    <link rel=\"stylesheet\" href=\"https://fonts.googleapis.com/css?family=Inter-Medium\">\n";
    $inputHTML .= "    <link href=\"http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.3.0/css/font-awesome.css\" rel=\"stylesheet\"  type='text/css'>\n";
    $inputHTML .= "    <title>MusicPalace - Parametres</title>\n";
    $inputHTML .= "</head>\n";
    $inputHTML .= "<body>\n";
    $inputHTML .= "    <div class=\"container\">\n";
    $inputHTML .= "      <div class=\"side-navbar\">\n";
    $inputHTML .= "          <a class=\"back-button\" href=\"../home/home.php\"><div class=\"row accueil\">\n";
    $inputHTML .= "              <i class=\"fa fa-chevron-left\"></i>\n";
    $inputHTML .= "              <p>Accueil</p>\n";
    $inputHTML .= "          </div></a>\n";
    $inputHTML .= "          <div class=\"row compte\">\n";
    $inputHTML .= "              <i class=\"fa fa-user\"></i>\n";
    $inputHTML .= "              <p>Mon Compte</p>\n";
    $inputHTML .= "          </div>\n";
    $inputHTML .= "          <div class=\"row profil\">\n";
    $inputHTML .= "                <a href='parametres.php'><p>Mon profil</p></a>\n";
    $inputHTML .= "          </div>\n";

    $connexion = OpenCon();
    $results = $connexion->query( "SELECT * FROM USER WHERE USER_ID = '$id'");
    $results->setFetchMode(PDO::FETCH_OBJ);
    $row = $results->fetch();
    if($row->USER_IS_ADMIN) {
        $inputHTML .= "          <div class=\"row gerer\">\n";
        $inputHTML .= "              <i class=\"fa fa-gear\"></i>\n";
        $inputHTML .= "              <p>Gérer</p>\n";
        $inputHTML .= "          </div>\n";
        $inputHTML .= "          <div class=\"row add-users\">\n";
        $inputHTML .= "                <a href='addUsersParametres.php'><p>Ajouter un utilisateur</p></a>\n";
        $inputHTML .= "          </div>\n";
        $inputHTML .= "          <div class=\"row gerer-users\">\n";
        $inputHTML .= "              <a href='gererUsers.php'><p>Gérer les utilisateurs</p></a>\n";
        $inputHTML .= "          </div>\n";
        $inputHTML .= "          <div class=\"row add-cd\">\n";
        $inputHTML .= "                <a href='addCDParametres.php'><p>Ajouter un titre</p></a>\n";
        $inputHTML .= "          </div>\n";
        $inputHTML .= "          <div class=\"row gerer-cds\">\n";
        $inputHTML .= "              <a href='gererCds.php'><p>Gérer les cds</p></a>\n";
        $inputHTML .= "          </div>\n";
    }

    $inputHTML .= "          <div class=\"row disconnect\">\n";
    $inputHTML .= "              <a href=\"../index.html\"><p>Se déconnecter</p></a>\n";
    $inputHTML .= "          </div>\n";
    $inputHTML .= "      </div>\n";
    $inputHTML .= "      <div class=\"content\">\n";
    $inputHTML .= "          <div class=\"header-text\">\n";
    $inputHTML .= "                <h1>Mon Profil</h1>\n";
    $inputHTML .= "                <p>Gérer les paramètres de votre profil</p>\n";
    $inputHTML .= "          </div>\n";


    $results = $connexion->query( "SELECT  * FROM USER WHERE USER_ID = '$id'");
    $results->setFetchMode(PDO::FETCH_OBJ);
    $row = $results->fetch();
    $prenom = $row->USER_SURNAME;
    $nom = $row->USER_NAME;
    $email = $row->USER_LOGIN;
    $password = $row->USER_PASSWD;


    $inputHTML .= "          <div class=\"input\">\n";
    $inputHTML .= "                <p class='type'>Nom</p>\n";
    $inputHTML .= "                <p class='value'>$nom</p>\n";
    $inputHTML .= "          </div>\n";
    $inputHTML .= "            <div class=\"input\">\n";
    $inputHTML .= "                <p class='type'>Prénom</p>\n";
    $inputHTML .= "                <p class='value'>$prenom</p>\n";
    $inputHTML .= "            </div>\n";
    $inputHTML .= "            <div class=\"input\">\n";
    $inputHTML .= "                <p class='type'>Email</p>\n";
    $inputHTML .= "                <p class='value'>$email</p>\n";
    $inputHTML .= "            </div>\n";
    $inputHTML .= "            <div class=\"input\">\n";
    $inputHTML .= "                <p class='type'>Mot de passe</p>\n";

    $pass = "";
    for ($i = 0; $i < strlen($password); $i++) {
        $pass .= "*";
    }

    $inputHTML .= "                <p class='value' type='password'>$pass</p>\n";
    $inputHTML .= "            </div>\n";
    $inputHTML .= "      </div>\n";
    $inputHTML .= "  </div>\n";
    $inputHTML .= "</body>\n";
    $inputHTML .= "</html>\n";
    echo $inputHTML;
