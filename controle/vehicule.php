<?php

function publierAnnonce() {

    $voiture = isset($_POST['voiture'])?($_POST['voiture']):'';
    $moteur = isset($_POST['moteur'])?($_POST['moteur']):'';
    $vitesse = isset($_POST['vitesse'])?($_POST['vitesse']):'';
    $nbPlace = isset($_POST['nbPlace'])?($_POST['nbPlace']):'';
    $msg="";

    require ('./modele/connect.php');

    if (count($_POST) == 0){
        require ('./vue/tpl/annonce.tpl');
    } else {
        
    }
}

?>