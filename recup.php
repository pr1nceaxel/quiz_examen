<?php


include("base.php");

if($connexion->connect_error) {
    echo " erreur de connexion ".$connexion->connect_error; 
} 
else {

    // echo "  connexion reussie"."<br>";
    
    $requete = "SELECT id, nom, prenom  , email, note, description FROM avis";
    $resultats = $connexion->query($requete); 
    
    if(!empty($resultats)){
        // echo " requete reussie"."<br>";

        $data =[];
        while($row = $resultats->fetch_assoc()) {
            
            $data[] = $row;            
        }
        echo json_encode($data);

    }else {
        echo " erreur ".$connexion->error."<br>";
    }
    
    $connexion->close();
}

