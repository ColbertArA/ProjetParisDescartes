	<!doctype html>
	<html lang="fr">
	<head>
		<meta charset="utf-8">
		<title>accueil du site eContact</title>
		<link rel="stylesheet" href="./css/style.css">
			<!-- 	<script src="script.js"></script>	-->
	</head>
	<body>

	<h2>Bienvenue M. <?php echo ($nom) ?> </h2>
		votre email est : <?php echo ($email) ?>
	<br/>

<?php
/*		
	echo ('<div id="menu" style="float:left">');
	require ('menu.tpl');
	echo ('</div>');
	

	echo ('<div id="main">');
	echo ('<h2>Bienvenue M. ' . $nom . '</h2>');
	
	if (count($Contact)==0) 
			echo ('pas de contact');
	
	else {
		echo ('<h2>Voici vos contacts :</h2>');

		echo ('<table>');
		//boucle à faire sur $Contact pour faire une table HTML des contacts
		
				echo('<tr>');  //ligne d'entête prise sur le contact $Contact[0] 
				foreach($Contact[0] as $c => $v) {
					echo ('<th>' . $c  . '</th>');
				}
				echo('</tr>');
				
				foreach($Contact as $c => $v) { 
					//$v est un des contacts, soit une map indexé 
					//sur les noms des champs du contacts
					echo('<tr>');
					foreach($v as $cle => $val) {
						echo ('<td>' . $val  . '</td>');
					}
					echo('</tr>');
				}		
		
		echo ('</table>');
	} 
	echo ('</div> <!-- fin main -->'); 

*/	
    ?>


	</body></html>
