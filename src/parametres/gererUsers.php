<?php
    include '../bd_connection/bd_connection.php';

    $inputHTML = "<!DOCTYPE html>\n";
    $inputHTML .= "<html lang=\"fr\">\n";
    $inputHTML .= "<head>\n";
    $inputHTML .= "  <meta charset=\"UTF-8\">\n";
    $inputHTML .= "  <link rel=\"stylesheet\" href=\"css/commonStyle.css\">\n";
    $inputHTML .= "    <link rel=\"shortcut icon\" href=\"../img/favicon.ico\" type=\"image/x-icon\">\n";
    $inputHTML .= "  <link rel=\"stylesheet\" href=\"css/gererUsers.css\">\n";
    $inputHTML .= "  <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">\n";
    $inputHTML .= "  <link rel=\"stylesheet\" href=\"https://fonts.googleapis.com/css?family=Inter-Medium\">\n";
    $inputHTML .= "  <link href=\"http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.3.0/css/font-awesome.css\" rel=\"stylesheet\"  type='text/css'>\n";
    $inputHTML .= "  <title>MusicPalace - Gérer les utilisateurs</title>\n";
    $inputHTML .= "</head>\n";
    $inputHTML .= "<body>\n";
    $inputHTML .= "<div class=\"container \">\n";
    $inputHTML .= "  <div class=\"side-navbar\">\n";
    $inputHTML .= "    <a class=\"back-button\" href=\"../home/home.php\"><div class=\"row accueil\">\n";
    $inputHTML .= "      <i class=\"fa fa-chevron-left\"></i>\n";
    $inputHTML .= "      <p>Accueil</p>\n";
    $inputHTML .= "    </div></a>\n";
    $inputHTML .= "    <div class=\"row compte\">\n";
    $inputHTML .= "      <i class=\"fa fa-user\"></i>\n";
    $inputHTML .= "      <p>Mon Compte</p>\n";
    $inputHTML .= "    </div>\n";
    $inputHTML .= "    <div class=\"row profil\">\n";
    $inputHTML .= "      <a href='parametres.php'><p>Mon profil</p></a>\n";
    $inputHTML .= "    </div>\n";
    $inputHTML .= "    <div class=\"row gerer\">\n";
    $inputHTML .= "      <i class=\"fa fa-gear\"></i>\n";
    $inputHTML .= "      <p>Gérer</p>\n";
    $inputHTML .= "    </div>\n";
    $inputHTML .= "          <div class=\"row add-users\">\n";
    $inputHTML .= "                <a href='addUsersParametres.php'><p>Ajouter un utilisateur</p></a>\n";
    $inputHTML .= "          </div>\n";
    $inputHTML .= "    <div class=\"row gerer-users\">\n";
    $inputHTML .= "      <a href='gererUsers.php'><p>Gérer les utilisateurs</p></a>\n";
    $inputHTML .= "    </div>\n";
    $inputHTML .= "    <div class=\"row add-cd\">\n";
    $inputHTML .= "      <a href='addCDParametres.php'><p>Ajouter un titre</p></a>\n";
    $inputHTML .= "    </div>\n";
    $inputHTML .= "    <div class=\"row gerer-cds\">\n";
    $inputHTML .= "      <a href='gererCds.php'><p>Gérer les cds</p></a>\n";
    $inputHTML .= "    </div>\n";
    $inputHTML .= "    <div class=\"row disconnect\">\n";
    $inputHTML .= "      <a href=\"../index.html\"><p>Se déconnecter</p></a>\n";
    $inputHTML .= "    </div>\n";
    $inputHTML .= "  </div>\n";
    $inputHTML .= "  <div class=\"content\">\n";
    $inputHTML .= "    <div class=\"header-text\">\n";
    $inputHTML .= "      <h1>Gérer les utilisateurs</h1>\n";
    $inputHTML .= "      <p>Ajouter, Supprimer, Modifier les utilisateurs</p>\n";
    $inputHTML .= "    </div>\n";
    $inputHTML .= "    <div class=\"table-container\">\n";
    $inputHTML .= "      <table>\n";
    $inputHTML .= "        <tr>\n";
    $inputHTML .= "          <th>Id</th>\n";
    $inputHTML .= "          <th>Nom</th>\n";
    $inputHTML .= "          <th>Prénom</th>\n";
    $inputHTML .= "          <th>Login</th>\n";
    $inputHTML .= "          <th>Mot de passe</th>\n";
    $inputHTML .= "          <th>Admin</th>\n";
    $inputHTML .= "          <th>Modifier</th>\n";
    $inputHTML .= "          <th>Supprimer</th>\n";
    $inputHTML .= "        </tr>\n";

    $connexion = OpenCon();
    $results = $connexion->query("SELECT * FROM USER ORDER BY USER_SURNAME ASC");
    $results->setFetchMode(PDO::FETCH_OBJ);
    while ($row = $results->fetch()) {
        $inputHTML .= "        <tr>\n";
        $inputHTML .= "          <td>" . $row->USER_ID . "</td>\n";
        $inputHTML .= "          <td>" . $row->USER_SURNAME . "</td>\n";
        $inputHTML .= "          <td>" . $row->USER_NAME . "</td>\n";
        $inputHTML .= "          <td>" . $row->USER_LOGIN . "</td>\n";
        $inputHTML .= "          <td>" . $row->USER_PASSWD . "</td>\n";
        $inputHTML .= "          <td>" . $row->USER_IS_ADMIN . "</td>\n";
        $inputHTML .= "          <td><a href='modifierUserPage.php?id=" . $row->USER_ID . "'><i class=\"fa fa-edit\"></i></a></td>\n";
        $inputHTML .= "          <td><a href='supprimerUser.php?id=" . $row->USER_ID . "'><i class=\"fa fa-trash\"></i></a></td>\n";
        $inputHTML .= "        </tr>\n";
    }

    $inputHTML .= "  </div>\n";
    $inputHTML .= "</div>\n";
    $inputHTML .= "</body>\n";
    $inputHTML .= "</html>\n";

    echo $inputHTML;