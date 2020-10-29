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

        require ('./modele/connect.php');
        $idU = $_GET['idU'];

        $sql = $pdo->prepare('SELECT * FROM vehicule WHERE id_vehicule = :id_vehicule');
        $sql->execute(array('id_vehicule' => $idU));

        while ($donneesVehicule = $sql->fetch()) {
            $v = $donneesVehicule['caract_vehicule'];
            $json = json_decode($v);

        ?>

            <img src="./vue/photos_voitures/<?php echo $donneesVehicule['photo_vehicule']; ?>.jpg">
            <p class="vehicule">
                Type véhicule : <?php echo $donneesVehicule['type_vehicule']; ?></br>
            </p>
            <fieldset>
                <legend>Caractéristiques du véhicule</legend>
                <p class="vehicule">Moteur : <?php echo $json->{"moteur"}; ?></p>
                <p class="vehicule">Boîte de vitesse : <?php echo $json->{"vitesse"}; ?></p>
                <p class="vehicule">Nombres de places : <?php echo $json->{"nbPlace"}; ?></p>
            </fieldset>
            <p class="vehicule">
                Prix : <?php echo $donneesVehicule['prix_vehicule']; ?> €/Jour
            </p>

        <?php

        if ($donneesVehicule['location_vehicule'] == 'disponible'){

        ?>
            <form action="index.php?controle=vehicule&action=modifierVehicule&idU=<?php echo $idU ?>" method="post">
                <p>
                    <input name="revision" type="submit" value="Mettre en révision" class="button" />
                </p>
            </form>

        <?php

        } elseif ($donneesVehicule['location_vehicule'] == 'en_revision') {

        ?>

            <form action="index.php?controle=vehicule&action=vehiculeDisponible&idU=<?php echo $idU ?>" method="post">
                <p>
                    <input name="disponible" type="submit" value="Rendre disponible" class="button" />
                </p>
            </form>

        <?php

        }

        ?>

            <form action="index.php?controle=vehicule&action=supprimerVehicule&idU=<?php echo $idU ?>" method="post">
                <p>
                    <input type="submit" value="Supprimer" class="button" />
                </p>
            </form>

        <?php

        }

        ?>

    </div>

    <!-- Fin page -->
</body>

</html>