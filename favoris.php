<?php
session_start();
require_once("connexion_base.php");


include "debut-page.inc.php";
?>
<?php
  if (isset($_SESSION['id_projet_membre']))
  {
    $reussi = false;
    if (projet_membre_fiche.id_membre= $_SESSION['id_projet_membre'])

      $requete = "SELECT projet_fiche.*,tranche_age,nom FROM projet_fiche,projet_age,projet_theme,projet_membre_fiche WHERE projet_fiche.id_age = projet_age.id AND projet_fiche.id_theme = projet_theme.id AND projet_fiche.id = projet_membre_fiche.id_fiche AND projet_membre_fiche.id_membre= $_SESSION['id_projet_membre'];";
      $reponse = $pdo->prepare($requete);
      $reponse->execute(array($id,1));
      // récupérer tous les enregistrements dans un tableau
      $enregistrements = $reponse->fetchAll();
      // connaitre le nombre d'enregistrements
      $nombreReponses = count($enregistrements);
       ?>
      <main class="fiches">

        <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.php">Accueil</a></li>
            <li class="breadcrumb-item active" aria-current="page">Favoris</li>
          </ol>
        </nav>
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
          </div>
          <div>
            <a href="detail-fiche.php?id=<?php echo $enregistrements[$i]['id'] ?>" class="btn btn-primary rounded-pill espace">Consulter</a>
            <a href="supprimer_favoris.php" class="btn btn-primary rounded-pill espace">Supprimer</a>
          </div>
          </div>
          <?php
         } ?>
        </div>
      </main>
    <?php
    }
    else:
    {
      echo "Vous n'avez aucun favoris";
    }?>
  <?php else:
    header("location:connexion.php");
  ?>

<?php include "fin-page.inc.php"; ?>
