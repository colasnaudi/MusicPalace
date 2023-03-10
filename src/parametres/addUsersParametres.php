<?php


include '../bd_connection/bd_connection.php';
session_start();
$id = $_SESSION['id'];

$inputHTML = "<!DOCTYPE html>\n";
$inputHTML .= "<html lang=\"fr\">\n";
$inputHTML .= "<head>\n";
$inputHTML .= "    <meta charset=\"UTF-8\">\n";
$inputHTML .= "    <link rel=\"stylesheet\" href=\"css/styleAddUsers.css\">\n";
$inputHTML .= "    <link rel=\"shortcut icon\" href=\"../img/favicon.ico\" type=\"image/x-icon\">\n";
$inputHTML .= "    <link rel=\"stylesheet\" href=\"css/commonStyle.css\">\n";
$inputHTML .= "    <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">\n";
$inputHTML .= "    <link rel=\"stylesheet\" href=\"https://fonts.googleapis.com/css?family=Inter-Medium\">\n";
$inputHTML .= "    <link href=\"http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.3.0/css/font-awesome.css\" rel=\"stylesheet\"  type='text/css'>\n";
$inputHTML .= "    <title>MusicPalace - Ajouter un utilisateur</title>\n";
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
$inputHTML .= "          <div class=\"row disconnect\">\n";
$inputHTML .= "              <a href=\"../index.html\"><p>Se déconnecter</p></a>\n";
$inputHTML .= "          </div>\n";
$inputHTML .= "      </div>\n";
$inputHTML .= "      <div class=\"content\">\n";
$inputHTML .= "          <div class=\"header-text\">\n";
$inputHTML .= "                <h1>Ajouter un utilisateur</h1>\n";
$inputHTML .= "                <p>Insérer vos utilisateurs plus simplement</p>\n";
$inputHTML .= "          </div>\n";
$inputHTML .= "          <div class=\"form\">\n";
$inputHTML .= "              <form action=\"addUsers.php\" method=\"post\">\n";
$inputHTML .= "                  <div class=\"form-group\">\n";
$inputHTML .= "                      <label for=\"prenom\">Prenom</label>\n";
$inputHTML .= "                      <input type=\"text\" name=\"prenom\" id=\"prenom\" placeholder=\"Prenom\" required>\n";
$inputHTML .= "                  </div>\n";
$inputHTML .= "                  <div class=\"form-group\">\n";
$inputHTML .= "                      <label for=\"nom\">Nom</label>\n";
$inputHTML .= "                      <input type=\"text\" name=\"nom\" id=\"nom\" placeholder=\"Nom\" required>\n";
$inputHTML .= "                  </div>\n";
$inputHTML .= "                  <div class=\"form-group\">\n";
$inputHTML .= "                      <label for=\"login\">Login</label>\n";
$inputHTML .= "                      <input type=\"text\" name=\"login\" id=\"login\" placeholder=\"Login\" required>\n";
$inputHTML .= "                  </div>\n";
$inputHTML .= "                  <div class=\"form-group\">\n";
$inputHTML .= "                      <label for=\"password\">Mot de passe</label>\n";
$inputHTML .= "                      <input type=\"text\" name=\"password\" id=\"password\"  placeholder=\"Mot de passe\" required>\n";
$inputHTML .= "                  </div>\n";
$inputHTML .= "                  <div class=\"form-group\">\n";
$inputHTML .= "                      <label for=\"admin\">Administrateur</label>\n";
$inputHTML .= "                      <input type=\"number\" name=\"admin\" id=\"admin\" placeholder=\"Administrateur (0 ou 1)\" required>\n";
$inputHTML .= "                  </div>\n";
$inputHTML .= "            </div>\n";
$inputHTML .= "            <div class=\"submit-btn\">\n";
$inputHTML .= "                <input type=\"submit\" value=\"Ajouter\">\n";
$inputHTML .= "            </div>\n";
$inputHTML .= "      </div>\n";
$inputHTML .= "  </div>\n";
$inputHTML .= "</body>\n";
$inputHTML .= "</html>\n";
echo $inputHTML;
