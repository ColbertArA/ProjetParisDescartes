<?php

//Fonction permettant l'inscription d'un client ou d'une entreprise dans la base de données
function insert () {

    $choix = isset($_POST['choix'])?($_POST['choix']):'';
    $nom = isset($_POST['nom'])?($_POST['nom']):'';
    $mdp = isset($_POST['mdp'])?($_POST['mdp']):'';
    $mdp2 = isset($_POST['mdp2'])?($_POST['mdp2']):'';
    $mail = isset($_POST['mail'])?($_POST['mail']):'';
    $c = sha1($mdp);
    $msg ='';

    require ("./modele/connect.php");

    if (count($_POST) == 0){
        require ('./vue/tpl/inscription.tpl');
    } else {
        require ('./modele/utilisateurBD.php');
        if (verif_dbl($mail, $choix) == false) {
            $msg="Le mail est déjà utilisé !";
            require ('./vue/tpl/inscription.tpl');
        } elseif($mdp != $mdp2) {
            $msg="Les mots de passe ne concordent pas !";
            require ('./vue/tpl/inscription.tpl');
        } else {
            if ($choix = "loueur") {
                // Pour inserer les données 
                $req = $pdo->prepare('INSERT INTO client (nom_client, mdp_client, mail_client) VALUES(?,?,?)');
            } else {
                // Pour inserer les données
                $req = $pdo->prepare('INSERT INTO entreprise (nom_entreprise, mdp_entreprise, mail_entreprise) VALUES(?,?,?)');
            }

            $req->execute(array($nom, $c, $mail));
            $msg="Inscription réussie !";
            require ('./vue/tpl/inscription.tpl');
        }
    }
}

//fonction permettant à la connexion des utilisateurs
function ident() {

    $mail = isset($_POST['mail'])?($_POST['mail']):'';
    $mdp = isset($_POST['mdp'])?($_POST['mdp']):'';
    $c = sha1($mdp);
    $msg = "";

    require ('./modele/connect.php');

    $sql = $pdo->prepare('SELECT * FROM client WHERE mdp_client = :mdp and mail_client = :mail');
    $sql->execute(array('mdp' => $c, 'mail' => $mail));
    $donnees = $sql->fetch(PDO::FETCH_ASSOC);

    if (count($_POST) == 0) {
        require ('./vue/tpl/connexion.tpl');
    } else {
        if ($donnees == 0) {
            $msg='Mauvais mot de passe ou mail !';
            require ('./vue/tpl/connexion.tpl');
        } else {
            $_SESSION['nom'] = $donnees['nom_client'];
        }
    }


    
    

    // if (count($_POST)==0){
    //     require ("./vue/ident.tpl");
    // } else {
    //     require ("./modele/utilisateurBD.php");
    //     if (!verif_ident($mail, $mdp, $profil)) {
    //         $msg = "Utilisateur inconnu !" ;
    //         require ("./vue/tpl/connexion.tpl");
    //     } else {
    //         //$_SESSION['profil'] = $profil;
    //         //$idU = $_SESSION['profil']['id_client'];
	// 		$url= "index.php?controle=utilisateur&action=accueil";
	// 		header("Location:" . $url) ;
    //     }
    // }
}

// function accueil() {
//     $mail = isset($_POST['mail'])?($_POST['mail']):'';
//     $mdp = isset($_POST['mdp'])?($_POST['mdp']):'';
//     $c = sha1($mdp);
//     $msg = "";

//     require ('./modele/connect.php');

//     $sql = $pdo->prepare('SELECT * FROM client WHERE mdp_client = :mdp and mail_client = :mail');
//     $sql->execute(array('mdp' => $c, 'mail' => $mail));
//     $donnees = $sql->fetch(PDO::FETCH_ASSOC);

// 	if (isset($_SESSION['profil'])) {
// 		//$profil = $_SESSION['profil'];
// 		$_SESSION['nom'] = $donnees['nom_client'];
// 		$_SESSION['mail'] = $donnees['mail_client'];
		
		
// 		require ('./vue/tpl/accueil.tpl');
// 	}
// //	require ("./modele/m1.php");		
// //	require ("./vue/c1/a12.tpl"); //template de vue du service
// }

?>