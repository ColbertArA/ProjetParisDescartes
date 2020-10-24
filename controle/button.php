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
    require ("./vue/ident.tpl");
}

//lien vers la page connexion_err en cas de mauvais mot de passe ou mail
function err_connexion() {
    require ('./vue/tpl_err/connexion_err.tpl');
}
?>