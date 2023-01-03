<?php
$html = file_get_contents('../components/navbar.html');
include '../bd_connection/bd_connection.php';

$inputHTML = "<!DOCTYPE html>\n";
$inputHTML .= "<html lang=\"fr\">\n";
$inputHTML .= "<head>\n";
$inputHTML .= "    <meta charset=\"UTF-8\">\n";
$inputHTML .= "    <link rel=\"shortcut icon\" href=\"../img/favicon.ico\" type=\"image/x-icon\">\n";
$inputHTML .= "    <link rel=\"stylesheet\" href=\"css/style.css\">\n";
$inputHTML .= "    <link rel=\"stylesheet\" href=\"../components/css/style.css\">\n";
$inputHTML .= "    <link rel=\"stylesheet\" href=\"https://fonts.googleapis.com/css?family=Inter-Medium\">\n";
$inputHTML .= "    <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">\n";
$inputHTML .= "    <link href=\"http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.3.0/css/font-awesome.css\" rel=\"stylesheet\"  type='text/css'>\n";
$inputHTML .= "    <title>MusicPalace - Les Styles</title>\n";
$inputHTML .= "</head>\n";
$inputHTML .= "<body>\n";

$inputHTML .= $html."\n";

$inputHTML .= "    <h1>LES STYLES</h1>\n";

$connexion = OpenCon();
$results = $connexion->query("SELECT DISTINCT CD_GENRE FROM CD ORDER BY CD_GENRE");
$results->setFetchMode(PDO::FETCH_OBJ);
while ($row = $results->fetch()) {
    $inputHTML .= "        <h2>$row->CD_GENRE</h2>";
    $results2 = $connexion->query("SELECT * FROM CD WHERE CD_GENRE = '$row->CD_GENRE' ORDER BY CD_ARTIST, CD_TITRE");
    $results2->setFetchMode(PDO::FETCH_OBJ);
    $inputHTML .= "    <div class=\"container\">\n";
    while ($row2 = $results2->fetch()) {
        $img = $row2->CD_IMAGE;
        $artist = $row2->CD_ARTIST;
        $title = $row2->CD_TITRE;
        $id = $row2->CD_ID;
        $inputHTML .= "        <a href=\"../cd_infos/cd_infos.php?id=$id\"><div class=\"item\">";
        $inputHTML .= "            <img class=\"cd-img\" id=\"$id\" src=\"$img\" >";
        $inputHTML .= "<p class=\"artist-name\">$artist</p><p class=\"title\">$title</p></div></a>\n";

    }
    $inputHTML .= "    </div>\n";
}

$results->closeCursor();
CloseCon($connexion);
$inputHTML .= "    </div>\n";

$inputHTML .= "</body>\n";
$inputHTML .= "</html>\n";
echo $inputHTML;