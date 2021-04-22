<?php
require_once("connexion_base.php");

$reussi = false;
if (!empty($_POST['pseudo']) && !empty($_POST['motdepasse']) && !empty($_POST['email']) &&
    !empty($_POST['prenom']) && !empty($_POST['nom']) && !empty($_POST['id_categorie']) &&
    !empty($_POST['consentement']))
{
    $pseudo = $_POST['pseudo'];
    $motdepasse = $_POST['motdepasse'];
    $email = $_POST['email'];
    $prenom = $_POST['prenom'];
    $nom = $_POST['nom'];
    $id_categorie = $_POST['id_categorie'];

    $motdepasse_crypte = password_hash($motdepasse, PASSWORD_DEFAULT);

    // vous pouvez aussi tester ici si le pseudo est le mail ne sont pas déjà utilisé
    // vous pouvez aussi tester ici si le mot de passe est sécurisé
    // (donc contient plus que 12 caractères, et des majuscules, miniscules, caractères spéciaux)

    $requete="INSERT INTO membre (pseudo,motdepasse,prenom,nom,email,id_categorie,dateinscrit) VALUES (?, ?, ?, ?, ?, ?, NOW())";
    $reponse=$pdo->prepare($requete);
    $reponse->execute(array($pseudo, $motdepasse_crypte, $prenom, $nom, $email, $id_categorie));
    $reussi = true;
}
?>
<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8" />
        <title>Récapitulatif</title>
    </head>
    <body>
    <?php
    if ($reussi == true)
    {
    ?>
        <h2>Récapitulatif des informations</h2>
        <p>
            Nom : <?php echo $nom; ?><br />
            Prénom :<?php echo $prenom; ?><br />
            Adresse email : <?php echo $email; ?><br />
            Catégorie : <?php echo $id_categorie; ?><br />
            Pseudo : <?php echo $pseudo; ?><br />
            Mot de passe : **********<br />
        </p>
        <a href="connexion.php"> Connexion</a>
    <?php
    }
    else
    {
    ?>
        <p>Veuillez svp renseigner toutes les informations.</p>
    <?php
    }
    ?>
    </body>
</html>
