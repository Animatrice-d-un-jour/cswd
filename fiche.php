<?php
require_once("connexion_base.php");
if(!empty($_GET['id']))
{
  $id = $_GET['id'];
}

if (isset($_GET['n'])) // Ce paramètre est spécifié ?
{
 $n = $_GET['n']; // Récupération de paramètres de type $_GET
 $requete = "SELECT projet_fiche.*,tranche_age, projet_theme.nom FROM projet_fiche,projet_age,projet_theme WHERE projet_fiche.id_age = projet_age.id AND projet_fiche.id_theme = projet_theme.id AND id_type=? AND id_age=? AND validation=? AND pseudo ='';";
 $reponse = $pdo->prepare($requete);
 $reponse->execute(array($id,$n,1));
 // récupérer tous les enregistrements dans un tableau
 $enregistrements = $reponse->fetchAll();
 // connaitre le nombre d'enregistrements
 $nombreReponses = count($enregistrements);
 // parcourir le tableau des enregistrements
 if($id==1)
 {
   $donnees['titre_page'] = "Jeux ".$enregistrements[0]['tranche_age'];
  }
  else if($id==2)
  {
    $donnees['titre_page'] = "Activités ".$enregistrements[0]['tranche_age'];
  }
 }

else
{
  $requete = "SELECT projet_fiche.*,tranche_age,nom FROM projet_fiche,projet_age,projet_theme WHERE projet_fiche.id_age = projet_age.id AND projet_fiche.id_theme = projet_theme.id AND id_type=? AND validation=? AND pseudo ='';";
  $reponse = $pdo->prepare($requete);
  $reponse->execute(array($id,1));
  // récupérer tous les enregistrements dans un tableau
  $enregistrements = $reponse->fetchAll();
  // connaitre le nombre d'enregistrements
  $nombreReponses = count($enregistrements);
  // parcourir le tableau des enregistrements
  if($id==1)
  {
    $donnees['titre_page'] = "Tous les jeux ";
   }
   else if($id==2)
   {
     $donnees['titre_page'] = "Toutes les activités ";
   }
}

include "debut-page.inc.php";
?>

<main class="fiches">

  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="index.php">Accueil</a></li>
      <li class="breadcrumb-item active" aria-current="page">
        <?php
        if($id==1)
        {
          echo "Jeux";
         }
         else if($id==2)
         {
           echo "Activités";
         }
         ?>
      </li>
    </ol>
  </nav>


  <?php
  if (isset($_GET['id']) && isset($_GET['n']))
   {
     if($id==1)
     {
       echo "<h2>Jeux ".$enregistrements[0]['tranche_age']."</h2>";
      }
      else if($id==2)
      {
        echo "<h2>Activités ".$enregistrements[0]['tranche_age']."</h2>";
      }
    }
    else
    {
      if($id==1)
      {
        echo "<h2>Tous les jeux</h2>";
       }
       else if($id==2)
       {
         echo "<h2>Toutes les activités</h2>";
       }
    } ?>

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
          <a href="detail-fiche?id=<?php echo $enregistrements[$i]['id'] ?>" class="btn btn-primary rounded-pill espace">Consulter</a>
        </div>
        </div>
        <?php
       } ?>
      </div>


      <?php

      if (isset($_GET['n'])) // Ce paramètre est spécifié ?
      {
       $requete = "SELECT projet_fiche.*,tranche_age, projet_theme.nom FROM projet_fiche,projet_age,projet_theme WHERE projet_fiche.id_age = projet_age.id AND projet_fiche.id_theme = projet_theme.id AND id_type=? AND id_age=? AND validation=? AND pseudo !='';";
       $reponse = $pdo->prepare($requete);
       $reponse->execute(array($id,$n,1));
       // récupérer tous les enregistrements dans un tableau
       $enregistrements = $reponse->fetchAll();
       // connaitre le nombre d'enregistrements
       $nombreReponses = count($enregistrements);
       // parcourir le tableau des enregistrements
       }

      else
      {
        $requete = "SELECT projet_fiche.*,tranche_age,nom FROM projet_fiche,projet_age,projet_theme WHERE projet_fiche.id_age = projet_age.id AND projet_fiche.id_theme = projet_theme.id AND id_type=? AND validation=? AND pseudo !='';";
        $reponse = $pdo->prepare($requete);
        $reponse->execute(array($id,1));
        // récupérer tous les enregistrements dans un tableau
        $enregistrements = $reponse->fetchAll();
        // connaitre le nombre d'enregistrements
        $nombreReponses = count($enregistrements);
        // parcourir le tableau des enregistrements
      }

      if ($nombreReponses > 0)
      {
        echo "<h3>Vos idées</h3>";?>

        <div class="cards">
          <!-- boucle -->
          <?php
          for ($i=0; $i<count($enregistrements); $i++)
          {
          ?>
          <div class="card">
            <div class="card-body">
              <h5 class="card-title"><?php echo $enregistrements[$i]['titre']." (@". $enregistrements[$i]['pseudo'].")";?></h5>
              <p class="card-text">
                AGE : <?php echo $enregistrements[$i]['tranche_age'] ?> <br>
                DUREE : <?php echo $enregistrements[$i]['duree'] ?><br>
                THEME : <?php echo $enregistrements[$i]['nom'] ?><br>
              </p>

            </div>
            <div>
              <a href="detail-fiche?id=<?php echo $enregistrements[$i]['id'] ?>" class="btn btn-primary rounded-pill color">Consulter</a>
            </div>
            </div>
            <?php
           } ?>
          </div>
       <?php
        } ?>

  </main>



  <?php include "fin-page.inc.php"; ?>
