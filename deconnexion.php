<?php
session_start();
require_once("connexion_base.php");
?>
<!DOCTYPE html>
<html lang="fr">
  <head>

  </head>
  <body >
    <?php
    unset($_SESSION['id_projet_membre']);
    header("location:connexion.php");
    ?>
  </body>
</html>
