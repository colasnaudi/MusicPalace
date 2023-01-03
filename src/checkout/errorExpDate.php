<?php
    $css_link = "<link rel='stylesheet' href='css/wrongExpirationDate.css'>";
    $html = file_get_contents('checkout.html');

    // replace <!--CSS-HERE--> with $css_link
    $html = str_replace('<!--CSS-HERE-->', $css_link, $html);

    echo $html;