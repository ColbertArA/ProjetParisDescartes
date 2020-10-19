<?php

$nom_client = $_POST['nom'];
$mdp_client = $_POST['mdp'];
$mail_client = $_POST['mail'];

inscription($nom_client, $mdp_client, $mail_client);

function inscription($nom, $mdp, $mail){
    //connexion à la base de données
    require("./modele/connect.php");

    //insertion des données
    $req = $bdd->prepare('INSERT INTO client(nom_client, mdp_client, mail_client) VALUES($nom, $mdp, $mail)');

    echo 'Inscription réussie !'
}

//fonction sha, cryptage du mot de passe
function sha($mdp){

    $sha = sha1($mdp);
    return $sha;
}

?>