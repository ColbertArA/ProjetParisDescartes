<?php
//fichier php gérant les requêtes de la base données pour les véhicules

//inserer les véhicules dans la base de données
function insert_vehicule($voiture, $json, $prix){

    $nb = 1;
    $location = "disponible";

    require ('./modele/connect.php');

    $req = $pdo->prepare('INSERT INTO vehicule (id_client, type_vehicule, nb_vehicule, caract_vehicule, location_vehicule, prix_vehicule, photo_vehicule) VALUES (?,?,?,?,?,?,?)');
    $req->execute(array($_SESSION['id_client'], $voiture, $nb, $json, $location, $prix, $voiture));

    stockVehicule($voiture);
}

//actualise le nombre de véhicule en stock
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

//renvoie les données de la voiture que l'entreprise souhaite voir
function reqLocation($idU) {

    require ('./modele/connect.php');

    $sql = $pdo->prepare('SELECT * FROM vehicule WHERE id_vehicule = :idU');
    $sql->execute(array('idU' => $idU));
    $donnees = $sql->fetch(PDO::FETCH_ASSOC);
    return $donnees;
}

// insert dans la bdd une facturation de la location d'un véhicule part une entreprise
function louer_vehicule($idU, $dateD, $dateF, $total, $paiement){

    $locationVehicule = "en_cours";
    require ('./modele/connect.php');

    $req = $pdo->prepare('INSERT INTO facturation (id_vehicule, id_entreprise, dateD_facturation, dateF_facturation, valeur_facturation, etat_facturation) VALUES (?,?,?,?,?,?)');
    $req->execute(array($idU, $_SESSION['id_entreprise'], $dateD, $dateF, $total, $paiement));

    $sql = $pdo->prepare('UPDATE vehicule SET location_vehicule = :location WHERE id_vehicule = :id_vehicule');
    $sql->bindParam(':location', $locationVehicule);
    $sql->bindParam(':id_vehicule', $idU);
    $sql->execute();
    
}

?>