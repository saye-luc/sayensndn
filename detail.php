<?php
session_start();
date_default_timezone_set("Africa/Bamako");

spl_autoload_register(function ($class_name) {
    include 'class/' . $class_name . '.php';
});

if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on') {
    $LinkStart = "https://" . $_SERVER["HTTP_HOST"];
} else {
    $LinkStart = "http://" . $_SERVER["HTTP_HOST"];
}

if (isset($_SESSION["etatConnexion"]) && $_SESSION["etatConnexion"] == "connected") {

    $code = $_GET['code'];
    $vol = new Db_Vol();
    $liste = array();
    $liste = $vol->GetByCode($code);
    
    $p=new Db_Passager();
    $listePassager=array();
    $listePassager=$p->GetByVol($code);
} else {
    Header("Location:authentification.php");
}


?>


<!doctype html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Intégration de Bootstrap et CSS au projet -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <title>Gestion des vols</title>
</head>

<body>
    <nav class="navbar navbar-expand-lg bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="acueil.php">Admin</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarText">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="reservation.php">Réservation</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="enregistrement.php">Enregistrement des vols</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Liste des vols</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="connection.php">authentification</a>
                    </li>

                </ul>
            </div>
        </div>
    </nav>

    <form action="actions/update-vol.php" method="post">
        <div class="col-md-12 heading-section text-center ftco-animate">
            <h2 class="mb-4">Detail du vol <?php echo $liste[0]['code_vol'] ?></h2>
        </div>
        <div class="container">
            <!-- Content here -->
            <div class="form-row ">
                <div class="form-group col-md-4">
                    <label for="date_depart">Date de départ</label>
                    <input type="date" class="form-control" id="date_depart"  name="date_depart" value="<?php echo $liste[0]['date_depart'] ?>">
                </div>
                <div class="form-group col-md-4">
                    <label for="heure_depart">Heure de départ</label>
                    <input type="time" class="form-control" id="heure_depart" placeholder="code vol" value="<?php echo $liste[0]['heure_depart'] ?>" name="heure_depart" >
                </div>
            </div>

            <div class="form-row ">
                <div class="form-group col-md-4">
                    <label for="destination">Destination</label>
                    <input type="text" class="form-control" id="destination" placeholder="destination" value="<?php echo $liste[0]['destination'] ?>" name="destination" >
                </div>
                <div class="form-group col-md-4">
                    <label for="code_vol">Code vol</label>
                    <input type="text" class="form-control" id="code_vol" placeholder="code vol" value="<?php echo $liste[0]['code_vol'] ?>" name="code_vol" >
                </div>
            </div>
            <div class="form-row ">
                <div class="form-group col-md-4">
                    <label for="nb_classe_a">Nombre de place A</label>
                    <input type="number" class="form-control" id="nb_classe_a" placeholder="Nombre de place A" value="<?php echo $liste[0]['nb_classe_a'] ?>" name="nb_classe_a" >
                </div>

                <div class="form-group col-md-4">
                    <label for="nb_classe_b">Nombre de place B</label>
                    <input type="number" class="form-control" id="nb_classe_b" placeholder="Nombre de place B" value="<?php echo $liste[0]['nb_classe_b'] ?>" name="nb_classe_b" >
                </div>
            </div>
            <div class="form-row ">
                <div class="form-group col-md-4">
                    <label for="prix_classe_a">Prix classe A</label>
                    <input type="number" class="form-control" id="prix_classe_a" placeholder="Nombre de place A" value="<?php echo $liste[0]['prix_classe_a'] ?>" name="prix_classe_a" >
                </div>

                <div class="form-group col-md-4">
                    <label for="prix_classe_a">Prix classe B</label>
                    <input type="number" class="form-control" id="prix_classe_b" placeholder="Nombre de place B" value="<?php echo $liste[0]['prix_classe_b'] ?>" name="prix_classe_b" >
                </div>
            </div>
            <button type="submit" class="btn btn-success mr-2">Modifier</button>
            <a href="actions/delete-vol.php?code=<?php echo $liste[0]['code_vol'] ?>" class="btn btn-danger mr-2">Supprimer</a>
        </div>
    </form>

    <table class="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Num piece</th>
                <th scope="col">Nom</th>
                <th scope="col">Prenom</th>
                <th scope="col">Sexe</th>
                <th scope="col">Classe</th>
                <th scope="col">Détails</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if (is_array($listePassager) || is_object($listePassager)) {
                foreach ($listePassager as $item) {
            ?>
                    <tr>
                        <th scope="row">1</th>
                        <td><?php echo $item['num_piece'] ?></td>
                        <td><?php echo $item['nom_passager'] ?></td>
                        <td><?php echo $item['prenom_passager'] ?></td>
                        <td><?php echo $item['sexe'] ?></td>
                        <td><?php echo $item['choix_class'] ?></td>
                        <td><a href="detail-passager.php?num=<?php echo $item['num_piece'] ?>" class="btn btn-sm btn-info">Voir</a></td>
                    </tr>
            <?php
                }
            }
            ?>
        </tbody>
    </table>


    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>

</html>