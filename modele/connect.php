<?php

$hostname = "localhost"; // vs-wamp
$base = "bd";
$loginBD = "root";
$passBD = "";

try{
    $pdo = new PDO ("mysql:server=$hostname; dbname=$base", "$loginBD", "$passBD");
}

catch (PDOException $e) {
    die ("Echec de connexion :" . $e->getMessage() . "\n");
}

?>