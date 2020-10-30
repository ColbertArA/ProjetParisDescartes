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

    require ('./modele/connect.php');

    $req = $pdo->prepare('INSERT INTO facturation (id_vehicule, id_entreprise, dateD_facturation, dateF_facturation, valeur_facturation, etat_facturation) VALUES (?,?,?,?,?,?)');
    $req->execute(array($idU, $_SESSION['id_entreprise'], $dateD, $dateF, $total, $paiement));

    $sql = $pdo->prepare('UPDATE vehicule SET location_vehicule = :location WHERE id_vehicule = :id_vehicule');
    $sql->bindParam(':location', $_SESSION['id_entreprise']);
    $sql->bindParam(':id_vehicule', $idU);
    $sql->execute();
    
}

//permet de supprimer un vehicule de la bdd lorsqu'un loueur le souhaite
function supprimer_vehicule($idU){

    require ('./modele/connect.php');

    $req = $pdo->prepare('DELETE FROM vehicule WHERE id_vehicule = :id_vehicule');
    $req->bindParam(':id_vehicule', $idU);
    $req->execute();

}

//met à jour la bdd lorsqu'un loueur met son véhicule en révision
function modifier_vehicule($idU){

    require ('./modele/connect.php');
    $location = "en_revision";

    $sql = $pdo->prepare('UPDATE vehicule SET location_vehicule = :location WHERE id_vehicule = :id_vehicule');
    $sql->bindParam(':location', $location);
    $sql->bindParam(':id_vehicule', $idU);
    $sql->execute();
}

//met àjour la bdd lorsqu'un loueur met son véhicule à disposition de nouveau
function vehicule_disponible($idU){

    require ('./modele/connect.php');
    $location = "disponible";
    
    $sql = $pdo->prepare('UPDATE vehicule SET location_vehicule = :location WHERE id_vehicule = :id_vehicule');
    $sql->bindParam(':location', $location);
    $sql->bindParam(':id_vehicule', $idU);
    $sql->execute();

}

//fonction qui récupère dans la bdd les entreprises qui ont une flote de véhicule supérieure ou égale 10
function reduction_vehicule(){

    require ('./modele/connect.php');

    $req = $pdo->prepare('SELECT * FROM entreprise');
    $req->execute();
    
    while ($id = $req->fetch(PDO::FETCH_ASSOC)) {
        $sql = $pdo->prepare('SELECT COUNT(*) AS nb FROM vehicule, entreprise WHERE location_vehicule = :id');
        $sql->execute(array('id' => $id['id_entreprise']));
        $donnees = $sql->fetch(PDO::FETCH_ASSOC);
        $nb = $donnees['nb'];

        if ($nb >= 10) {
            $entreprise = array ($id['id_entreprise']);
        }
    }

    return $entreprise;
}

//fonction qui retourne le nombre de véhicule louer par une entreprise
function nb_vehicule($idE){
    require ('./modele/connect.php');

    $req = $pdo->prepare('SELECT COUNT(*) AS nb FROM vehiule WHERE location_vehicule =:id');
    $req->execute((array('id' => $idE)));
    $donnees = $req->fetch();
    $nb = $donnees['nb'];

    return $nb;
}

//fonction qui retourne le nombre total d'entreprise dans la bdd
function nb_entreprise() {
    
    require ('./modele/connect.php');

    $req = $pdo->prepare('SELECT COUNT(*) AS nb FROM entreprise');
    $req->execute();
    $nb = $req->fetch();
    $tt = $nb['nb'];

    return $tt;
}


//fonction qui permet de mettre à jour la bdd et dentrer la réduction 
function remise_vehicule($prixF, $id) {

    require ('./modele/connect.php');

    $req = $pdo->prepare('UPDATE facturation SET valeur_facturation = :prix WHERE id_entreprise = :id');
    $req->bindParam('prix', $prixF);
    $req->bindParam('id', $id);
    $req->execute();


}

function prix($id) {

    require ('./modele/connect.php');

    $req = $pdo->prepare('SELECT valeur_facturation FROM facturation WHERE id_entreprise = :id');
    $req->execute(array('id' => $id));
    $prix = $req ->fetch();
    $donnees = $prix['valeur_facturation'];
    $req->closeCursor();


    return $donnees;
}

?>