<?php
require_once("connexion_base.php");
$donnees['titre_page'] = "Récapitulatif commentaire";
$pseudo = $_POST['pseudo'];
$commentaire = $_POST['commentaire'];

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
  <li>Votre pseudo : <?php echo $pseudo; ?></li>
  <li>Votre commentaire : <?php echo $commentaire; ?></li>
</ul>

<?php

// exécuter une requete MySQL de type INSERT
$requete="INSERT INTO projet_commentaire (id_menbre,id_fiche,texte,titre,datecreation) WHERE projet_commentaire.id_membre=projet_membre.id AND projet_commentaire.id_fiche=projet_fiche.id
VALUES (?, ?, ?, ?,NOW())";
$reponse=$pdo->prepare($requete);
$reponse->execute(array($pseudo, $commentaire, 0));
?>

<p>Retourner à la page des <a href="fiche.php">Activités et jeux</a></p>

<?php include "fin-page.inc.php"; ?>