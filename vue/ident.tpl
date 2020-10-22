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
            <li><a href="index.php?controle=button&action=inscription">S'inscrire</a></li>
            <li><a href="index.php?controle=button&action=connexion">Se connecter</a></li>
        </ul>
    </header>

    <!-- Fin header -->

    <!-- Début page -->

    <div class="cover">
        <h1><a href="index.php?controle=button&action=gogo">GoGoVoiture</a></h1>
        <p class="bienvenue">
            Bienvenue sur GoGoVoiture, le site pour louer votre véhicule !<br>
            Vous êtes une entreprise et vous avez besoin de louer un véhicule rapidement et facilement ?<br>
            Vous êtes un particulier ? Vous avez un véhicule que vous souhaitez le faire louer ?<br>
            GoGoVoiture est le site fait pour vous !
        </p>
        <button class="buttonC"><span><a href="index.php?controle=button&action=inscription">S'incrire</a></span></button>
    </div>

    <div class="center-item">
        <h2>Louer un véhicule ou faites louer votre véhicule !</h2>
        <p class="client">Déjà client ? N'oublier pas de vous connecter !</p>
        <button class="button"><span><a href="index.php?controle=button&action=connexion">Connectez-vous !</a></span></button>
    </div>

    <div class="container">
        <div class="down-item">
            <div class="annonces" id="page">
                <img src="./vue/photos_voitures/W101768559_STANDARD_0.jpg">
                <p>
                    Peugeot 206
                </p>
                <button class="button"><span><a href="">Voir l'annonce</a></span></button>
            </div>
    
            <div class="annonces" id="page">
                <img src="./vue/photos_voitures/B101294858_STANDARD_0.jpg">
                <p>
                    VOLKSWAGEN POLO IV
                </p>
                <button class="button"><span><a href="">Voir l'annonce</a></span></button>
            </div>
        </div>
    
        <div class="down-item2">
            <div class="annonces" id="page">
                <img src="./vue/photos_voitures/E107273672_STANDARD_0.jpg">
                <p>
                    FORD FIESTA IV
                </p>
                <button class="button"><span><a href="">Voir l'annonce</a></span></button>
            </div>

            <div class="annonces" id="page">
                <img src="./vue/photos_voitures/E107273672_STANDARD_0.jpg">
                <p>
                    FORD FIESTA IV
                </p>
                <button class="button"><span><a href="">Voir l'annonce</a></span></button>
            </div>
        </div>
    </div>
    
    <!-- Fin page -->

</body>

</html>