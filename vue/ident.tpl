<!doctype html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <title>GoGoVoiture | Louer votre voiture sur notre site</title>

    <!-- Fichiers CSS -->

    <link rel="stylesheet" href="./vue/css/header.css">
    <link rel="stylesheet" href="./vue/css/style.css">
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

    <div class="cover">
        <h1><a href="index.php?controle=button&action=gogo">GoGoVoiture</a></h1>
        <p class="bienvenue">
            Bienvenue sur GoGoVoiture, le site pour louer votre véhicule !<br>
            Vous êtes une entreprise et vous avez besoin de louer un véhicule rapidement et facilement ?<br>
            Vous êtes un particulier ? Vous avez un véhicule et vous souhaitez le faire louer ?<br>
            GoGoVoiture est le site fait pour vous !
        </p>

        <?php

        if (isset($_SESSION['profil']) and $_SESSION['id'] == 'entreprise') {
        } elseif (isset($_SESSION['profil']) and $_SESSION['id'] == 'loueur') {

        ?>

            <button class="buttonC"><span><a href="index.php?controle=vehicule&action=publierAnnonce">Faire louer votre véhicule !</a></span></button>

        <?php

        } else {

        ?>

            <button class="buttonC"><span><a href="index.php?controle=utilisateur&action=insert">S'incrire</a></span></button>

        <?php

        }

        ?>
    </div>

    <div class="center-item">

        <h2>Louer un véhicule ou faites louer votre véhicule !</h2>

        <?php

        if (isset($_SESSION['profil'])) {

        ?>

        <?php

        } else {

        ?>

            <p class="client">Déjà client ? N'oublier pas de vous connecter !</p>
            <button class="button"><span><a href="index.php?controle=utilisateur&action=ident">Connectez-vous !</a></span></button>

        <?php

        }

        ?>
    </div>

    <div class="container">
        <div class="down-item">
            <div class="annonces" id="page">

                <!-- Permet d'afficher toutes les vehicules présent dans la base de donnees -->
                <?php

                require ('./modele/connect.php');

                //On recupere tout le contenu de la table vehicule
                $sql = $pdo->query('SELECT * FROM vehicule');

                while ($donnees = $sql->fetch()) {
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

                    if (isset($_SESSION['profil']) and $_SESSION['id'] == 'entreprise') {
                        if ($donnees['location_vehicule'] == 'disponible') {
                            $idU = $donnees['id_vehicule'];
                    ?>

                            <br>

                            <button class="button"><span><a href="index.php?controle=vehicule&action=voirVehicule&idU=<?php echo $idU ?>">Louer le véhicule !</a></span></button>

                        <?php

                        } elseif ($donnees['location_vehicule'] == 'en_revision') {

                        ?>

                            <h2>Véhicule en révision</h2>

                        <?php

                        } elseif ($donnees['location_vehicule'] == $_SESSION['id_entreprise']) {

                            $req = $pdo->query('SELECT * FROM facturation');
                            $facturation = $req->fetch();

                        ?>

                            <h2>Véhicule en cours de location</h2>
                            <p>Location du <?php echo $facturation['dateD_facturation']; ?> au <?php echo $facturation['dateF_facturation']; ?> </p>

                    <?php

                        }

                        
                    }

                    ?>

            </div>
            <div class="annonces" id="page">
            <?php

                }
                $sql->closeCursor();

            ?>
            </div>
        </div>


    </div>

    <!-- Fin page -->

</body>

</html>