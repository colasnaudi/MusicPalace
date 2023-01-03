<?php
    $html = file_get_contents('../components/navbar.html');
    include '../bd_connection/bd_connection.php';
    session_start();
    $id = $_SESSION['id'];

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
    $inputHTML .= "    <title>MusicPalace - Panier</title>\n";
    $inputHTML .= "</head>\n";
    $inputHTML .= "<body>\n";

    $inputHTML .= $html . "\n";

    $inputHTML .= "<div class=\"container\">\n";
    $inputHTML .= "    <div class=\"left-part\">\n";
    $inputHTML .= "      <h2>Mon Panier</h2>\n";

    $quantite = 0;
    $connexion = OpenCon();
    if (isset($_GET['id'])) {
        $cd_id = $_GET['id'];
        $sql = "SELECT * FROM PANIER JOIN CD ON PANIER.CD_ID = CD.CD_ID WHERE PANIER.CD_ID = $cd_id and PANIER.USER_ID = $id";
        $result = $connexion->query($sql);
        $result->setFetchMode(PDO::FETCH_OBJ);
        if(!$row = $result->fetch()) {
            $sql = "INSERT INTO PANIER (CD_ID, PANIER_QUANTITY, USER_ID) VALUES ($cd_id, 1, $id)";
            $result = $connexion->query($sql);
        } else {
            $sql = "SELECT PANIER.PANIER_QUANTITY FROM PANIER WHERE PANIER.CD_ID = $cd_id";
            $result = $connexion->query($sql);
            $result->setFetchMode(PDO::FETCH_OBJ);
            $row = $result->fetch();
            $quantite = $row->PANIER_QUANTITY;
            $quantite++;
            $sql = "UPDATE PANIER SET PANIER_QUANTITY = $quantite WHERE CD_ID = $cd_id";
        }
    } else {
        $id = 0;
    }
    $type_less = "less";
    $type_more = "more";
    $id = $_SESSION['id'];
    $results = $connexion->query("SELECT * FROM CD JOIN PANIER ON CD.CD_ID = PANIER.CD_ID WHERE PANIER.USER_ID = $id;");
    $results->setFetchMode(PDO::FETCH_OBJ);
    while ($row = $results->fetch()) {
        $img = $row->CD_IMAGE;
        $artist = $row->CD_ARTIST;
        $title = $row->CD_TITRE;
        $genre = $row->CD_GENRE;
        $prix = $row->CD_PRICE;
        $cd_id = $row->CD_ID;
        $quantite_cd = $row->PANIER_QUANTITY;

        /**
         * @todo : Redimensionner les images
         */
        $inputHTML .= "    <div class=\"container_panier\">\n";
        $inputHTML .= "            <div class=\"cd_infos_img\">\n";
        $inputHTML .= "                <img src=\"$img\" alt=\"\">\n";
        $inputHTML .= "            </div>\n";
        $inputHTML .= "            <div class=\"cd_infos_text\">\n";
        $inputHTML .= "                <div class=\"cd-infos\">\n";
        $inputHTML .= "                    <div class='row'><p class=\"cd-infos-attr\">Artiste</p> <p class=\"cd-infos-info\">$artist</p></div>\n";
        $inputHTML .= "                    <div class='row'><p class=\"cd-infos-attr\">Titre</p> <p class=\"cd-infos-info\">$title</p></div>\n";
        $inputHTML .= "                    <div class='row'><p class=\"cd-infos-attr\">Genre</p> <p class=\"cd-infos-info\">$genre</p></div>\n";
        $inputHTML .= "                </div>\n";
        $inputHTML .= "                <div class=\"cd-price\">\n";
        $inputHTML .= "                    <div class='row'><p class=\"cd-infos-attr\">Prix</p> <p class=\"cd-infos-info prix\">$prix €</p></div>\n";
        $inputHTML .= "                </div>\n";
        $inputHTML .= "                <div class=\"cd-quantity\">\n";
        $inputHTML .= "                    <div class='row'><p class=\"cd-infos-attr\">Quantité</p> <p class='cd-infos-info'>$quantite_cd</p><a class='button btn-more' href='change_quantity.php?type=$type_more&id=$cd_id&qt=$quantite_cd'>+</a><a class='button btn-less' href='change_quantity.php?type=$type_less&id=$cd_id&qt=$quantite_cd'>-</a></div> \n";
        $inputHTML .= "                </div>\n";
        $inputHTML .= "            </div>\n";
        $inputHTML .= "            <div class=\"cd_supp_button\">\n";
        $inputHTML .= "                <a href='supp_title.php?id=$cd_id'><i class=\"fa fa-trash\"></i></a>\n";
        $inputHTML .= "            </div>\n";
        $inputHTML .= "        </div>\n";
    }
    $inputHTML .= "    </div>\n";
    $inputHTML .= "    <div class=\"wrapper\">\n";
    $inputHTML .= "      <div class=\"right-part-top\">\n";
    $inputHTML .= "        <h2>Total</h2>\n";
    $inputHTML .= "        <div class=\"align-start-end\">\n";

    $totalcd = 0;
    $total = 0;
    $frais = 0;
    $cpt = $connexion->query("SELECT COUNT(PANIER_QUANTITY) FROM PANIER WHERE PANIER.USER_ID = $id")->fetchColumn();
    if ($cpt > 0){
        $frais = 1;
    }

    $results = $connexion->query("SELECT * FROM CD JOIN PANIER ON CD.CD_ID = PANIER.CD_ID WHERE PANIER.USER_ID = $id;");
    $results->setFetchMode(PDO::FETCH_OBJ);
    while ($row = $results->fetch()) {
        $totalcd = $totalcd + $row->CD_PRICE * $row->PANIER_QUANTITY;
        $total = $totalcd + $frais;
    }

    $inputHTML .= "          <h3>Sous-total</h3><p>$totalcd €</p>\n";
    $inputHTML .= "        </div>\n";
    $inputHTML .= "        <div class=\"align-start-end\">\n";
    $inputHTML .= "          <h3>Frais de livraison</h3><p>$frais €</p>\n";
    $inputHTML .= "        </div>\n";
    $inputHTML .= "        <hr>\n";
    $inputHTML .= "        <div class=\"align-start-end\">\n";
    $inputHTML .= "          <h3>Total (TVA incluse)</h3><p class=\"final-price\">$total €</p>\n";
    $inputHTML .= "        </div>\n";
    $inputHTML .= "        <div class=\"btn\">\n";
    if($total > 0){
        $inputHTML .= "          <a href='../checkout/verification.php?total=$total'>\n";
    }
    $inputHTML .= "          <button class=\"btn\" >Commander</button>\n";
    $inputHTML .= "          </a>\n";
    $inputHTML .= "        </div>\n";
    $inputHTML .= "      </div>\n";
    $inputHTML .= "      <div class=\"right-part-bottom\">\n";
    $inputHTML .= "        <h2>Nous acceptons</h2>\n";
    $inputHTML .= "        <div class=\"payment\">\n";
    $inputHTML .= "          <img src=\"../img/Logo_CB.jpg\">\n";
    $inputHTML .= "          <img src=\"../img/Logo_MASTERCARD.svg.png\">\n";
    $inputHTML .= "          <img src=\"../img/Logo_VISA.png\">\n";
    $inputHTML .= "      </div>\n";
    $inputHTML .= "    </div>\n";
    $inputHTML .= "  </div>\n";

    $results->closeCursor();
    CloseCon($connexion);

    $inputHTML .= "</body>\n";
    $inputHTML .= "</html>\n";
    echo $inputHTML;
