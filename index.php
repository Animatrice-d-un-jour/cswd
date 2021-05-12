<?php
require_once("connexion_base.php");
$donnees['titre_page'] = "Page d'accueil";
$requete = "SELECT projet_fiche.*,tranche_age,nom FROM projet_fiche,projet_age,projet_theme WHERE projet_fiche.id_age = projet_age.id AND projet_fiche.id_theme = projet_theme.id AND id_theme = ? ORDER BY projet_fiche.id DESC;";
$reponse = $pdo->prepare($requete);
$reponse->execute(array(3));
// récupérer tous les enregistrements dans un tableau
$enregistrements = $reponse->fetchAll();
// connaitre le nombre d'enregistrements
$nombreReponses = count($enregistrements);
// parcourir le tableau des enregistrements

include "debut-page.inc.php";
?>

<!--- Les images qui défilent  -->
<div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
  <div class="carousel-indicators">
    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
  </div>
  <div class="carousel-inner">
    <div class="carousel-item active">
      <a href="idee.php">
        <img src="images/image1.png" class="d-block w-100 uno" alt="image 1">
        <img src="images/image1_mobile.png" class="d-block w-100 dos" alt="image 1">
      </a>
    </div>
    <div class="carousel-item">
      <img src="images/image2.png" class="d-block w-100 uno" alt="image 2">
      <img src="images/image2_mobile.png" class="d-block w-100 dos" alt="image 2">
    </div>
    <div class="carousel-item">
      <img src="images/image3.png" class="d-block w-100 uno" alt="image 3">
      <img src="images/image3_mobile.png" class="d-block w-100 dos" alt="image 3">
    </div>
  </div>
  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button>
</div>

<main id= "texte">

  <h2>A LA UNE</h2>
  <!--- Les carrés qui affichent les trois activités à la une  -->
  <div class="cards">
    <!-- boucle -->
    <?php
    for ($i=0; $i<3; $i++)
    {?>
      <div class="card">
        <div class="card-body">
          <h5 class="card-title"><?php echo $enregistrements[$i]['titre'];?></h5>
          <p class="card-text">
            AGE : <?php echo $enregistrements[$i]['tranche_age'] ?> <br>
            DUREE : <?php echo transforme($enregistrements[$i]['duree']); ?><br>
            THEME : <?php echo $enregistrements[$i]['nom'] ?><br>
          </p>
        </div>
        <div>
          <a href="detail-fiche.php?id=<?php echo $enregistrements[$i]['id'] ?>" class="btn btn-primary rounded-pill espace">Consulter</a>
        </div>
      </div>
      <?php
    } ?>
  </div>


  <h2>DERNIERS POSTS</h2>
  <!--- Les dernières images postées par les utilisateurs/ à afficher depuis la BDD  -->
  <div class="photo">
    <?php
    $requete = "SELECT * FROM projet_photo WHERE valide = ? ORDER BY id DESC;";
    $reponse = $pdo->prepare($requete);
    $reponse->execute(array(1));
    // récupérer tous les enregistrements dans un tableau
    $photos = $reponse->fetchAll();
    // connaitre le nombre d'enregistrements
    $nombreReponses = count($photos);
    // parcourir le tableau des enregistrements
    for ($i=0; $i<4; $i++)
    {
      if (file_exists("images/images-ajoutées/activité-".$photos[$i]['id'].".jpg"))
      { $fiche = $photos[$i]['id_fiche']
          ?>
          <div class="dernier_post">
            <a href="detail-fiche.php?id=<?php echo $fiche ?>">
               <img src="images/images-ajoutées/activité-<?php echo $photos[$i]['id']; ?>.jpg" height="100" class="rounded" alt="activité-<?php echo $photos[$i]['id']; ?>">
            </a>
          </div>
        <?php
      }
    }
     ?>
  </div>

  <h2>QUI SOMMES-NOUS? </h2>
  <div class="info">
    <div class="creatrice">
      <img src="images/Lucie.png" height="150" width="150" alt="Lucie">
      <p>LUCIE</p>
    </div>
    <div class="creatrice">
      <img src="images/Catlyn.png" height="150" width="150" alt="Catlyn">
      <p>CATLYN</p>
    </div>
    <div class="creatrice">
      <img src="images/Chloé.png" height="150" width="150" alt="Chloé">
      <p>CHLOE</p>
    </div>
  </div>

  <p class="description">
    Nous sommes Lucie, Catlyn et Chloé. Trois étudiantes en deuxième année de fac et accessoirement trois animatrices d'un jour dont certaines étant plus expertes que d'autres :)
    <br>
    L'idée nous est venue de créer ce site afin d'occuper vos petits bouts de chou. Effectivement, il n'est pas toujours évident de trouver des idées pour occuper ces petits êtres plein d'énergie. Nous espérons via ce site internet collaboratif pouvoir partager entre parents, animateurs ou baby-sitters des activités et jeux amusants et créatifs qui plairont tant aux petits qu'aux grands.

  </p>

</main>

<?php include "fin-page.inc.php"; ?>

