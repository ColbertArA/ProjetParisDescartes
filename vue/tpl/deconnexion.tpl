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
            <li><a href="index.php?controle=utilisateur&action=insert">S'inscrire</a></li>
            <li><a href="index.php?controle=utilisateur&action=ident">Se connecter</a></li>
        </ul>
    </header>

    <!-- Fin header -->

    <!-- Début page -->

    <div class="formulaire" id="page">
        <p>
            <?php echo $msg;
            $mois=11;
            $i=4;
            require ('./modele/facturationBD.php');
            facturesDuMois($mois, $i); ?>
        </p>
    </div>

    <!-- Fin page-->

</body>

</html>