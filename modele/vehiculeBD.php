<?php
//fichier php gérant les requêtes de la base données pour les véhicules

//inserer les véhicules dans la base de données
function insert_vehicule($voiture, $json){

    $nb = 1;
    $location = "disponible";

    require ('./modele/connect.php');

    $req = $pdo->prepare('INSERT INTO vehicule (type_vehicule, nb_vehicule, caract_vehicule, location_vehicule, photo_vehicule) VALUES (?,?,?,?,?)');
    $req->execute(array($voiture, $nb, $json, $location, $voiture));

    stockVehicule($voiture);
}


function stockVehicule($voiture){

    require ('./modele/connect.php');

    $sql = $pdo->prepare('SELECT COUNT(*) AS nb FROM vehicule WHERE type_vehicule = :vehicule');
    $sql->execute(array('vehicule' => $voiture));
    $donnees = $sql->fetch(PDO::FETCH_ASSOC);
    $nb = $donnees['nb'];
    $sql->closeCursor();

    $req = $pdo->prepare('UPDATE vehicule SET nb_vehicule = :nb WHERE type_vehicule = :vehicule');
    $req->bindParam(':nb', $nb);
    $req->bindParam(':vehicule', $voiture);
    $req->execute();

}

?>