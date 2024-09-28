<?php

include('base.php');

// Récupérez les données du formulaire
$nom = $_POST['nom'];
$prenom = $_POST['prenom'];
$email = $_POST['email'];
$note = $_POST['note'];
$commune = $_POST['commune'];

// Validez les données (ajoutez votre propre logique de validation si nécessaire)

// Enregistrez les données dans la base de données
$sql = "INSERT INTO avis (nom, prenom, email, note, commune) VALUES ('$nom', '$prenom', '$email', '$note',  '$commune')";


    if ($connexion->query($sql) === TRUE) {
        // Redirigez l'utilisateur vers la page d'accueil avec un message de succès
        header("Location: index.php?success=1");
    } else {
        // Redirigez l'utilisateur vers la page d'accueil avec un message d'erreur
        header("Location: index.php?error=1");
    }
 ?>