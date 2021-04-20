<?php
require_once("connexion_base.php");
$donnees['titre_page'] = "Page theme";

$n = $_GET['n']; // Récupération de paramètres de type $_GET
$requete = "SELECT projet_fiche.*,tranche_age,nom FROM projet_fiche,projet_age,projet_theme WHERE projet_fiche.id_age = projet_age.id AND projet_fiche.id_theme = projet_theme.id AND id_theme=$n;";
$reponse = $pdo->prepare($requete);
$reponse->execute();
// récupérer tous les enregistrements dans un tableau
$enregistrements = $reponse->fetchAll();
// connaitre le nombre d'enregistrements
$nombreReponses = count($enregistrements);
// parcourir le tableau des enregistrements

include "debut-page.inc.php";
?>

<main id="fiches">

  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="index.php">Accueil</a></li>
      <li class="breadcrumb-item active" aria-current="page">Thèmes</li>
    </ol>
  </nav>

  <h2>Activités et jeux <?php echo $enregistrements[0]['nom'] ?></h2>


  <div class="cards">
    <!-- boucle -->
    <?php
    for ($i=0; $i<count($enregistrements); $i++)
    {
    ?>
    <div class="card">
      <div class="card-body">
        <h5 class="card-title"><?php echo $enregistrements[$i]['titre'];?></h5>
        <p class="card-text">
          AGE : <?php echo $enregistrements[$i]['tranche_age'] ?> <br>
          DUREE : <?php echo $enregistrements[$i]['duree'] ?><br>
          THEME : <?php echo $enregistrements[$i]['nom'] ?><br>
        </p>
        <a href="detail-jeu.php?id=<?php echo $enregistrements[$i]['id'] ?>" class="btn btn-primary rounded-pill">Consulter</a>
      </div>
      </div>
      <?php
     } ?>
    </div>

</main>



<?php include "fin-page.inc.php"; ?>
