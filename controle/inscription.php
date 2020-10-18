<?php

require("connect.php");

//Fonction sha
$sha = sha1($_POST['mdp'], PASSWORD_DEFAULT);

//Insertion des données des inscriptions dans la base de donnée
$req = $bdd->prepare('INSERT INTO client(nom_client, mdp_client, mail_client VALUES(:nom, :mdp, :mail)');
$req->execute(array(
    'nom' => $nom,
    'mdp' => $sha
    'mail' => $mail));

?>