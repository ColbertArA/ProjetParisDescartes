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
        <p> <?php echo $msg; ?> </p>
        <?php

        if (isset($_SESSION['profil'])) {
        
        ?>

        <h1>Bienvenue M./Mme. <?php echo $_SESSION['nom']; ?> </h1>
        <p>Vous êtes un/une <?php echo $_SESSION['id']; ?> </p>

        <?php

        }

        ?>

        <form action="index.php?controle=button&action=gogo" method="post">
            <p>
                <input type="submit" value="Voir les annonces" class="button" />
            </p>
        </form>
    </div>


    <!-- Fin page -->
</body>

</html>