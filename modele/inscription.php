<?php

$nom_client = isset($_POST['nom'])?($_POST['nom']):'';
$mdp_client = isset($_POST['mdp'])?($_POST['mdp']):'';
$mail_client = isset($_POST['mail'])?($_POST['mail']):'';

if (count($_POST)==0){
    require ("./vue/index.html") ;
    else{
        inscription($nom_client, $mdp_client, $mail_client);
    }
}


function inscription($nom, $mdp, $mail){
    //connexion à la base de données
    require("./modele/connect.php");

    //insertion des données
    $req = $bdd->prepare('INSERT INTO client(nom_client, mdp_client, mail_client) VALUES(:nom, :mdp, :mail)');
    $req->execute(array(
        'nom' => $nom,
        'mdp' => sha($mdp),
        'mail' => $mail
    ));

    echo 'Inscription réussie !'
}

//fonction sha, cryptage du mot de passe
function sha($mdp){

    $sha = sha1($mdp);
    return $sha;
}

?>