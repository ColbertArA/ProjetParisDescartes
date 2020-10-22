<?php

//fichier php permettant acceder les templates à partir des bouttons

//lien pour les bouttons inscriptions
function inscription() {
    require ("./vue/tpl/inscription.tpl");
    
}

//lien pour les bouttons connexions
function connexion() {
    require ("./vue/tpl/connexion.tpl");
}

//lien pour les bouttons acceuils
function gogo() {
    require ("./vue/Ident.tpl");
}

?>