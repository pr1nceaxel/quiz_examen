<?php

    $server = "127.0.0.1";
    $utilisateur = "root";
    $motdepasse = "";
    $dbname = "orange";

    $connexion = mysqli_connect($server, $utilisateur, $motdepasse, $dbname);

// Vérifiez la connexion
if ($connexion->connect_error) {
    die("La connexion a échoué : " . $connexion->connect_error);
}

   
