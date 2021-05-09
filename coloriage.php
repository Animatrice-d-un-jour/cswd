<?php
require_once("connexion_base.php");
$donnees['titre_page'] = "Coloriages";

$requete = "SELECT * FROM projet_coloriage;";
$reponse = $pdo->prepare($requete);
$reponse->execute();
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
      <li class="breadcrumb-item active" aria-current="page">Coloriages</li>
    </ol>
  </nav>

  <h2>Coloriages</h2>

  <div class="cards">
    <!-- boucle -->
    <?php
    for ($i=0; $i<count($enregistrements); $i++)
    {
    ?>
    <div class="card" >
      <img src="coloriages/mini_<?php echo $enregistrements[$i]['id'] ?>.jpg" class="card-img-top" alt="coloriage de <?php echo $enregistrements[$i]['titre'] ?>" height="300px">
      <div class="card-body">
        <h5 class="card-title"><?php echo $enregistrements[$i]['titre'] ?></h5>
        <a href="detail-coloriage.php?id=<?php echo $enregistrements[$i]['id'] ?>" class="btn btn-primary rounded-pill">Voir</a>
      </div>
     </div>
    <?php
     } ?>
    </div>

  </div>
</main>
<!--
<a href='https://fr.freepik.com/vecteurs/nourriture'>Nourriture vecteur créé par bamdewanto - fr.freepik.com</a>
<a href='https://fr.freepik.com/vecteurs/enfants'>Enfants vecteur créé par freepik - fr.freepik.com</a>
<a href='https://fr.freepik.com/vecteurs/fond'>Fond vecteur créé par bimbimkha - fr.freepik.com</a>
-->


<?php include "fin-page.inc.php"; ?>
