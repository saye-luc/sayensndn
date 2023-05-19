<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Vols/authentification.php </title>
    <!-- importer le fichier de style -->
    <link rel="stylesheet" href="style.css" media="screen" type="text/css" />
</head>

<body>
    <div id="container" collator_asort="  background: #0dcaf">
        <!-- zone de connexion -->
        <form action="actions/login.php" method="POST">
            <h1>Connexion a la page de publication des Vols</h1>

            <label><b>Nom d'utilisateur</b></label>
            <input type="text" placeholder="Entrer le nom d'utilisateur" name="username" required>
            <br>
            <label><b>Mot de passe</b></label>
            <input type="password" placeholder="Entrer le mot de passe" name="password" required>
            <br>

            <input type="submit" id='submit' value='Connection' type='a' class="nav-link active" aria-current="page" href="acueil.php">
        </form>
    </div>
</body>