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

        if (isset($_SESSION['nom']) AND $_SESSION['id'] == 'loueur') {
        
        ?>

        <h1>Renseigner les informations de votre véhicule M./Mme. <?php echo $_SESSION['nom']; ?> </h1>
        
        <form action="index.php?controle=vehicule&action=publierAnnonce" method="post">
            <fieldset class="cadre">
                <div class="info">
                    <legend>Informations du véhicule :</legend>
                    <p>
                        <label for="voiture">Type de la voiture</label> :
                        <input type="text" name="voiture" required placeholder="206">
                    </p>
                    <p>Marque de la voiture :<br><br>
                        <select name="marque">
                            <option value="Audi">Audi</option>
                            <option value="Citroën">Citroën</option>
                            <option value="Ferrari">Ferrari</option>
                            <option value="Ford">Ford</option>
                            <option value="Mercedes">Mercedes</option>
                            <option value="Peugeot">Peugeot</option>
                            <option value="Renault">Renault</option>
                            <option value="Seat">Seat</option>
                            <option value="Tesla">Tesla</option>
                            <option value="Volkswagen">Volkswagen</option>
                        </select>
                    </p>
                    <p>Couleur de la voiture :<br><br>
                        <select name="couleur">
                            <option value="Rouge">Rouge</option>
                            <option value="Jaune">Jaune</option>
                            <option value="Bleu">Bleu</option>
                            <option value="Vert">Vert</option>
                            <option value="Orange">Orange</option>
                            <option value="Violet">Violet</option>
                            <option value="Noir">Noir</option>
                            <option value="Gris">Gris</option>
                            <option value="Blanc">Blanc</option>
                        </select>
                    </p>
                    <p>Type de moteur :<br><br>
                        <select name="moteur">
                            <option value="Essence">Essence</option>
                            <option value="Diesel">Diesel</option>
                            <option value="Hybride">Hybride</option>
                            <option value="Electrique">Electrique</option>
                        </select>
                    </p>
                    <p>Type de vitesse :<br><br>
                        <select name="vitesse">
                            <option value="Manuelle">Manuelle</option>
                            <option value="Automatique">Automatique</option>
                        </select>
                    </p>
                    <p>
                        <label for="nbPlace">Nombres de places</label> :
                        <input type="text" name="nbPlace" required placeholder="8 places max">
                    </p>
                    <p>
                        <label for="prix">Prix (en €/jour)</label> :
                        <input type="text" name="prix" required>
                    </p>
                </div>
            </fieldset>
            <p>
                <input name="publier" type="submit" value="Publier l'annonce" class="button"/>
            </p>

        </form>

        <?php

        }

        echo $msg;

        ?>

    </div>


    <!-- Fin page -->
</body>

</html>