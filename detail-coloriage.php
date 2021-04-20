<?php
require_once("connexion_base.php");

$id = $_GET['id']; // Récupération de paramètres de type $_GET

$requete = "SELECT * FROM projet_coloriage WHERE id = $id;";
$reponse = $pdo->prepare($requete);
$reponse->execute();
// récupérer tous les enregistrements dans un tableau
$enregistrements = $reponse->fetchAll();
// connaitre le nombre d'enregistrements
$nombreReponses = count($enregistrements);
// parcourir le tableau des enregistrements
$donnees['titre_page'] =  $enregistrements[0]['titre'];
include "debut-page.inc.php";
?>

<main id="fiches">

  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="index.php">Accueil</a></li>
      <li class="breadcrumb-item"><a href="coloriage.php">Coloriages</a></li>
      <li class="breadcrumb-item active" aria-current="page"><?php echo $enregistrements[0]['titre']?></li>
    </ol>
  </nav>

  <div id="telechargement">
    <h2><?php echo $enregistrements[0]['titre']?></h2>
    <a href="coloriages/<?php echo $enregistrements[0]['id'] ?>.jpg" class="btn btn-primary rounded-pill" download="<?php echo $enregistrements[0]['titre']?>">Télécharger</a>
  </div>
  <div class="image_coloriage">
    <img src="coloriages/<?php echo $enregistrements[0]['id'] ?>.jpg" class="card-img-top" alt="..." id="coloriage">
  </div>
</main>

<?php include "fin-page.inc.php"; ?>
