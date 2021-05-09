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
    <link href="css/main.css" rel="stylesheet">
    <title>Inscription</title>
  </head>
  <body class="body">
    <div class="image">
      <div class="main2">
        <p class="sign" align="center">S'inscrire</p>
        <form action="inscription-enregistrer.php" method="post" class="form1" novalidate>
          <input class="pseud " type="text" align="center" name="pseudo" placeholder="Nom d'utilisateur">
          <input class="pseud " type="text" align="center" name="nom"placeholder="Nom">
          <input class="pseud " type="text" align="center" name="prenom" placeholder="Prénom">
          <input class="pass" type="password" align="center" name="motdepasse" placeholder="Mot de passe">
          <p>
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
          </p>
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
          <input class="submit" type="submit" align="center" value="Inscription"/>
          <p class="new" align="center"><a class="co" href="connexion.php">Se connecter</p>
        </form>
        <script>
        // Example starter JavaScript for disabling form submissions if there are invalid fields
        (function() {
          'use strict';
          window.addEventListener('load', function() {
            // Fetch all the forms we want to apply custom Bootstrap validation styles to
            var forms = document.getElementsByClassName('form1');
            // Loop over them and prevent submission
            var validation = Array.prototype.filter.call(forms, function(form) {
              form.addEventListener('submit', function(event) {
                if (form.checkValidity() === false) {
                  event.preventDefault();
                  event.stopPropagation();
                }
                form.classList.add('was-validated');
              }, false);
            });
          }, false);
        })();
        </script>
      </div>
    </div>
  </body>
</html>
