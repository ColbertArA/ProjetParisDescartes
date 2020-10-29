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

        require('./modele/connect.php');

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
                    <p>Voiture(s) en stock :</p>

                    <?php

                    $sql = $pdo->prepare('SELECT *
                    FROM vehicule
                    WHERE id_client = :id');
                    $sql->execute(array('id' => $_SESSION['id_client']));

                    while ($vehicule = $sql->fetch()) {

                    ?>

                        <p>- <?php echo $vehicule['type_vehicule']; ?>

                            <?php

                            if ($vehicule['location_vehicule'] == 'disponible') {

                            ?>

                                disponible</p> 
                                <form action="index.php?controle=vehicule&action=modifierVehicule&idU=<?php echo $vehicule['id_vehicule'] ?>" method="post">
                                    <p>
                                        <input type="submit" value="Modifier" class="button" />
                                    </p>
                                </form>

                    <?php

                            } elseif ($vehicule['location_vehicule'] == 'en_revision') {

                    ?>

                        en révision</p>
                        <form action="index.php?controle=vehicule&action=modifierVehicule&idU=<?php echo $vehicule['id_vehicule'] ?>" method="post">
                            <p>
                                <input type="submit" value="Modifier" class="button" />
                            </p>
                        </form>

                    <?php

                            } else {

                            $req = $pdo->prepare('SELECT * FROM entreprise WHERE id_entreprise = :id');
                            $req->execute(array('id' => $vehicule['location_vehicule']));
                            $entreprise = $req->fetch();

                    ?>

                        loué par <?php echo $entreprise['nom_entreprise']; ?></p>

                <?php

                            }

                        }

                    $sql->closeCursor();
                ?>

                <p>

                </fieldset>

            <?php

            } elseif ($_SESSION['id'] == 'entreprise') {

            ?>

                <fieldset>
                    <legend>Vos services :</legend>
                    <p>Vos véhicules loué(s) :</p><br>

                    <?php

                    $req = $pdo->prepare('SELECT vehicule.type_vehicule, vehicule.prix_vehicule, facturation.dateD_facturation, facturation.dateF_facturation, facturation.valeur_facturation, facturation.etat_facturation
            FROM vehicule, facturation 
            WHERE facturation.id_entreprise = :id AND vehicule.id_vehicule = facturation.id_vehicule');

                    $req->execute(array('id' => $_SESSION['id_entreprise']));

                    while ($facturation = $req->fetch()) {

                    ?>

                        <p> Type de véhicule : <?php echo $facturation['type_vehicule']; ?></p>

                        <?php

                        if ($facturation['etat_facturation'] == 'réglement fait') {

                        ?>

                            <p>- Prix payé (le véhicule est entièrement réglé) : <?php echo $facturation['valeur_facturation']; ?> €</p>
                            <p>- Date de début de la location : <?php echo $facturation['dateD_facturation']; ?> </p>
                            <p>- Date de fin de la location : <?php echo $facturation['dateF_facturation']; ?> </p><br><br>

                        <?php

                        } elseif ($facturation['etat_facturation'] == 'réglement_non_termine(mensualités)') {

                        ?>

                            <p>- Date de début de la location : <?php echo $facturation['dateD_facturation']; ?> </p>
                            <p>- Prix payé en mensualité pour le mois courant : <?php echo $facturation['valeur_facturation']; ?> €</p>
                            <p>A payé pour le mois suivant :

                                <?php

                                $date = $facturation['dateD_facturation'];
                                list($annee, $mois, $jour) = explode('-', $date);
                                $mois = $mois + 1;

                                if ($mois >= 13) {
                                    $mois = 1;
                                }

                                if ($mois == 1 || $mois == 3 || $mois == 5 || $mois == 7 || $mois == 8 || $mois == 10 || $mois == 12) {

                                    echo $facturation['prix_vehicule'] * 31;
                                ?>

                                    €</p><br><br>

                        <?php

                                } elseif ($mois == 4 || $mois == 6 || $mois == 9 || $mois == 11) {

                                    echo $facturation['prix_vehicule'] * 30;

                        ?>

                            €</p><br><br>

                            <?php
                                } elseif ($mois == 2) {

                                    require('./controle/temps.php');
                                    if (estBissextile($annee) == 1) {

                                        echo $facturation['prix_vehicule'] * 29;

                            ?>

                                €</p><br><br>


                            <?php

                                    } elseif (estBissextile($annee) == 0) {

                                        echo $facturation['prix_vehicule'] * 28;

                            ?>

                                €</p><br><br>

                <?php
                                    }
                                }
                            }
                        }
                    $req->closeCursor();

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