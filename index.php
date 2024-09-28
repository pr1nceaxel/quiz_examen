<?php
include('base.php');


// Fonction pour obtenir la moyenne des avis pour une commune spécifique
function getMoyenneForCommune($connexion, $commune)
{
    $requete = "SELECT AVG(note) AS moyenne FROM avis WHERE commune=?";
    $stmt = $connexion->prepare($requete);
    $stmt->bind_param("s", $commune);
    $stmt->execute();
    $resultat = $stmt->get_result();

    if ($resultat->num_rows > 0) {
        return $resultat->fetch_assoc()['moyenne'];
    } else {
        return 0; // Si aucune note n'est disponible pour la commune
    }
}

// Fonction pour obtenir la moyenne générale des avis
function getNoteGenerale($connexion)
{
    $requete = "SELECT AVG(note) AS moyenne FROM avis";
    $resultat = $connexion->query($requete);

    if ($resultat->num_rows > 0) {
        return $resultat->fetch_assoc()['moyenne'];
    } else {
        return 0; // Si aucune note n'est disponible
    }
}

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Enquête Orange</title>
    <!-- Include Tailwind CSS -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <!-- Add your custom styles here -->
    <script>
        // Vérifiez si le paramètre de succès est présent dans l'URL
        const params = new URLSearchParams(window.location.search);
        const successParam = params.get('success');

        // Si le paramètre de succès est présent et vaut 1, affichez le popup
        if (successParam === '1') {
            window.onload = function () {
                alert("Enregistrement réussi !"); // Vous pouvez utiliser une librairie de modales pour une apparence plus moderne
            };
            
            // Effacez le paramètre de succès de l'URL pour éviter l'affichage répété
            window.history.replaceState({}, document.title, window.location.pathname);
        }
    </script>
</head>
<body>
        <div class="bg-gray-500 text-white flex justify-center items-center p-4 mb-8">
            <h1 class="text-2xl">Bannière</h1>
        </div>
    <div class="justify-center  px-20   m-6">
        <div class="m-6 flex bg-gray-300  justify-center items-center border border-gray-300 pl-2    p-3">
            <h2 class="text-xl font-bold">Note générale: <span><?php echo htmlspecialchars(number_format(getNoteGenerale($connexion), 1)); ?></span></h2>
        </div>
        
        <!-- Ajouter une nouvelle note -->
        <div class=" text-white flex justify-center items-center p-4 mb-8">
            <a  href="formulaire.html" class="mb-6 bg-black  text-white flex justify-center items-center border rounded-full    border-gray-300 text-xl font-bold p-3">+  Ajouter une nouvelle note</a>
        </div>

        <!-- Communes -->
        <!-- Grille pour les communes -->
        <div class="grid grid-cols-2  gap-5  px-20">
            <!-- Yopougon -->
            <!-- Yopougon -->
<a  href="avis.php?commune=Yopougon" class="bg-black text-white border border-gray-300 text-center  m-2 p-4">
    <h2 class="text-xl font-bold">  Yopougon:   </h2>
    <span> <?php echo htmlspecialchars(number_format(getMoyenneForCommune($connexion, 'Yopougon'), 1)); ?></span>

</a>

            <!-- Cocody -->
            <a href="avis.php?commune=Cocody" class="bg-black text-white  border   text-center    border-gray-300 m-2  p-4">
                <h2 class="text-xl font-bold">Cocody:</h2>
                <span> <?php echo htmlspecialchars(number_format(getMoyenneForCommune($connexion, 'Cocody'), 1)); ?></span>
            </a>
            <!-- Koumassi -->
            <a href="avis.php?commune=Koumassi" class="bg-black text-white text-center border border-gray-300 p-4">
                <h2 class="text-xl font-bold">Koumassi:</h2>
                <span> <?php echo htmlspecialchars(number_format(getMoyenneForCommune($connexion, 'Koumassi'), 1)); ?></span>
            </a>
            <!-- Treichville -->
            <a href="avis.php?commune=Treichville" class=" bg-black text-white  text-center border border-gray-300 p-4">
                <h2 class="text-xl font-bold">Treichville:</h2>
                <span> <?php echo htmlspecialchars(number_format(getMoyenneForCommune($connexion, 'Treichville'), 1)); ?></span>
            </a>
        </div>
    </div>
</body>
</html>


