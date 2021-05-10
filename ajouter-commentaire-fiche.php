<?php
session_start();
require_once("connexion_base.php");
$donnees['titre_page'] = "Récapitulatif commentaire";
$titre = $_POST['titre'];
$commentaire = $_POST['commentaire'];
$id_membre = $_SESSION['id_projet_membre'];
$fiche = $POST['fiche'];

include "debut-page.inc.php";
 ?>
<main class="fiches">
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="index.php">Accueil</a></li>
      <li class="breadcrumb-item"><a href="fiche.php">Activités et jeux</a></li>
      <li class="breadcrumb-item active" aria-current="page"><?php echo $enregistrements[0]['titre']?></li>
    </ol>
  </nav>
<h2>Récapitulatif</h2>
<p>Votre commentaire a été envoyé !  Nous le publierons dans les plus brefs délais. </p>
<ul>
  <li>Titre : <?php echo $titre; ?></li>
  <li>Votre commentaire : <?php echo $commentaire; ?></li>
</ul>

<?php

// exécuter une requete MySQL de type INSERT
$requete="INSERT INTO projet_commentaire (id_membre,id_fiche,titre, texte, date,valide) 
VALUES (?, ?, ?, ?, ?, NOW())";
$reponse=$pdo->prepare($requete);
$reponse->execute(array($id_membre, $fiche, $titre, $commentaire, 0));
?>

<p>Retourner à la page des <a href="fiche.php">Activités et jeux</a></p>

<?php include "fin-page.inc.php"; ?>
