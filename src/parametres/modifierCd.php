<?php
    include '../bd_connection/bd_connection.php';

    $id = $_GET['id'];

    $artist = $_POST['artist'];
    $titre = $_POST['titre'];
    $genre = $_POST['genre'];
    $prix = $_POST['prix'];
    $image = $_POST['image'];
    $ytbLink = $_POST['ytb-link'];

    $connexion = OpenCon();
    $connexion->query("UPDATE CD SET CD_ARTIST = '$artist', CD_TITRE = '$titre', CD_GENRE = '$genre', CD_PRICE = $prix, CD_IMAGE = '$image', CD_YTB_LINK = '$ytbLink' WHERE CD_ID = $id");
    header("Location: gererCds.php");
