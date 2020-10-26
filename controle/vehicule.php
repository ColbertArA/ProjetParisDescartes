<?php

//fonction permettant de publier une voiture 
function publierAnnonce() {

    $voiture = isset($_POST['voiture'])?($_POST['voiture']):'';
    $moteur = isset($_POST['moteur'])?($_POST['moteur']):'';
    $vitesse = isset($_POST['vitesse'])?($_POST['vitesse']):'';
    $nbPlace = isset($_POST['nbPlace'])?($_POST['nbPlace']):'';
    $msg="";

    if (count($_POST) == 0){
        require ('./vue/tpl/annonce.tpl');
    } else {
        require ('./modele/vehiculeBD.php');
        if (!preg_match('/^[0-9]*$/', $nbPlace)){
            $msg='Format de nombres de places non respecté !';
            require ('./vue/tpl/annonce.tpl');
        } else {
            $v = array("moteur"=>$moteur, "vitesse"=>$vitesse, "nbPlace"=>$nbPlace);
            $json=json_encode($v);
            insert_vehicule($voiture, $json);
            $msg='Annonce publiée avec succès !';
            require ('./vue/tpl/annonce.tpl');
        }
    }
}

function louerVehicule(){

    $msg="";
     
}

?>