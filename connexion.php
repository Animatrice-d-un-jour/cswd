<?php
session_start();
require_once("connexion_base.php");
?>
<!doctype html>
<html lang="fr">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
    <link href="css/main.css" rel="stylesheet">
    <title>Connexion</title>

  </head>
  <body class="body">
    <?php
      if (isset($_SESSION['id_projet_membre']))
      {
        ?>
        <div class="main1">
          <a href="index.php"><img src="images/logo_5.png" height="40" alt="logo" id="mini2"></a>
          <form class="form1"/>
            <button type="button" align="center" class="submit2"><a href="favoris.php" class="neutre">Mes favoris</a></button>
            <button type="button"  align="center" class="submit2"><a href="deconnexion.php" class="neutre">Se déconnecter</a></button>
          </form>
        </div>
        <?php
      }
      else
      {
        ?>
        <div class="main1">
          <a href="index.php"><img src="images/logo_5.png" height="40" alt="logo" id="mini"></a>
          <p class="sign" align="center">Se connecter</p>
          <form action="verifier-connexion.php" method="post" class="form1"/>
            <input class="pseud" type="text" align="center" placeholder="Nom d'utilisateur" name="pseudo" required/>
            <input class="pass" type="password" align="center" placeholder="Mot de passe" name="motdepasse" required />
            <input class="submit" align="center" type="submit" value="Connexion"/>
            <p class="new" align="center"><a class="co" href="inscription-formulaire.php">S'inscrire</p>
          </form>
        </div>
        <?php
      }
      ?>
  </body>
</html>
