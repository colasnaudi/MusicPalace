<?php
    include '../bd_connection/bd_connection.php';

    $id = $_GET['id'];
    $connexion = OpenCon();
    $connexion->query("DELETE FROM USER WHERE USER_ID = $id");

    header('Location: gererUsers.php');