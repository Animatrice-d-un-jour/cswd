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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="css/main.css" rel="stylesheet">
    <link rel="shortcut icon" href="images/favicon.ico" type="images/x-icon" />
    <title>Inscription</title>
  </head>
  <body class="body">
    <div class="image">
      <div class="main2">
        <p class="sign2" align="center">S'inscrire</p>
        <form action="inscription-enregistrer.php" method="post" class="form1" novalidate>
          <input class="pseud " type="text" align="center" name="pseudo" placeholder="Nom d'utilisateur">
          <input class="pseud " type="text" align="center" name="prenom"placeholder="Prénom">
          <input class="pseud " type="text" align="center" name="nom" placeholder="Nom">
          <input class="pseud " type="text" align="center" name="email" placeholder="Adresse Mail">
          <input class="pass" type="password" align="center" name="motdepasse" placeholder="Mot de passe">
          <div class="consent">
            <label for="id_categorie">Catégorie :</label>
            <select name="id_categorie">
            <?php
                // exécuter une requete MySQL
                $requete = "SELECT * FROM projet_categorie;";
                $reponse = $pdo->prepare($requete);
                $reponse->execute();
                // récupérer tous les enregistrements dans un tableau
                $enregistrements = $reponse->fetchAll();
                // connaitre le nombre d'enregistrements
                $nombreReponses = count($enregistrements);
                // parcourir le tableau des enregistrements
                for ($i=0; $i<count($enregistrements); $i++)
                {
                ?>
                    <option value="<?php echo $enregistrements[$i]['id'];?>">
                        <?php echo $enregistrements[$i]['nom'];?>
                    </option>
                <?php
                }
            ?>
            </select>

          <div class="form-group">
            <div class="form-check">
              <input class="form-check-input" type="checkbox" name="consentement" value="false" required/>
              <label class="form-check-label" align="center" for="consentement"/>
                Accepter les conditions d'utilisations.
              </label>
              <div class="consentement">
                Vous devez accepter avant de continuer.
              </div>
            </div>
          </div>
          </div>
          <input class="submit" type="submit" align="center" value="Inscription"/>
          <p class="new" align="center"><a class="co" href="connexion.php">Se connecter</p>
        </form>

      </div>
    </div>
  </body>
</html>
