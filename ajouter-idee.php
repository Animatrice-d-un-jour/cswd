<?php
require_once("connexion_base.php");
$donnees['titre_page'] = "Récapitulatif idée";
$pseudo = $_POST['pseudo'];
$email = $_POST['email'];
$type = $_POST['type'];
$age = $_POST['age'];
$duree = $_POST['duree'];
$theme = $_POST['theme'];
$titre = $_POST['titre'];
$materiel = $_POST['materiel'];
$deroulement = $_POST['deroulement'];

$requete = "SELECT * FROM projet_type WHERE id = ?;";
$reponse = $pdo->prepare($requete);
$reponse->execute(array($type));
// récupérer tous les enregistrements dans un tableau
$types = $reponse->fetchAll();

$requete = "SELECT * FROM projet_age WHERE id = ?;";
$reponse = $pdo->prepare($requete);
$reponse->execute(array($age));
// récupérer tous les enregistrements dans un tableau
$ages = $reponse->fetchAll();

$requete = "SELECT * FROM projet_theme WHERE id = ?;";
$reponse = $pdo->prepare($requete);
$reponse->execute(array($theme));
// récupérer tous les enregistrements dans un tableau
$themes = $reponse->fetchAll();

include "debut-page.inc.php";
 ?>
<main class="fiches">
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="index.php">Accueil</a></li>
      <li class="breadcrumb-item"><a href="idee.php">Vos idées</a></li>
      <li class="breadcrumb-item active" aria-current="page">Récapitulatif</li>
    </ol>
  </nav>
  <h2>Récapitulatif</h2>
  <p>Merci beaucoup ! Votre super idée a été envoyée. Vous recevrez un mail à l'adresse suivante : <?php echo $email; ?> si votre idée est retenue. </p>
  <ul>
    <li><strong>Type :</strong> <?php echo $types[0]['nom']; ?></li>
    <li><strong>Age :</strong> <?php echo $ages[0]['tranche_age']; ?></li>
    <li><strong>Thème :</strong> <?php echo $themes[0]['nom']; ?></li>
    <li><strong>Durée :</strong> <?php echo $duree." minutes"; ?></li>
    <li><strong>Titre :</strong> <?php echo $titre; ?></li>
    <li><strong>Matériel nécessaire :</strong> <?php echo $materiel; ?></li>
    <li><strong>Déroulement :</strong> <?php echo $deroulement; ?></li>
  </ul>

  <?php
  // exécuter une requete MySQL de type INSERT
  $requete="INSERT INTO projet_fiche (id_type,id_age,id_theme,duree,titre, materiel, deroulement,validation, pseudo,email,date_creation)
  VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, NOW())";
  $reponse=$pdo->prepare($requete);
  $reponse->execute(array($type, $age, $theme, $duree, $titre, $materiel, $deroulement, 0,$pseudo, $email));
  ?>

  <p>Retourner au <a href="idee.php"> formulaire</a> pour soumettre une idée ^^</p>

</main>

<?php include "fin-page.inc.php"; ?>
