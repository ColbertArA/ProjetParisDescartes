<?php

//fonction permettant de publier une voiture 
function publierAnnonce()
{

    $voiture = isset($_POST['voiture']) ? ($_POST['voiture']) : '';
    $moteur = isset($_POST['moteur']) ? ($_POST['moteur']) : '';
    $vitesse = isset($_POST['vitesse']) ? ($_POST['vitesse']) : '';
    $couleur = isset($_POST['couleur']) ? ($_POST['couleur']) : '';
    $marque = isset($_POST['marque']) ? ($_POST['marque']) : '';
    $nbPlace = isset($_POST['nbPlace']) ? ($_POST['nbPlace']) : '';
    $prix = isset($_POST['prix']) ? ($_POST['prix']) : '';
    $msg = "";

    if (count($_POST) == 0) {
        require ('./vue/tpl/annonce.tpl');
    } else {
        require ('./modele/vehiculeBD.php');
        if (!preg_match('/^[0-8]*$/', $nbPlace)) {
            $msg = 'Format de nombres de places non respecté ou dépassé !';
            require ('./vue/tpl/annonce.tpl');
        } elseif (!preg_match('/^[0-9]*$/', $prix)) {
            $msg = 'Format de prix non respecté !';
            require ('./vue/tpl/annonce.tpl');
        } else {
            $v = array("marque" => $marque, "couleur" => $couleur, "moteur" => $moteur, "vitesse" => $vitesse, "nbPlace" => $nbPlace);
            $json = json_encode($v);
            insert_vehicule($voiture, $json, $marque, $couleur, $prix);
            $msg = 'Annonce publiée avec succès !';
            require ('./vue/tpl/annonce.tpl');
        }
    }
}

// permet d'afficher un page du véhicule choisit par une entreprise
function voirVehicule()
{

    require ('./modele/vehiculeBD.php');
    require ('./modele/facturationBD.php');
    $dateD = isset($_POST['dateD']) ? ($_POST['dateD']) : '';
    $dateF = isset($_POST['dateF']) ? ($_POST['dateF']) : '';
    $idU = $_GET['idU'];
    $donnees = reqLocation($idU);
    $msg = "";

    if (count($_POST) == 0) {
        require ('./vue/tpl/vehicule.tpl');
    } else {
        require ('./controle/temps.php');
        $prix = $donnees['prix_vehicule'];
        $duree = jourTotal($dateD, $dateF);
        if ($duree < 0 && $dateF != null) {
            $msg = "Location impossible car les dates ne correspondent pas !";
            require ('./vue/tpl/vehicule.tpl');
        } elseif ($dateF == 0) {
            $mensualite = $prix * mensualite($prix, $dateD);
            $dateNull = null;
            $paiement = "réglement_non_termine(mensualités)";
            nvleFacture($idU, $dateD, $dateNull, $mensualite, $paiement);
            require ('./vue/ident.tpl');
        } else {
            $total = $prix * $duree;
            $paiement = "réglement fait";
            nvleFacture($idU, $dateD, $dateF, $total, $paiement);
            require ('./vue/ident.tpl');
        }
    }
}

//fonction permettant de supprimer un véhicule lorsqu'un loueur le souhaite
function supprimerVehicule()
{
    require('./modele/vehiculeBD.php');
    $idU = $_GET['idU'];
    $msg = "";
    supprimer_vehicule($idU);
    require ('./vue/tpl/profil.tpl');
}

//fonction permettant aux loueur de mettre leur véhicules en révision
function modifierVehicule() {

    $idU = $_GET['idU'];

    if (isset($_POST['revision'])){
        require ('./modele/vehiculeBD.php');
        modifier_vehicule($idU);
        require ('./vue/tpl/profil.tpl');
    } else {
        require('./vue/tpl/modifVehicule.tpl');
    }
}

//fonction permettant aux loueur de mettre leur véhicule disponible
function vehiculeDisponible() {

    $idU = $_GET['idU'];

    require ('./modele/vehiculeBD.php');
    vehicule_disponible($idU);
    require ('./vue/tpl/profil.tpl');
}

?>