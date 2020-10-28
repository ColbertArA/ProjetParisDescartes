<?php

//fonction qui en jour la durée totale qu'une entreprise à louer un véhicule
function jourTotal($dateD, $dateF){
    $secParJour = 86400;

    $duree = strtotime($dateF) - strtotime($dateD); 
    $dureeTotale = $duree / $secParJour;

    return $dureeTotale;
}

//fonction qui renvoie le prix en mensualité
function mensualite($prix){
    return $prix * 31;
}
?>