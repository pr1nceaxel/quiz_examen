<?php
include('base.php');

$commune = $_GET['commune']; 


$requete = "SELECT nom, prenom, note FROM avis WHERE commune=?";
$stmt = $connexion->prepare($requete);
$stmt->bind_param("s", $commune);
$stmt->execute();
$resultat = $stmt->get_result();

if (!$resultat) {
    echo "ERREUR: %s\n", $connexion->error;
    exit();
}

if ($resultat->num_rows > 0) {
    $resultat->data_seek(0);
    $totalNotes = 0;
    $nombreAvis = $resultat->num_rows;

    while ($row = $resultat->fetch_assoc()) {
        $totalNotes += $row['note'];
    }

    $moyenne = ($nombreAvis > 0) ? round($totalNotes / $nombreAvis, 2) : 0;

}

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Enquête Orange</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body>

    <div class="bg-gray-500 text-white flex justify-center items-center p-4 mb-8">
        <h1 class="text-2xl">Liste des avis de <?php echo htmlspecialchars($commune); ?></h1>
    </div>

    <div class="flex justify-center">
        <div class="text-white bg-black text-center border-r items-center p-4 mb-8">
            <?php
            if ($resultat->num_rows > 0) {
                echo "<h2 class='text-xl font-bold'>NOTE: </h2><span>" . htmlspecialchars($moyenne) . "</span>";
            ?>   
        </div>

        <div class="text-white bg-black text-center border-r items-center p-4 mb-8">
            <?php
                $resultat->data_seek(0);
                echo "<h2 class='text-xl font-bold'>NOMBRE D'AVIS: </h2><span>" . htmlspecialchars($resultat->num_rows) . "</span>";
            ?>
        </div>
    </div>

    <div class="flex justify-center items-center">
        <a href="formulaire.html" class="mb-6 bg-black text-white flex justify-center items-center border rounded-full border-gray-300 text-xl font-bold p-3">+ Ajouter une nouvelle note</a>
    </div><br>

    <div class=" m-3 p-4">
        <?php
// affichage   de  la   liste
            $resultat->data_seek(0);
            echo "";
            while ($row = $resultat->fetch_assoc()) {
                echo '<div class="flex  justify-center items-center p-4 mb-8 "><p>' . htmlspecialchars($row['nom']) . " " . htmlspecialchars($row['prenom']) . "- " . htmlspecialchars($row['note']) . "</p>    </div><br>";   
            }
            
            echo  '
            
            <div class="  flex  justify-center items-center p-4 mb-8">
                <a href="index.php" class="mb-6 bg-red-500 text-white  border rounded-full border-gray-300 text-xl font-bold p-3">RETOUR</a>
            </div> ';

            } else {
                echo '
                <div class="flex flex-col items-center">
                    <p class="mb-4">PAS D\'AVIS POUR CETTE COMMUNE.</p>
                    <a href="formulaire.html" class="bg-black text-white flex justify-center items-center border rounded-full border-gray-300 text-xl font-bold p-3">+ Ajouter une nouvelle note</a>
                </div>
                <div class="flex justify-center items-center p-4 mb-8">
                    <a href="index.php" class="mb-6 bg-red-500 text-white  border rounded-full border-gray-300 text-xl font-bold p-3">RETOUR</a>
                </div>
          ';
            }
        ?>
    </div>



</body>
</html>
