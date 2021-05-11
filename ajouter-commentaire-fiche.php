<?php
session_start();
require_once("connexion_base.php");
$donnees['titre_page'] = "Récapitulatif commentaire";
$titre = $_POST['titre'];
$commentaire = $_POST['commentaire'];
$fiche = $_POST['fiche'];
$id_membre = $_SESSION['id_projet_membre'];

$requete = "SELECT projet_fiche.*FROM projet_fiche WHERE projet_fiche.id = ?;";
$reponse = $pdo->prepare($requete);
$reponse->execute(array($fiche));
// récupérer tous les enregistrements dans un tableau
$enregistrements = $reponse->fetchAll();
// connaitre le nombre d'enregistrements
$nombreReponses = count($enregistrements);
// parcourir le tableau des enregistrements

include "debut-page.inc.php";
 ?>
<main class="fiches">
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="index.php">Accueil</a></li>
      <?php if($enregistrements[0]['id_type']==1)
        {
       ?> <li class="breadcrumb-item"><a href="fiche.php?id=<?php echo $enregistrements[0]['id_type']; ?>">Jeux</a></li>
     <?php
        }
        else if($enregistrements[0]['id_type']==2)
        { ?>
          <li class="breadcrumb-item"><a href="fiche.php?id=<?php echo $enregistrements[0]['id_type']; ?>">Activités</a></li>
        <?php
        } ?>
      <li class="breadcrumb-item"><a href="detail-fiche.php?id=<?php echo $fiche ?>"><?php echo $enregistrements[0]['titre']; ?></a></li>
      <li class="breadcrumb-item active" aria-current="page">Récapitulatif commentaire</li>
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
$requete="INSERT INTO projet_commentaire (id_membre,id_fiche,titre, texte, valide,date)
VALUES (?, ?, ?, ?, ?, NOW())";
$reponse=$pdo->prepare($requete);
$reponse->execute(array($id_membre, $fiche, $titre, $commentaire, 0));
?>

<a href="detail-fiche.php?id=<?php echo $fiche ?>">Retourner à la fiche d'activité/jeu</a>

</main>

<?php include "fin-page.inc.php"; ?>
