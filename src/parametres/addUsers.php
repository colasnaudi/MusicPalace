<?php
    include '../bd_connection/bd_connection.php';

    $prenom = $_POST['prenom'];
    $nom = $_POST['nom'];
    $login = $_POST['login'];
    $password = $_POST['password'];
    $admin = $_POST['admin'];

    $conn = OpenCon();
    $sql = "INSERT INTO USER (USER_SURNAME, USER_NAME, USER_LOGIN, USER_PASSWD, USER_IS_ADMIN) VALUES ('$prenom', '$nom', '$login', '$password', '$admin')";
    $result = $conn->query($sql);
    CloseCon($conn);
    header ('Location: addUsersParametres.php');
?>