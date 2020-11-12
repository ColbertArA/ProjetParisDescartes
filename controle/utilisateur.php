<?php
//fichier permettant la gestion des utilisateurs

//fonction permettant l'inscription d'un client ou d'une entreprise dans la base de données
function insert() 
{

    require ('./modele/utilisateurBD.php');

    $nom = isset($_POST['nom'])?($_POST['nom']):'';
    $mdp = isset($_POST['mdp'])?($_POST['mdp']):'';
    $mdp2 = isset($_POST['mdp2'])?($_POST['mdp2']):'';
    $mail = isset($_POST['mail'])?($_POST['mail']):'';
    $c = sha1($mdp);
    $msg ='';

    if (count($_POST) == 0){
        require ('./vue/tpl/inscription.tpl');
    } else {
        if (verif_dbl($mail) == false) {
            $msg="Le mail est déjà utilisé !";
            require ('./vue/tpl/inscription.tpl');
        } elseif($mdp != $mdp2) {
            $msg="Les mots de passe ne concordent pas !";
            require ('./vue/tpl/inscription.tpl');
        } elseif(!preg_match("#^[a-z0-9]+$#", $nom)) {
            $msg = "Le nom doit être renseigné en lettres minuscules sans accents, sans caractères spéciaux !";
            require ('./vue/tpl/inscription.tpl');
        } else {
            //insertion des données dans la base de données
            insert_entreprise($nom, $c, $mail);
            //recupération des données
            $donnees_entreprise = ident_entreprise($mail, $c);
            $choix = 'entreprise';

            $_SESSION['profil'] = $donnees_entreprise;
            $_SESSION['nom'] = $donnees_entreprise['nom_entreprise'];
            $_SESSION['mail'] = $donnees_entreprise['mail_entreprise'];
            $_SESSION['id_entreprise'] = $donnees_entreprise['id_entreprise'];
            $_SESSION['id'] = $choix;
            
            $msg="Inscription réussie !";
            require ('./vue/tpl/accueil.tpl');
        }
    }
}

//fonction permettant à la connexion des utilisateurs
function ident() 
{

    require ('./modele/utilisateurBD.php');

    $mail = isset($_POST['mail'])?($_POST['mail']):'';
    $mdp = isset($_POST['mdp'])?($_POST['mdp']):'';
    $c = sha1($mdp);
    $donnees_entreprise = ident_entreprise($mail, $c);
    $donnees_client = ident_client($mail, $c);
    $msg = "";

    if (count($_POST) == 0) {
        require ('./vue/tpl/connexion.tpl');
    } else {
        
        //verifie s'il un loueur ou une entreprise avec les identifiants entrés
        if ($donnees_client == 0 && $donnees_entreprise == 0) {
            $msg='Mauvais mot de passe ou mail !';
            require ('./vue/tpl/connexion.tpl');
        //verifie s'il existe un client
        } elseif (ident_client($mail, $c) != 0) {
            $choix = "loueur";

            $_SESSION['profil'] = $donnees_client;
            $_SESSION['nom'] = $donnees_client['nom_client'];
            $_SESSION['mail'] = $donnees_client['mail_client'];
            $_SESSION['id_client'] = $donnees_client['id_client'];
            $_SESSION['id'] = $choix;
            $msg='Vous êtes connecté !';
            require ('./vue/tpl/accueil.tpl');
        //verifie s'il existe une entreprise
        } elseif ($donnees_entreprise != 0) {
            $choix = "entreprise";

            $_SESSION['profil'] = $donnees_entreprise;
            $_SESSION['nom'] = $donnees_entreprise['nom_entreprise'];
            $_SESSION['mail'] = $donnees_entreprise['mail_entreprise'];
            $_SESSION['id_entreprise'] = $donnees_entreprise['id_entreprise'];
            $_SESSION['id'] = $choix;
            $msg='Vous êtes connecté !';
            require ('./vue/tpl/accueil.tpl');
        }
    }
}

//affichele profil d'un utilisateur
function profil()
{
    if (count($_POST) == 0){
        require ('./vue/tpl/profil.tpl');
    }
}

//fonction permettant à un l'utilisateur de se déconnecter
function deconnexion()
{
    $msg="";
    $_SESSION = array();
    session_destroy();
    $msg = 'Vous êtes déconnecté !';
    require ('./vue/tpl/deconnexion.tpl');
}

?>