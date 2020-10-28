<!doctype html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <title>GoGoVoiture | Louer votre voiture sur notre site</title>

    <!-- Fichiers CSS -->

    <link rel="stylesheet" href="./vue/css/header.css">
    <link rel="stylesheet" href="./vue/css/inscription.css">
</head>

<body>

    <!-- Début header -->

    <header class="header">
        <ul>
            <li class="left-item"><a href="index.php?controle=button&action=gogo">GoGoVoiture</a></li>

            <?php

            if (isset($_SESSION['profil'])) {

            ?>

            <li><a href="index.php?controle=utilisateur&action=profil">Profil</a></li>
            <li><a href="index.php?controle=utilisateur&action=deconnexion">Se déconnecter</a></li>

            <?php

            } else {

            ?>

            <li><a href="index.php?controle=utilisateur&action=insert">S'inscrire</a></li>
            <li><a href="index.php?controle=utilisateur&action=ident">Se connecter</a></li>

            <?php

            }

            ?>

        </ul>
    </header>

    <!-- Fin header -->

    <!-- Début page -->
    <div class="formulaire" id="page">

    <?php

    $v = $donnees['caract_vehicule'];
    $json = json_decode($v);

    ?>


        <img src="./vue/photos_voitures/<?php echo $donnees['photo_vehicule']; ?>.jpg">
        <p class="vehicule">
            Type véhicule : <?php echo $donnees['type_vehicule']; ?></br>
        </p>
        <fieldset>
            <legend>Caractéristiques du véhicule</legend>
            <p class="vehicule">Moteur : <?php echo $json->{"moteur"}; ?></p>
            <p class="vehicule">Boîte de vitesse : <?php echo $json->{"vitesse"}; ?></p>
            <p class="vehicule">Nombres de places : <?php echo $json->{"nbPlace"}; ?></p>
        </fieldset>
        <p class="vehicule">
            Prix : <?php echo $donnees['prix_vehicule']; ?> €/Jour
        </p>

        <?php 
        
        $idU = $donnees['id_vehicule'];

        if ($donnees['location_vehicule'] == 'disponible') {
        
        ?>

        <form action="index.php?controle=vehicule&action=voirVehicule&idU=<?php echo $idU ?>" method="post">
            <p class="vehicule">   
                <label for="dateD">Date du début de la location</label> :
                <input name="dateD" type="date" id="date" required>

                <label for="dateF">Date de fin de la location</label> :
                <input name="dateF" type="date">
                <br>
                <br>
                <input name="louer" type="submit" value="Louer le véhicule" class="button"/>
            </p>
        </form>

        <?php

            echo $msg; 

        } elseif ($donnees['location_vehicule'] == 'en_cours'){
        
        }

        ?>

    </div>


    <!-- Fin page -->
</body>

</html>