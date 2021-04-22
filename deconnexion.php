<?php
session_start();
require_once("connexion_base.php");
?>
<!DOCTYPE html>
<html lang="fr">
  <head>

  </head>
  <body>
    <?php
    unset($_SESSION['id_projet_membre']);
    ?>
    <a herf href="inscription.php"> Page d'inscription</a>
  </body>
</html>
