<?php

//fonction permettant l'inscription d'un client ou d'une entreprise dans la base de données
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
            if ($choix == "loueur") {
                // Pour inserer les données 
                $req = $pdo->prepare('INSERT INTO client (nom_client, mdp_client, mail_client) VALUES(?,?,?)');
                $req->execute(array($nom, $c, $mail));
                $sql = $pdo->prepare('SELECT * FROM client WHERE mdp_client = :mdp and mail_client = :mail');
                $sql->execute(array('mdp' => $c, 'mail' => $mail));
                $donnees = $sql->fetch(PDO::FETCH_ASSOC);
    
                $_SESSION['profil'] = $donnees;
                $_SESSION['nom'] = $donnees['nom_client'];
                $_SESSION['id'] = $choix;
            } else {
                // Pour inserer les données
                $req = $pdo->prepare('INSERT INTO entreprise (nom_entreprise, mdp_entreprise, mail_entreprise) VALUES(?,?,?)');
                $req->execute(array($nom, $c, $mail));
                $sql = $pdo->prepare('SELECT * FROM entreprise WHERE mdp_entreprise = :mdp and mail_entreprise = :mail');
                $sql->execute(array('mdp' => $c, 'mail' => $mail));
                $donnees = $sql->fetch(PDO::FETCH_ASSOC);
    
                $_SESSION['profil'] = $donnees;
                $_SESSION['nom'] = $donnees['nom_entreprise'];
                $_SESSION['id'] = $choix;
            }

            $msg="Inscription réussie !";
            require ('./vue/tpl/accueil.tpl');
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

    //données tirées de la table client
    $sql = $pdo->prepare('SELECT * FROM client WHERE mdp_client = :mdp AND mail_client = :mail');
    $sql->execute(array('mdp' => $c, 'mail' => $mail));
    $donnees_client = $sql->fetch(PDO::FETCH_ASSOC);
    $sql->closeCursor();

    //données tirées de la table entreprise
    $sql = $pdo->prepare('SELECT * FROM entreprise WHERE mdp_entreprise = :mdp AND mail_entreprise = :mail');
    $sql->execute(array('mdp' => $c, 'mail' => $mail));
    $donnees_entreprise = $sql->fetch(PDO::FETCH_ASSOC);
    $sql->closeCursor();

    if (count($_POST) == 0) {
        require ('./vue/tpl/connexion.tpl');
    } else {
        //verifie s'il un loueur ou une entreprise avec les identifiants entrés
        if ($donnees_client == 0 && $donnees_entreprise == 0) {
            $msg='Mauvais mot de passe ou mail !';
            require ('./vue/tpl/connexion.tpl');
        //verifie s'il existe un client
        } elseif ($donnees_client != 0) {
            $choix = "loueur";
            $_SESSION['profil'] = $donnees_client;
            $_SESSION['nom'] = $donnees_client['nom_client'];
            $_SESSION['id'] = $choix;
            $msg='Vous êtes connecté !';
            require ('./vue/tpl/accueil.tpl');
        //verifie s'il existe une entreprise
        } elseif ($donnees_entreprise != 0) {
            $choix = "entreprise";
            $_SESSION['profil'] = $donnees_entreprise;
            $_SESSION['nom'] = $donnees_entreprise['nom_entreprise'];
            $_SESSION['id'] = $choix;
            $msg='Vous êtes connecté !';
            require ('./vue/tpl/accueil.tpl');
        }
    }
}

//fonction permettant à l'utilisateur de se déconnecter
function deconnexion() {
    $msg="";
    session_destroy();
    $msg = 'Vous êtes déconnecté !';
    require ('./vue/tpl/deconnexion.tpl');
}

?>