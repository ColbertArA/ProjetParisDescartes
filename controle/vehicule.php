<?php

function publierAnnonce() {

    $voiture = isset($_POST['voiture'])?($_POST['voiture']):'';

    if (count($_POST) == 0){
        require ('./vue/tpl/annonce.tpl');
    }
}

?>