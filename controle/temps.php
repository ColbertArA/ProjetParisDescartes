<?php

//ficher php qui gère les opérations sur le temps

//fonction qui en jour la durée totale qu'une entreprise à louer un véhicule
function jourTotal($dateD, $dateF)
{
    $secParJour = 86400;

    $duree = strtotime($dateF) - strtotime($dateD);
    $dureeTotale = $duree / $secParJour;

    return $dureeTotale;
}

//fonction qui renvoie le prix en mensualité
function mensualite($prix, $dateD)
{

    list($annee, $mois, $jour) = explode('-', $dateD);

    if ($mois == 1 || $mois == 3 || $mois == 5 || $mois == 7 || $mois == 8 || $mois == 10 || $mois == 12) {

        $mensualite = 31 - $jour;
    } elseif ($mois == 4 || $mois == 6 || $mois == 9 || $mois == 11) {

        $mensualite = 30 - $jour;
    } elseif ($mois == 2) {
        if (estBissextile($annee) == 1) {

            $mensualite = 29 - $jour;
        } elseif (estBissextile($annee) == 0) {

            $mensualite = 28 - $jour;
        }
    }

    return $mensualite;
}

//fonction qui trouve si une année est bissextile
function estBissextile($annee)
{
    return date("m-d", strtotime("$annee-02-29")) == "02-29";
}

?>