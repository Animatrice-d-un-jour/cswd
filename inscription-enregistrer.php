<?php
require_once("connexion_base.php");

$reussi = false;
if (!empty($_POST['pseudo']) && !empty($_POST['motdepasse']) &&
    !empty($_POST['prenom']) && !empty($_POST['nom']) && !empty($_POST['email']) && !empty($_POST['id_categorie']) &&
    !empty($_POST['consentement']))
{
    $pseudo = $_POST['pseudo'];
    $motdepasse = $_POST['motdepasse'];
    $prenom = $_POST['prenom'];
    $nom = $_POST['nom'];
    $email = $_POST['email'];
    $id_categorie = $_POST['id_categorie'];

    $motdepasse_crypte = password_hash($motdepasse, PASSWORD_DEFAULT);

    // vous pouvez aussi tester ici si le pseudo est le mail ne sont pas déjà utilisé
    // vous pouvez aussi tester ici si le mot de passe est sécurisé
    // (donc contient plus que 12 caractères, et des majuscules, miniscules, caractères spéciaux)

    $requete="INSERT INTO projet_membre (pseudo,prenom,nom,motdepasse,dateinscrit,id_categorie) VALUES (?, ?, ?, ?, NOW(), ?)";
    $reponse=$pdo->prepare($requete);
    $reponse->execute(array($pseudo, $prenom, $nom,$email,$motdepasse_crypte, $id_categorie));
    $reussi = true;
}
?>
<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8" />
    </head>
    <body class="body">
      <?php
      if ($reussi == true)
      {
      header("location:connexion.php");
      }
      ?>
    </body>
</html>
