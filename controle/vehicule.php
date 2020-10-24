<?php

//fonction permettant d'afficher les véhicule dans la base données
function afficherVehicule() {

    //connexion à la bdd
    require ('./modele/connect.php');

    //On recupere tout le contenu de la table vehicule
    $sql = $pdo->query('SELECT * FROM vehicule');

    while ($donnees = $sql->fetch()) {
        
    }
}

?>