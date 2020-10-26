<?php
//fichier php gérant les requêtes de la base données pour les véhicules

//inserer les véhicules dans la base de données
function insert_vehicule($voiture, $json){

    $nb = 1;
    $location = "disponible";

    require ('./modele/connect.php');

    $req = $pdo->prepare('INSERT INTO vehicule (type_vehicule, nb_vehicule, caract_vehicule, location_vehicule, photo_vehicule) VALUES (?,?,?,?,?)');
    $req->execute(array($voiture, $nb, $json, $location, $voiture));
}

?>