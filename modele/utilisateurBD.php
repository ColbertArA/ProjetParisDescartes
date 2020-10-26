<?php

//fonction vérifiant s'il existe des doublons
function verif_dbl($mail, $choix) {

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

?>