<?php

//Fonction permettant l'inscription d'un client ou d'une entreprise dans la base de données
function insert () {

    $choix = isset($_POST['choix'])?($_POST['choix']):'';
    $msg ='';

    require ("./modele/connect.php");

    if ($choix = "loueur") {

        // Pour inserer les données 
        $req = $pdo->prepare('INSERT INTO client (nom_client, mdp_client, mail_client) VALUES(?,?,?)');
        $req->execute(array($_POST['nom'], sha1($_POST['mdp']), $_POST['mail']));
        $msg = "Inscription réussie !";

    } else {

        $req = $pdo->prepare('INSERT INTO entreprise (nom_entreprise, mdp_entreprise, mail_entreprise) VALUES(?,?,?)');
        $req->execute(array($_POST['nom'], sha1($_POST['mdp']), $_POST['mail']));
        $msg = "Inscription réussie !";

    }

    $url = "index.php?controle=button&action=inscription";
    header("Location:" . $url);
    
}

function ident() {

    $mail = isset($_POST['mail'])?($_POST['mail']):'';
    $mdp = isset($_POST['mdp'])?($_POST['mdp']):'';
    $msg = '';

    require ("./modele/connect.php");

    if(isset($mail) && isset($mdp)) {
        $mail = htmlspecialchars($_POST['mail']);
        $mdp = htmlspecialchars_decode($_POST['mdp']);

        $check = $pdo->prepare('SELECT id_client, mail_client, mdp_client FROM client WHERE mail = ?');
        $check->execute(array($mail));
        $data = $check->fetch();
        $row = $check->rowCount();

        if($row ==1) {
            if(filter_var($mail, FILTER_VALIDATE_MAIL)) {
                $mdp = hash('sha1', $mail);

                if($data['mdp'] === $mdp){
                    $_SESSION['profil'] = $data['id_client'];
                    header('Location:index.php?controle=button&action=inscription');
                } else header('Location:index.php?login_err=mdp');
            } else header('Location:index.php?login_err=mail');
        } else header('Location:index.php?login_err=already');
    } else header('Location:index.php?controle=utilisateur&action=accueil');


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



function accueil() {
	if (isset($_SESSION['profil'])) {
		//$profil = $_SESSION['profil'];
		$mail = $_SESSION['profil']['mail'];
		$mdp = $_SESSION['profil']['mdp'];
		$idU = $_GET['idU'];
		
		require ('./vue/tpl/accueil.tpl');
	}
//	require ("./modele/m1.php");		
//	require ("./vue/c1/a12.tpl"); //template de vue du service
}

?>