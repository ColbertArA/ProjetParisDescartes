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

///////////////////////////////////////////
//Voici 2 lignes pour tester la connexion seule, en invoquant ce fichier.
//   Eliminer ces 2 lignes si le test est réussi !
//		$ok = 'connexion ok';
//		die ($ok); 

?>