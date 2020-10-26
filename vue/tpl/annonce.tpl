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

        if (isset($_SESSION['nom']) AND $_SESSION['id'] == 'loueur') {
        
        ?>

        <h1>Renseigner les informations de votre véhicule M. <?php echo $_SESSION['nom']; ?> </h1>
        
        <form action="index.php?controle=vehicule&action=publierAnnonce" method="post">
            <fieldset class="cadre">
                <div class="info">
                    <legend>Informations du véhicule :</legend>
                    <p>
                        <label for="voiture">Type de la voiture</label> :
                        <input type="text" name="voiture" required placeholder="206">
                    </p>
                    <p>Type de moteur :<br><br>
                        <select name="moteur">
                            <option value="essence">Essence</option>
                            <option value="diesel">Diesel</option>
                            <option value="hybride">Hybride</option>
                            <option value="electrique">Electrique</option>
                        </select>
                    </p>
                    <p>Type de vitesse :<br><br>
                        <select name="vitesse">
                            <option value="manuelle">Manuelle</option>
                            <option value="automatique">Automatique</option>
                        </select>
                    </p>
                    <p>
                        <label for="nbPlace">Nombres de places</label> :
                        <input type="text" name="nbPlace" required>
                    </p>
                </div>
            </fieldset>
            <p>
                <input name="publier" type="submit" value="Publier l'annonce" class="button"/>
            </p>
        </form>

        <?php

        }

        ?>

    </div>


    <!-- Fin page -->
</body>

</html>