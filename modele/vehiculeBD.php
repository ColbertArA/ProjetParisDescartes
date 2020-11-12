<?php
//fichier php gérant les requêtes de la base données pour les véhicules

//inserer les véhicules dans la base de données
function insert_vehicule($voiture, $json, $marque, $couleur, $prix)
{

    $id = getIdVehicule();
    $nb = 1;
    $location = "disponible";
    $nom_photo = $marque . $voiture . $couleur . $id;

    require ('./modele/connect.php');

    $req = $pdo->prepare('INSERT INTO vehicule (id_client, type_vehicule, nb_vehicule, caract_vehicule, location_vehicule, prix_vehicule, photo_vehicule) VALUES (?,?,?,?,?,?,?)');
    $req->execute(array($_SESSION['id_client'], $voiture, $nb, $json, $location, $prix, $nom_photo));

    stockVehicule($voiture);
}

//recherche le dernier id du véhicule inséré
function getIdVehicule()
{
    require ('./modele/connect.php');

    $sql = $pdo->prepare('SELECT MAX(id_vehicule) FROM vehicule');
    $sql->execute();
    $donnee = $sql->fetch(PDO::FETCH_ASSOC);

    return $donnee['MAX(id_vehicule)'] + 1;
}

//actualise le nombre de véhicule en stock
function stockVehicule($voiture)
{

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
function reqLocation($idU) 
{

    require ('./modele/connect.php');

    $sql = $pdo->prepare('SELECT * FROM vehicule WHERE id_vehicule = :idU');
    $sql->execute(array('idU' => $idU));
    $donnees = $sql->fetch(PDO::FETCH_ASSOC);
    return $donnees;
}

// insert dans la bdd une facturation de la location d'un véhicule part une entreprise
function louer_vehicule($idU)
{

    require ('./modele/connect.php');

    $sql = $pdo->prepare('UPDATE vehicule SET location_vehicule = :location WHERE id_vehicule = :id_vehicule');
    $sql->bindParam(':location', $_SESSION['id_entreprise']);
    $sql->bindParam(':id_vehicule', $idU);
    $sql->execute();
    
}

//permet de supprimer un vehicule de la bdd lorsqu'un loueur le souhaite
function supprimer_vehicule($idU)
{

    require ('./modele/connect.php');

    $req = $pdo->prepare('DELETE FROM vehicule WHERE id_vehicule = :id_vehicule');
    $req->bindParam(':id_vehicule', $idU);
    $req->execute();

}

//met à jour la bdd lorsqu'un loueur met son véhicule en révision
function modifier_vehicule($idU)
{

    require ('./modele/connect.php');
    $location = "en_revision";

    $sql = $pdo->prepare('UPDATE vehicule SET location_vehicule = :location WHERE id_vehicule = :id_vehicule');
    $sql->bindParam(':location', $location);
    $sql->bindParam(':id_vehicule', $idU);
    $sql->execute();
}

//met à jour la bdd lorsqu'un loueur met son véhicule à disposition de nouveau
function vehicule_disponible($idU)
{

    require ('./modele/connect.php');
    $location = "disponible";
    
    $sql = $pdo->prepare('UPDATE vehicule SET location_vehicule = :location WHERE id_vehicule = :id_vehicule');
    $sql->bindParam(':location', $location);
    $sql->bindParam(':id_vehicule', $idU);
    $sql->execute();

}

?>