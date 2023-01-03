<?php
    function OpenCon()
    {
        $PARAM_host = 'mysql-cnaudi.alwaysdata.net';
        $PARAM_bdd = 'cnaudi_bd';
        $PARAM_user = 'cnaudi';
        $PARAM_pass = 'xiwcor-Napfe4-rejfix';

        $connexion = new PDO('mysql:host=' . $PARAM_host . ';dbname=' . $PARAM_bdd, $PARAM_user, $PARAM_pass);

        return $connexion;
    }

    function CloseCon($connexion)
    {
        $connexion = null;
    }
?>