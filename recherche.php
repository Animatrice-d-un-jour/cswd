<?php require_once("connexion_base.php");

$mot = $_POST['mot'];
$donnees['titre_page'] = "Recherche : $mot";
include "debut-page.inc.php"; ?>

<main class="fiches">

  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="index.php">Accueil</a></li>
      <li class="breadcrumb-item active" aria-current="page">Recherche</li>
    </ol>
  </nav>

  <h2>Résultats de la recherche : <?php echo $mot; ?></h2>

  <?php
  if (($mot == "")||($mot == "%")||($mot == " "))
  {
  	echo "<p>Veuillez entrer un mot clé s'il vous plaît!</p>";
  }
  else
  {
    $requete = "SELECT * FROM projet_fiche WHERE (titre LIKE \"%$mot%\" OR materiel LIKE \"%$mot%\" OR deroulement LIKE \"%$mot%\") ;";
    $reponse = $pdo->prepare($requete);
    $reponse->execute();
    // récupérer tous les enregistrements dans un tableau
    $enregistrements = $reponse->fetchAll();
    // connaitre le nombre d'enregistrements
    $nombreReponses = count($enregistrements);

    if ($nombreReponses == "0")
    {
    	echo "<p>Aucun résultat ne correspond à votre recherche</p>";
    }
    else
    {
      $requete = "SELECT projet_fiche.*,tranche_age,nom FROM projet_fiche,projet_age,projet_theme WHERE projet_fiche.id_age = projet_age.id AND projet_fiche.id_theme = projet_theme.id AND validation =? AND (titre LIKE \"%$mot%\" OR materiel LIKE \"%$mot%\" OR deroulement LIKE \"%$mot%\");";
      $reponse = $pdo->prepare($requete);
      $reponse->execute(array(1));
      // récupérer tous les enregistrements dans un tableau
      $enregistrements = $reponse->fetchAll();
      // connaitre le nombre d'enregistrements
      $nombreReponses = count($enregistrements);
      // parcourir le tableau des enregistrements ?>

      <div class="cards">
        <!-- boucle -->

        <?php
        for ($i=0; $i<count($enregistrements); $i++)
        {
          if($enregistrements[$i]['pseudo']=='')
          {
        ?>
            <div class="card">
              <div class="card-body">
                <h5 class="card-title"><?php echo $enregistrements[$i]['titre'];?></h5>
                <p class="card-text">
                  AGE : <?php echo $enregistrements[$i]['tranche_age'] ?> <br>
                  DUREE : <?php echo transforme($enregistrements[$i]['duree']);?><br>
                  THEME : <?php echo $enregistrements[$i]['nom'] ?><br>
                </p>
              </div>
              <div>
                <a href="detail-fiche.php?id=<?php echo $enregistrements[$i]['id'] ?>" class="btn btn-primary rounded-pill espace">Consulter</a>
              </div>
              </div>
          <?php
           }
           else
           { ?>
               <div class="card">
                 <div class="card-body">
                   <h5 class="card-title"><?php echo $enregistrements[$i]['titre']." (@". $enregistrements[$i]['pseudo'].")";?></h5>
                   <p class="card-text">
                     AGE : <?php echo $enregistrements[$i]['tranche_age'] ?> <br>
                     DUREE : <?php echo transforme($enregistrements[$i]['duree']); ?><br>
                     THEME : <?php echo $enregistrements[$i]['nom'] ?><br>
                   </p>
                 </div>
                 <div>
                   <a href="detail-fiche.php?id=<?php echo $enregistrements[$i]['id'] ?>" class="btn btn-primary rounded-pill color">Consulter</a>
                 </div>
                 </div>
                 <?php
                }

            } ?>

        </div>

      <?php
    }
  }
  ?>

</main>



<?php include "fin-page.inc.php"; ?>
