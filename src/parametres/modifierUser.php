<?php
    include '../bd_connection/bd_connection.php';

    $id = $_GET['id'];
    $prenom = $_POST['prenom'];
    $nom = $_POST['nom'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $role = $_POST['role'];

    $connexion = OpenCon();
    $connexion->query("UPDATE USER SET USER_NAME = '$nom', USER_SURNAME = '$prenom', USER_LOGIN = '$email', USER_PASSWD = '$password', USER_IS_ADMIN = $role WHERE USER_ID = $id");
    header("Location: gererUsers.php");
