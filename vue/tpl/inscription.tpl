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
        <h1>Formulaire d'inscription</h1>
        <form action="index.php?controle=utilisateur&action=insert" method="POST">
            <fieldset class="cadre">
                <div class="info">
                    <legend>Inscription</legend>
                    <p>
                        <label for="pseudo">Nom</label> :
                        <input type="text" name="nom" required placeholder="Julien Dupont">
                        <span id="nom"></span>
                    </p>
                    <p>
                        <label for="mdp">Mot de passe</label> :
                        <input type="password" name="mdp" required>
                        <span id="aideMdp"></span>
                    </p>
                    <p>
                        <label for="mdp"> Retapez votre mot de passe</label> :
                        <input type="password" name="mdp2" required>
                        <span id="aideMdp"></span>
                    </p>
                    <p>
                        <label for="courriel">Mail</label> :
                        <input type="email" name="mail" required placeholder="utilisateur@mail.com">
                        <span id="aideCourriel"></span>
                    </p>
                    <p>Qui êtes-vous ?<br><br>
                        <select name="choix">
                            <option value="entreprise">Entreprise</option>
                            <option value="loueur">Loueur</option>
                        </select>
                    </p>
                </div>
            </fieldset>
            <p>
                <input type="submit" value="S'inscrire" class="button" />
            </p>
        </form>
    </div>

    <!-- Fin page-->

</body>

</html>