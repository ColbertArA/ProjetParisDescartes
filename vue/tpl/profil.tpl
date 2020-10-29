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

        if (isset($_SESSION['profil'])) {

        ?>

            <h1>Votre profil</h1>
            <p>Votre nom : <?php echo $_SESSION['nom']; ?> </p>
            <p>Vous êtes un/une : <?php echo $_SESSION['id']; ?> </p>
            <p>Votre mail : <?php echo $_SESSION['mail']; ?></p>

            <?php

            if ($_SESSION['id'] == 'loueur') {

            ?>

                <fieldset>
                    <legend>Vos services :</legend>
                    <form action="index.php?controle=vehicule&action=publierAnnonce" method="post">
                        <p>
                            <input type="submit" value="Faites louer votre véhicule !" class="button" />
                        </p>
                    </form>

                </fieldset>

            <?php

            } elseif ($_SESSION['id'] == 'entreprise') {

            ?>

                <fieldset>
                    <legend>Vos services :</legend>
                    <p>Vos véhicules loué(s) :</p>

                    <?php

                    require('./modele/connect.php');

                    $req = $pdo->prepare('SELECT vehicule.type_vehicule, facturation.valeur_facturation, facturation.etat_facturation
            FROM vehicule, facturation 
            WHERE facturation.id_entreprise = :id AND vehicule.id_vehicule = facturation.id_vehicule');

                    $req->execute(array('id' => $_SESSION['id_entreprise']));

                    while ($facturation = $req->fetch()) {

                    ?>

                        <p>- Type de véhicule : <?php echo $facturation['type_vehicule']; ?></p>

                        <?php

                        if ($facturation['etat_facturation'] == 'réglement fait') {

                        ?>

                            <p>- Prix payé (le véhicule est entièrement réglé) : <?php echo $facturation['valeur_facturation']; ?></p>

                        <?php

                        } elseif ($facturation['etat_facturation'] == 'réglement_non_termine(mensualités)') {

                        ?>

                            <p>- Prix payé en mensualité : <?php echo $facturation['valeur_facturation']; ?></p>

                    <?php

                        }
                    }

                    ?>

                    <br>
                    <p>Affichage des véhicules libre à la location :</p><br>

                    <form action="index.php?controle=button&action=gogo" method="post">
                        <p>
                            <input type="submit" value="Voir" class="button" />
                        </p>
                    </form>
                </fieldset>

            <?php

            }

            ?>

            <form action="index.php?controle=utilisateur&action=deconnexion" method="post">
                <p>
                    <input type="submit" value="Se déconnecter" class="button" />
                </p>
            </form>

        <?php

        }

        ?>

    </div>


    <!-- Fin page -->
</body>

</html>