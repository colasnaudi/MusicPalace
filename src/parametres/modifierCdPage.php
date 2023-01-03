<?php
include '../bd_connection/bd_connection.php';
$id = $_GET['id'];

$inputHTML = "<!DOCTYPE html>\n";
$inputHTML .= "<html lang=\"fr\">\n";
$inputHTML .= "<head>\n";
$inputHTML .= "  <meta charset=\"UTF-8\">\n";
$inputHTML .= "  <link rel=\"stylesheet\" href=\"css/commonStyle.css\">\n";
$inputHTML .= "    <link rel=\"shortcut icon\" href=\"../img/favicon.ico\" type=\"image/x-icon\">\n";
$inputHTML .= "  <link rel=\"stylesheet\" href=\"css/gererCds.css\">\n";
$inputHTML .= "  <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">\n";
$inputHTML .= "  <link rel=\"stylesheet\" href=\"https://fonts.googleapis.com/css?family=Inter-Medium\">\n";
$inputHTML .= "  <link href=\"http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.3.0/css/font-awesome.css\" rel=\"stylesheet\"  type='text/css'>\n";
$inputHTML .= "  <title>MusicPalace - Modifier les cds</title>\n";
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

$connexion = OpenCon();
$results = $connexion->query("SELECT * FROM CD WHERE CD_ID = $id");
$results->setFetchMode(PDO::FETCH_OBJ);
while ($row = $results->fetch()) {
    $inputHTML .= "      <h1>Modifier le cd " . $row->CD_TITRE . " de " . $row->CD_ARTIST . "</h1>\n";
    $inputHTML .= "    </div>\n";
    $inputHTML .= "    <div class=\"form-container\">\n";
    $inputHTML .= "      <form action=\"modifierCd.php?id=" . $row->CD_ID . "\" method=\"POST\">\n";
    $inputHTML .= "        <div class=\"form-group\">\n";
    $inputHTML .= "          <label for=\"artist\">Artiste</label>\n";
    $inputHTML .= "          <input type=\"text\" name=\"artist\" id=\"artist\" value=\"" . $row->CD_ARTIST. "\">\n";
    $inputHTML .= "        </div>\n";
    $inputHTML .= "        <div class=\"form-group\">\n";
    $inputHTML .= "          <label for=\"titre\">Titre</label>\n";
    $inputHTML .= "          <input type=\"text\" name=\"titre\" id=\"titre\" value=\"" . $row->CD_TITRE . "\">\n";
    $inputHTML .= "        </div>\n";
    $inputHTML .= "        <div class=\"form-group\">\n";
    $inputHTML .= "          <label for=\"genre\">Genre</label>\n";
    $inputHTML .= "          <input type=\"text\" name=\"genre\" id=\"genre\" value=\"" . $row->CD_GENRE . "\">\n";
    $inputHTML .= "        </div>\n";
    $inputHTML .= "        <div class=\"form-group\">\n";
    $inputHTML .= "          <label for=\"prix\">Prix</label>\n";
    $inputHTML .= "          <input type=\"text\" name=\"prix\" id=\"prix\" value=\"" . $row->CD_PRICE . "\">\n";
    $inputHTML .= "        </div>\n";
    $inputHTML .= "        <div class=\"form-group\">\n";
    $inputHTML .= "          <label for=\"image\">Image</label>\n";
    $inputHTML .= "          <input type=\"text\" name=\"image\" id=\"image\" value=\"" . $row->CD_IMAGE . "\">\n";
    $inputHTML .= "        </div>\n";
    $inputHTML .= "        <div class=\"form-group\">\n";
    $inputHTML .= "          <label for=\"ytb-link\">Youtube Link</label>\n";
    $inputHTML .= "          <input type=\"text\" name=\"ytb-link\" id=\"ytb-link\" value=\"" . $row->CD_YTB_LINK . "\">\n";
    $inputHTML .= "        </div>\n";
    $inputHTML .= "        <div class=\"submit-btn\">\n";
    $inputHTML .= "          <input type=\"submit\" value=\"Modifier\">\n";
    $inputHTML .= "        </div>\n";
    $inputHTML .= "      </form>\n";
}
$inputHTML .= "    </div>\n";
$inputHTML .= "  </div>\n";
$inputHTML .= "</div>\n";
$inputHTML .= "</body>\n";
$inputHTML .= "</html>\n";

echo $inputHTML;

