<?php
require_once("connexion_base.php");
$donnees['titre_page'] = "Récapitulatif question";
$pseudo = $_POST['pseudo'];
$email = $_POST['email'];
$question = $_POST['question'];

include "debut-page.inc.php";
 ?>
<main id="fiches">
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="index.php">Accueil</a></li>
      <li class="breadcrumb-item"><a href="faq.php">FAQ</a></li>
    </ol>
  </nav>
<h2>Récapitulatif</h2>
<p>Votre question a été envoyée !  Nous tenterons d'y répondre dans les plus brefs délais. N'oubliez pas de regarder régulièrement votre boîte mail, nous vous enverrons un email à <?php echo $email; ?> dès que la réponse à votre question sera postée. </p>
<ul>
  <li>Votre pseudo : <?php echo $pseudo; ?></li>
  <li>Votre adresse mail : <?php echo $email; ?> </li>
  <li>Votre question : <?php echo $question; ?></li>
</ul>

<?php

// exécuter une requete MySQL de type INSERT
$requete="INSERT INTO projet_question (pseudo,email,texte,valide,datecreation)
VALUES (?, ?, ?, ?,NOW())";
$reponse=$pdo->prepare($requete);
$reponse->execute(array($pseudo, $email, $question, 0));
?>

<p>Retourner à la <a href="faq.php">FAQ</a></p>

<?php include "fin-page.inc.php"; ?>
