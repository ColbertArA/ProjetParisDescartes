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
            <li><a href="index.php?controle=button&action=inscription">S'inscrire</a></li>
            <li><a href="index.php?controle=button&action=connexion">Se connecter</a></li>
        </ul>
    </header>

    <!-- Fin header -->

    <!-- Début page -->

    <div class="formulaire" id="page">
        <form action="index.php?controle=utilisateur&action=ident" method="post">
            <fieldset class="cadre">
                <div class="info">
                    <legend>Connexion</legend>
                    <p>
                        <label for="courriel">Mail</label> :
                        <input name="mail" type="email" required placeholder="utilisateur@mail.com">
                    </p>
                    <p>
                        <label for="mdp">Mot de passe</label> :
                        <input name="mdp" type="password" required>
                    </p>
                </div>
            </fieldset>
            <p>
                <input name="connexion" type="submit" value="Connexion" class="button"/>
            </p>
            <p>
                Mauvais mot de passe ou mail !
            </p>
        </form>
    </div>

    <!-- Fin page-->

</body>

</html>