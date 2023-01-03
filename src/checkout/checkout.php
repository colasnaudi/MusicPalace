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
    $inputHTML .= "    <!--CSS-HERE-->\n";
    $inputHTML .= "    <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">\n";
    $inputHTML .= "    <link rel=\"stylesheet\" href=\"https://fonts.googleapis.com/css?family=Inter-Medium\">\n";
    $inputHTML .= "    <link href=\"http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.3.0/css/font-awesome.css\" rel=\"stylesheet\"  type='text/css'>\n";
    $inputHTML .= "    <title>MusicPalace - Checkout</title>\n";
    $inputHTML .= "</head>\n";
    $inputHTML .= "<body>\n";

    $inputHTML .= $html . "\n";

    $inputHTML .= "<div class=\"checkout\">\n";
    $inputHTML .= "    <div class=\"checkout__body\">\n";
    $inputHTML .= "        <div class=\"checkout-form\">\n";
    $inputHTML .= "            <div class=\"credit-card\">\n";
    $inputHTML .= "                <div class=\"credit-card__header\">\n";
    $inputHTML .= "                    <h2 class=\"credit-card__title\">Checkout</h2>\n";
    $inputHTML .= "                </div>\n";
    $inputHTML .= "                <div class=\"credit-card__body\">\n";
    $inputHTML .= "                    <form action=\"verification.php\" method=\"post\">\n";
    $inputHTML .= "                        <div class=\"credit-card__form\">\n";
    $inputHTML .= "                            <div class=\"credit-card__form__group\">\n";
    $inputHTML .= "                                <label for=\"card-number\" class=\"credit-card__form__label\">Numero de carte</label>\n";
    $inputHTML .= "                                <input type=\"text\" name=\"card-number\" id=\"card-number\" class=\"credit-card__form__input\" placeholder=\"1234 5678 9012 3456\" required>\n";
    $inputHTML .= "                            </div>\n";
    $inputHTML .= "                            <div class=\"credit-card__form__group\">\n";
    $inputHTML .= "                                <label for=\"card-holder\" class=\"credit-card__form__label\">Nom</label>\n";
    $inputHTML .= "                                <input type=\"text\" name=\"card-holder\" id=\"card-holder\" class=\"credit-card__form__input\" placeholder=\"John Doe\" required>\n";
    $inputHTML .= "                            </div>\n";
    $inputHTML .= "                            <div class=\"credit-card__form__group bottom-group\">\n";
    $inputHTML .= "                                <div class=\"credit-card__form__group__left\">\n";
    $inputHTML .= "                                    <label for=\"expiration-date\" class=\"credit-card__form__label expiration\">Date d'expiration</label>\n";
    $inputHTML .= "                                    <input type=\"text\" name=\"expiration-date\" id=\"expiration-date\" class=\"credit-card__form__input\" placeholder=\"MM/YY\" required>\n";
    $inputHTML .= "                                </div>\n";
    $inputHTML .= "                                <div class=\"credit-card__form__group__right\">\n";
    $inputHTML .= "                                    <label for=\"cvv\" class=\"credit-card__form__label\">CVV</label>\n";
    $inputHTML .= "                                    <input type=\"text\" name=\"cvv\" id=\"cvv\" class=\"credit-card__form__input\" placeholder=\"123\" required>\n";
    $inputHTML .= "                                </div>\n";
    $inputHTML .= "                            </div>\n";
    $inputHTML .= "                        </div>\n";
    $inputHTML .= "                        <div class=\"credit-card__footer\">\n";
    $inputHTML .= "                            <a href='verification.php'>\n";

    $connexion = OpenCon();
    $totalcd = 0;
    $results = $connexion->query("SELECT * FROM CD JOIN PANIER ON CD.CD_ID = PANIER.CD_ID WHERE PANIER.USER_ID = $id");
    $results->setFetchMode(PDO::FETCH_OBJ);
    while ($row = $results->fetch()) {
        $totalcd = $totalcd + $row->CD_PRICE * $row->PANIER_QUANTITY;
        $total = $totalcd + 1;
    }
    $results->closeCursor();
    CloseCon($connexion);

    $inputHTML .= "                            <button type=\"submit\" class=\"credit-card__footer__button\">Payer $total €</button>\n";
    $inputHTML .= "                            </a>\n";
    $inputHTML .= "                        </div>\n";
    $inputHTML .= "                    </form>\n";
    $inputHTML .= "                </div>\n";
    $inputHTML .= "            </div>\n";
    $inputHTML .= "        </div>\n";
    $inputHTML .= "    </div>\n";
    $inputHTML .= "</div>\n";

    $inputHTML .= "</body>\n";
    $inputHTML .= "</html>\n";

    $file = fopen("checkout.html", "w+");
    fwrite($file, $inputHTML);
    fclose($file);

    header("Location: checkout.html");