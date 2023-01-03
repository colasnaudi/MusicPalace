<?php
    $html = file_get_contents('../components/navbar.html');
    include '../bd_connection/bd_connection.php';
    $id = $_GET['id'];

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

    $connexion = OpenCon();
    $results = $connexion->query("SELECT * FROM CD WHERE CD_ID = $id");
    $results->setFetchMode(PDO::FETCH_OBJ);
    while ($row = $results->fetch()) {
        $inputHTML .= "    <title>MusicPalace - $row->CD_ARTIST ($row->CD_TITRE)</title>\n";
    }

    $inputHTML .= "</head>\n";
    $inputHTML .= "<body>\n";

    $inputHTML .= $html."\n";

    $inputHTML .= "    <div class=\"container\">\n";


    $results = $connexion->query("SELECT * FROM CD WHERE CD_ID = $id");
    $results->setFetchMode(PDO::FETCH_OBJ);
    while ($row = $results->fetch()) {
        $img = $row->CD_IMAGE;
        $artist = $row->CD_ARTIST;
        $title = $row->CD_TITRE;
        $genre = $row->CD_GENRE;
        $prix = $row->CD_PRICE;
        $ytbLink = $row->CD_YTB_LINK;

        $inputHTML .= "            <div class=\"cd_infos_img\">\n";
        $inputHTML .= "                <img src=\"$img\" alt=\"\">\n";
        $inputHTML .= "            </div>\n";
        $inputHTML .= "            <div class=\"cd_infos_text\">\n";
        $inputHTML .= "                <h2>Caractéristiques</h2>\n";
        $inputHTML .= "                <div class=\"cd-infos\">\n";
        $inputHTML .= "                    <div class='row'><p class=\"cd-infos-attr\">Artiste</p> <p class=\"cd-infos-info\">$artist</p></div>\n";
        $inputHTML .= "                    <div class='row'><p class=\"cd-infos-attr\">Titre</p> <p class=\"cd-infos-info\">$title</p></div>\n";
        $inputHTML .= "                    <div class='row'><p class=\"cd-infos-attr\">Genre</p> <p class=\"cd-infos-info\">$genre</p></div>\n";
        $inputHTML .= "                </div>\n";
        $inputHTML .= "                <div class=\"cd-price\">\n";
        $inputHTML .= "                    <h2>Prix</h2>\n";
        $inputHTML .= "                    <p>$prix €</p>\n";
        $inputHTML .= "                </div>\n";
        $inputHTML .= "                <a href='../panier/panier.php?id=$id'>Ajouter au panier<i class='fa fa-lg fa-shopping-cart'></i></a>\n";
        $inputHTML .= "            </div>\n";
        $inputHTML .= "        </div>\n";
        $inputHTML .= "    <div class=\"video\">\n";
        $inputHTML .= "        <iframe src=\"$ytbLink\" title=\"YouTube video player\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture\" allowfullscreen></iframe>\n";
        $inputHTML .= "    </div>\n";
    }

    $results->closeCursor();
    CloseCon($connexion);
    $inputHTML .= "</body>\n";
    $inputHTML .= "</html>\n";
    echo $inputHTML;