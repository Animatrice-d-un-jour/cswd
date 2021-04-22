<?php
session_start();
require_once("connexion_base.php");
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
    <link href="css/inscription2.css" rel="stylesheet">
    <title>Connexion</title>

  </head>
  <body>
    <?php
      if (isset($_SESSION['id_proje_membre']))
      {
        ?>
        <a href="#">Mes favoris</a>
        <a href="#">Se déconnecter</a>
        <?php
      }
      else
      {
        ?>
        <div class="image">
          <div class="main">
            <p class="sign" align="center">Se connecter</p>
            <form action="verifier-connexion.php" method="post" class="form1">
              <input class="pseudo" type="text" align="center" placeholder="Nom d'utilisateur">
              <input class="pass" type="password" align="center" placeholder="Mot de passe">
              <a class="submit" align="center">Connexion</a>
              <p class="new" align="center"><a href="inscription-formulaire.php">S'inscrire</p>
            </form>
          </div>
        </div>
        <?php
      }
      ?>
  </body>
</html>
