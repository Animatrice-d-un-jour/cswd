<?php
session_start();
require_once("connexion_base.php");
?>
<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
    <link href="css/main.css" rel="stylesheet">
    <link rel="shortcut icon" href="images/favicon.ico" type="images/x-icon" />
    <title>Verifier connexion</title>
    <?php
    if (isset($_POST['pseudo']))
    {
      $pseudo = $_POST['pseudo'];
    }
    ?>
    <?php
    if (isset($_POST['motdepasse']))
    {
      $motdepasse = $_POST['motdepasse'];
    }
    ?>
  </head>
  <body class="body">
    <div class="main3">
      <?php
      if (!empty($_POST['pseudo']) && !empty($_POST['motdepasse']))
      {
          $pseudo = $_POST['pseudo'];
          $motdepasse = $_POST['motdepasse'];

          // exécuter une requete MySQL de type SELECT .. WHERE
          $requete = "SELECT * FROM projet_membre WHERE pseudo = ?";
          $reponse = $pdo->prepare($requete);
          $reponse->execute(array($pseudo));

          // récupérer tous les enregistrements dans un tableau
          $enregistrements = $reponse->fetchAll();

          // connaitre le nombre d'enregistrements
          $nombreReponses = count($enregistrements);

          // tester si un enregistrement existe
          // (on suppose qu'un même pseudo n'existe qu'une fois !)
          if ($nombreReponses > 0)
          {
              // on vérifie si le mot de passe de la base de données au mot de passe du formulaire
              $motdepasse_crypte = $enregistrements[0]['motdepasse'];
              if (password_verify($motdepasse, $motdepasse_crypte))
              {
                header("location:index.php");
                $_SESSION['pseudo'] = $enregistrements[0]['pseudo'];
                $_SESSION['id_projet_membre'] = $enregistrements[0]['id'];
              }
              else
              {
                ?>
                <p align="center" class="sign3"> Le mot de passe est incorect </p>
                <p class="new" align="center"><a class="co" href="connexion.php">Se connecter</p>
                <?php
              }
          }
          else
          {
            ?>
            <p align="center" class="sign3"> Ce membre n’existe pas </p>
            <p class="new" align="center"><a class="co" href="inscription-formulaire.php">S'inscrire</p>
            <?php
          }
      }
      ?>
    </div>
  </body>
</html>
