<?php
//fichier php gérant les requêtes de la base de données pour les utilisateurs

//fonction vérifiant s'il existe des doublons
function verif_dbl($mail) {

	require ('./modele/connect.php');

	//fait une requete pour la table client
	$req = $pdo->prepare('SELECT mail_client FROM client WHERE mail_client = :mail');
	$req->execute(array('mail' => $mail));
	$reponse = $req->fetch(PDO::FETCH_ASSOC);
	$req->closeCursor();

	//fait une requete pour la table entreprise
	$req = $pdo->prepare('SELECT mail_entreprise FROM entreprise WHERE mail_entreprise = :mail');
	$req->execute(array('mail' => $mail));
	$reponse2 = $req->fetch(PDO::FETCH_ASSOC);
	$req->closeCursor();
	
	// Vérification si le mail est déjà utilisé dans les deux tables
	if($reponse != 0 || $reponse2 != 0 ){
		return false;
	} else {
		return true;
	}
}

//function permettant de renvoyer les données de la table client
function ident_client($mail, $c){

	require ('./modele/connect.php');

	//données tirées de la table client
	$sql = $pdo->prepare('SELECT * FROM client WHERE mdp_client = :mdp AND mail_client = :mail');
	$sql->execute(array('mdp' => $c, 'mail' => $mail));
	$donnees_client = $sql->fetch(PDO::FETCH_ASSOC);
	$sql->closeCursor();
	return $donnees_client;
}

//fonction permettant de renvoyer les données de la table entreprise
function ident_entreprise($mail, $c){

	require ('./modele/connect.php');

	//données tirées de la table entreprise
	$sql = $pdo->prepare('SELECT * FROM entreprise WHERE mdp_entreprise = :mdp AND mail_entreprise = :mail');
	$sql->execute(array('mdp' => $c, 'mail' => $mail));
	$donnees_entreprise = $sql->fetch(PDO::FETCH_ASSOC);
	$sql->closeCursor();
	return $donnees_entreprise;
}

//fonction permettant les insertion dans la table entreprise
function insert_entreprise($nom, $c, $mail){

	require ('./modele/connect.php');

	// Pour inserer les données 
	$req = $pdo->prepare('INSERT INTO entreprise (nom_entreprise, mdp_entreprise, mail_entreprise) VALUES(?,?,?)');
	$req->execute(array($nom, $c, $mail));

}

//fonction qui renvoie le nombre d'entreprise dans la bdd
function nbEntreprise(){

	require ('./modele/connect.php');

	$req = $pdo->prepare('SELECT COUNT(*) AS nb FROM entreprise');
	$req->execute();
	$d = $req->fetch();

	return $nb = $d['nb'];
}

?>