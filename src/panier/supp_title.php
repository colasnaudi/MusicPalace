<?php
    include '../bd_connection/bd_connection.php';
    $id = $_GET['id'];
    $connexion = OpenCon();
    $sql = "DELETE FROM PANIER WHERE CD_ID = $id";
    $result = $connexion->query($sql);
    header('Location: panier.php');
