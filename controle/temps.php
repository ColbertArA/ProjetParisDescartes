<?php

//fonction qui en jour la durée totale qu'une entreprise à louer un véhicule
function jourTotal($dateD, $dateF){
    $secParJour = 86400;

    $duree = abs(strtotime($dateD) - strtotime($dateF)); 
    $dureeTotale = $duree / $secParJour;

    return $dureeTotale;
}

?>