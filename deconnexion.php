<?php
session_start();
require_once("connexion_base.php");
?>
<!DOCTYPE html>
<html lang="fr">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

  </head>
  <body >
    <?php
      unset($_SESSION['id_projet_membre']);
      header("location:connexion.php");
    ?>
  </body>
</html>
