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
    $inputHTML .= "    <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">\n";
    $inputHTML .= "    <link rel=\"stylesheet\" href=\"https://fonts.googleapis.com/css?family=Inter-Medium\">\n";
    $inputHTML .= "    <link href=\"http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.3.0/css/font-awesome.css\" rel=\"stylesheet\"  type='text/css'>\n";
    $inputHTML .= "    <title>MusicPalace</title>\n";
    $inputHTML .= "</head>\n";
    $inputHTML .= "<body>\n";

    $inputHTML .= $html."\n";

    $inputHTML .= "    <h1>TOUS LES TITRES</h1>\n";

    $inputHTML .= "    <div class=\"container\">\n";

    $connexion = OpenCon();
    $results = $connexion->query("SELECT * FROM CD ORDER BY RAND()");
    $results->setFetchMode(PDO::FETCH_OBJ);
    while ($row = $results->fetch()) {
        $img = $row->CD_IMAGE;
        $artist = $row->CD_ARTIST;
        $title = $row->CD_TITRE;
        $id = $row->CD_ID;
        $inputHTML .= "        <a href=\"../cd_infos/cd_infos.php?id=$id\"><div class=\"item\">";
        $inputHTML .= "            <img class=\"cd-img\" id=\"$id\" src=\"$img\" >";
        $inputHTML .= "<p class=\"artist-name\">$artist</p><p class=\"title\">$title</p></div></a>\n";
    }
    $results->closeCursor();
    CloseCon($connexion);

    $inputHTML .= "    </div>\n";
    $inputHTML .= "</body>\n";
    $inputHTML .= "<script src=\"js/script.js\"></script>\n";
    $inputHTML .= "</html>\n";
    echo $inputHTML;