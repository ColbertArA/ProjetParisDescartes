<?php

function verif_ident($mail, $mdp, &$profil){
    require('connect.php');

	$sql = $bdd->prepare('SELECT mail_client, mdp_client FROM client WHERE mail_client = ? AND mdp_client = ?');
	$sql->execute(array($mail, $mdp));
    try{
        $commande = $pdo->prepare($sql);
		$commande->bindParam(':mail', $mail);
		$commande->bindParam(':mdp', $mdp);
		$bool = $commande->execute();
		$nb =   $commande->rowCount();
		if (($bool)&&($nb>0)) {
			$profil = $commande->fetch(PDO::FETCH_ASSOC); //tableau d'enregistrements
			return true;
		} else {
			return false;
		}
	}
	catch (PDOException $e) {
		echo utf8_encode("Echec de select : " . $e->getMessage() . "\n");
		die(); // On arrête tout.
	}
}

//fonction vérifiant si l'utilisateur est un loueur ou une entreprise
function verif_id() {

}

?>