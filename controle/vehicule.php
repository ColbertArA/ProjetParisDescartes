<?php

//fonction permettant de publier une voiture 
function publierAnnonce() {

    $voiture = isset($_POST['voiture'])?($_POST['voiture']):'';
    $moteur = isset($_POST['moteur'])?($_POST['moteur']):'';
    $vitesse = isset($_POST['vitesse'])?($_POST['vitesse']):'';
    $nbPlace = isset($_POST['nbPlace'])?($_POST['nbPlace']):'';
    $prix = isset($_POST['prix'])?($_POST['prix']):'';
    $msg="";

    if (count($_POST) == 0){
        require ('./vue/tpl/annonce.tpl');
    } else {
        require ('./modele/vehiculeBD.php');
        if (!preg_match('/^[0-8]*$/', $nbPlace)){
            $msg='Format de nombres de places non respecté ou dépassé !';
            require ('./vue/tpl/annonce.tpl');
        } elseif (!preg_match('/^[0-9]*$/', $prix)) {
            $msg='Format de prix non respecté !';
            require ('./vue/tpl/annonce.tpl');
        } else {
            $v = array("moteur"=>$moteur, "vitesse"=>$vitesse, "nbPlace"=>$nbPlace);
            $json=json_encode($v);
            insert_vehicule($voiture, $json, $prix);
            $msg='Annonce publiée avec succès !';
            require ('./vue/tpl/annonce.tpl');
        }
    }
}

// permet d'afficher un page du véhicule choisit par une entreprise
function voirVehicule(){

    require ('./modele/vehiculeBD.php');
    $dateD = isset($_POST['dateD'])?($_POST['dateD']):'';
    $dateF = isset($_POST['dateF'])?($_POST['dateF']):'';
    $paiement = isset($_POST['paiement'])?($_POST['paiement']):'';
    $idU = $_GET['idU'];
    $donnees = reqLocation($idU);
    $msg="";
    
    if (count($_POST) == 0){
        require ('./vue/tpl/vehicule.tpl');
    } else {
        require ('./controle/temps.php');
        $prix = $donnees['prix_vehicule'];
        $duree = jourTotal($dateD, $dateF);
        $total = $prix * $duree;
        louer_vehicule($idU, $dateD, $dateF, $total, $paiement);
        $msg="Véhicule loué pour ". $total ."€";
        require ('./vue/tpl/vehicule.tpl');
    }
}


?>