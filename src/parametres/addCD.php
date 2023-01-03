<?php
    include '../bd_connection/bd_connection.php';

    $titre = $_POST['titre'];
    $artiste = $_POST['artiste'];
    $genre = $_POST['genre'];
    $prix = $_POST['prix'];
    $image = $_POST['image'];
    $ytbLink = $_POST['ytb-link'];

    $conn = OpenCon();
    $sql = "INSERT INTO CD (CD_ARTIST, CD_TITRE, CD_GENRE, CD_PRICE, CD_IMAGE, CD_YTB_LINK) VALUES ('$artiste', '$titre', '$genre', '$prix', '$image', '$ytbLink')";
    $result = $conn->query($sql);
    CloseCon($conn);
    header ('Location: addCDParametres.php');
?>