<?php

// Ce fichier permet de se connecter à la base de donnée

$hostname = "localhost"; // vs-wamp
$base = "bdd";
$loginBD = "root";
$passBD = "";

try{
    $pdo = new PDO ("mysql:server=$hostname; dbname=$base;charset=utf8", "$loginBD", "$passBD");
}

catch (PDOException $e) {
    die ("Echec de connexion :" . $e->getMessage() . "\n");
}

?>