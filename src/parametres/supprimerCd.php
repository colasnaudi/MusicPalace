<?php
    include '../bd_connection/bd_connection.php';

    $id = $_GET['id'];
    $connexion = OpenCon();
    $connexion->query("DELETE FROM CD WHERE CD_ID = $id");

    header('Location: gererCds.php');
