<?php

function verif_ident($mail, $mdp, &$profil){
    require('connect.php');

    $sql="SELECT * FROM 'client' where mail_client=:mail and mdp_client=:mdp";
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


?>