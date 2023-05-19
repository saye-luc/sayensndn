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

  $vol = new Db_Vol();
  $liste = array();
  $liste = $vol->getAll();
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
      <a class="navbar-brand" href="acueil.php">Accueil</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarText">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link" href="enregistrement.php">Enregistrement des vols</a>
          </li>
          <?php
          if (isset($_SESSION["etatConnexion"]) && $_SESSION["etatConnexion"] == "connected") { ?>
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="actions/deconnexion.php">Deconnexion</a>
            </li>
          <?php }
          ?>


        </ul>
      </div>
    </div>
  </nav>


  <table class="table">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">Code vols</th>
        <th scope="col">Date départ</th>
        <th scope="col">Heure de depart</th>
        <th scope="col">Destination</th>
        <th scope="col">Nombre de place A</th>
        <th scope="col">Nombre de place B</th>
        <th scope="col">Prix classe A</th>
        <th scope="col">Prix classe B</th>
        <th scope="col">Détails</th>
      </tr>
    </thead>
    <tbody>
      <?php
      if (is_array($liste) || is_object($liste)) {
        foreach ($liste as $item) {
      ?>
          <tr>
            <th scope="row">1</th>
            <td><?php echo $item['code_vol'] ?></td>
            <td><?php echo $item['date_depart'] ?></td>
            <td><?php echo $item['heure_depart'] ?></td>
            <td><?php echo $item['destination'] ?></td>
            <td><?php echo $item['nb_classe_a'] ?></td>
            <td><?php echo $item['nb_classe_b'] ?></td>
            <td><?php echo $item['prix_classe_a'] ?></td>
            <td><?php echo $item['prix_classe_b'] ?></td>
            <td><a href="detail.php?code=<?php echo $item['code_vol'] ?>" class="btn btn-sm btn-info">Voir</a></td>
          </tr>
      <?php
        }
      }
      ?>
    </tbody>
  </table>


  <form action="actions/create-passager.php" method="post">
    <div class="col-md-12 heading-section text-center ftco-animate">
      <h2 class="mb-4">Formulaire de réservation de billet</h2>
    </div>
    <div class="container">
      <!-- Content here -->
      <div class="form-row ">
        <div class="form-group col-md-6">
          <label for="num_piece">Numéro de pièce</label>
          <input type="text" class="form-control" id="num_piece" placeholder="Numéro de pièce" name="num_piece" require="">
        </div>
        <div class="form-group col-md-6">
          <label for="code_vol">Code vol</label>
          <input type="text" class="form-control" id="code_vol" placeholder="code vol" name="code_vol" require="">
        </div>
      </div>
      <div class="form-row ">
        <div class="form-group col-md-6">
          <label for="nom_passager">Nom passager</label>
          <input type="text" class="form-control" id="nom_passager" placeholder="Nom du passager" name="nom_passager" require="">
        </div>

        <div class="form-group col-md-6">
          <label for="prenom_passager">Prénom passager</label>
          <input type="text" class="form-control" id="prenom_passager" placeholder="prenom du passager" name="prenom_passager" require="">
        </div>
      </div>
      <div class="form-row">
        <div class="form-group col-md-6">
          <label for="sexe_passager">Sexe passager</label>
          <select id="sexe_passager" name="sexe_passager" class="form-control" require="">
            <option selected>Choose...</option>
            <option>Masculin</option>
            <option>Féminin</option>
          </select>
        </div>
        <div class="form-group col-md-6">
          <label for="sexe_passager">Choix d'une place</label>
          <select id="sexe_passager" name="classe_passager" class="form-control" require="">
            <option selected>Place en classe A</option>
            <option>Place en classe B</option>
          </select>
        </div>
      </div>
      <button type="submit" class="btn btn-success">Réserver</button>
    </div>
  </form>

  <!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>

</html>