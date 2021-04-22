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
    <title>Inscription</title>
  </head>
  <body>
    <div class="image">
      <div class="main2">
        <p class="sign" align="center">S'inscrire</p>
        <form action="enregistrer-membre.php" method="post" class="form1">
          <input class="pseudo " type="text" align="center" placeholder="Nom d'utilisateur" id="pseudo">
          <input class="pseudo " type="text" align="center" placeholder="Nom" id="nom">
          <input class="pseudo " type="text" align="center" placeholder="Prénom" id="prenom">
          <input class="pseudo " type="text" align="center" placeholder="Adresse email" id="email">
          <input class="pass" type="password" align="center" placeholder="Mot de passe">
          <p>
              <input class="check" type="checkbox" align="center" value="oui" name="consentement" id="consentement" />
              En soumettant ce formulaire, j'accepte que les informations saisies dans ce formulaire soient utilisées, exploitées, traitées, pour permettre de m'authentifier dans le cadre de ce projet.
          </p>
          <a class="submit" align="center">Inscription</a>
          <p class="new" align="center"><a href="connexion.php">Se connecter</p>
        </form>
      </div>
    </div>
  </body>
</html>
