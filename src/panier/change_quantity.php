<?php
    include '../bd_connection/bd_connection.php';
    $type = $_GET['type'];
    $id = $_GET['id'];
    $qt = $_GET['qt'];
    $connexion = OpenCon();
    if ($type == "more"){
        $sql = "UPDATE PANIER SET PANIER_QUANTITY = '$qt'+1 WHERE CD_ID = '$id'";
    }
    else{
        if($qt > 1){
            $sql = "UPDATE PANIER SET PANIER_QUANTITY = '$qt'-1 WHERE CD_ID = '$id'";
        }
        else{
            $sql = "DELETE FROM PANIER WHERE CD_ID = '$id'";
        }
    }

    $result = $connexion->query($sql);
    header('Location: panier.php');