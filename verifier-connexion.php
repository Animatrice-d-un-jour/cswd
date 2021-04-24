<?php
session_start();
require_once("connexion_base.php");
?>
<!DOCTYPE html>
<html lang="fr">
  <head>
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
  <body>

    <?php
    if (!empty($_POST['pseudo']) && !empty($_POST['motdepasse']))
    {
        $pseudo = $_POST['pseudo'];
        $motdepasse = $_POST['motdepasse'];

        // exécuter une requete MySQL de type SELECT .. WHERE
        $requete = "SELECT * FROM projet_membre WHERE pseudo = ?";
        $reponse = $pdo->prepare($requete);
        $reponse->execute(array($pseudo));

        // récupérer tous les enregistrements dans un tableau
        $enregistrements = $reponse->fetchAll();

        // connaitre le nombre d'enregistrements
        $nombreReponses = count($enregistrements);

        // tester si un enregistrement existe
        // (on suppose qu'un même pseudo n'existe qu'une fois !)
        if ($nombreReponses > 0)
        {
            // on vérifie si le mot de passe de la base de données au mot de passe du formulaire
            $motdepasse_crypte = $enregistrements[0]['motdepasse'];
            if (password_verify($motdepasse, $motdepasse_crypte))
            {
              ?>
              <p> Bienvenu ! Vous êtes maintenant connecté.</p>
              <a href="index.php"> Retour à la page d'acceuil</a></br>
              <a href="deconnexion.php"> Se déconnecter</a>
              <?php
              $_SESSION['pseudo'] = $enregistrements[0]['pseudo'];
              $_SESSION['id_projet_membre'] = $enregistrements[0]['id'];
            }
            else
            {
              ?>
              <p> Le mot de passe est incorect </p>
              <a href="connexion.php"> Retour vers la page de connexion </a>
              <?php
            }
        }
        else
        {
          ?>
          <p> Ce membre n’existe pas </p>
          <a href="inscription-formulaire.php"> S'inscrire </a>
          <?php
        }
    }
    ?>
  </body>
</html>
