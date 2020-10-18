<?php

$hostname = "localhost"; //ou vs-wamp
$base = "bd";
$loginBD = "root";
$passBD = "";

try{

    $bd = new PDO ("myslq:server=$hostname; dbname=$base", "$loginBD", "$passBD");
}

catch (PDOException $e) {
    die ("Echech de connexion : " . $e->getMessage() . "\n");
}

?>