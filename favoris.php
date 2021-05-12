<?php
session_start();
require_once("connexion_base.php");
$donnees['titre_page'] = "Favoris";

include "debut-page.inc.php";
?>
<main class="fiches">

<h2>Vos favoris</h2>

<?php
  if (isset($_SESSION['id_projet_membre']))
  {
      $id_membre = $_SESSION['id_projet_membre'];
      $requete = "SELECT * FROM projet_membre_fiche WHERE  projet_membre_fiche.id_membre= ?;";
      $reponse = $pdo->prepare($requete);
      $reponse->execute(array($id_membre));
      // récupérer tous les enregistrements dans un tableau
      $enregistrements = $reponse->fetchAll();
      // connaitre le nombre d'enregistrements
      $nombreReponses = count($enregistrements);

      if ($nombreReponses==0)
      {
        echo "<p>Vous n'avez pas encore de favoris. N'hésitez pas à faire un tour pour sélectionner des activités et jeux ! </p>";
      }
      else
      {
        $requete = "SELECT projet_fiche.*,tranche_age,nom FROM projet_fiche,projet_age,projet_theme, projet_membre_fiche WHERE projet_fiche.id_age = projet_age.id AND projet_fiche.id_theme = projet_theme.id AND validation =? AND projet_membre_fiche.id_membre = ? AND projet_membre_fiche.id_fiche = projet_fiche.id;";
        $reponse = $pdo->prepare($requete);
        $reponse->execute(array(1,$id_membre));
        // récupérer tous les enregistrements dans un tableau
        $favoris = $reponse->fetchAll();
        // connaitre le nombre d'enregistrements
        $nombreReponses = count($favoris);
        // parcourir le tableau des enregistrements ?>

        <div class="cards">
          <!-- boucle -->

          <?php
          for ($i=0; $i<count($favoris); $i++)
          {
            if($favoris[$i]['pseudo']=='')
            {
          ?>
              <div class="card">
                <div class="card-body">
                  <h5 class="card-title"><?php echo $favoris[$i]['titre'];?></h5>
                  <p class="card-text">
                    AGE : <?php echo $favoris[$i]['tranche_age'] ?> <br>
                    DUREE : <?php echo $favoris[$i]['duree'] ?><br>
                    THEME : <?php echo $favoris[$i]['nom'] ?><br>
                  </p>
                </div>
                <div>
                  <a href="detail-fiche.php?id=<?php echo $favoris[$i]['id'] ?>" class="btn btn-primary rounded-pill espace">Consulter</a>
                  <a href="supprimer-favoris.php?id=<?php echo $favoris[$i]['id'] ?>" class="btn btn-danger rounded-pill espace"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
  <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
  <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
</svg></a>
                </div>
                </div>
            <?php
             }
             else
             { ?>
                 <div class="card">
                   <div class="card-body">
                     <h5 class="card-title"><?php echo $favoris[$i]['titre']." (@". $favoris[$i]['pseudo'].")";?></h5>
                     <p class="card-text">
                       AGE : <?php echo $favoris[$i]['tranche_age'] ?> <br>
                       DUREE : <?php echo $favoris[$i]['duree'] ?><br>
                       THEME : <?php echo $favoris[$i]['nom'] ?><br>
                     </p>
                   </div>
                   <div>
                     <a href="detail-fiche.php?id=<?php echo $favoris[$i]['id'] ?>" class="btn btn-primary rounded-pill color">Consulter</a>
                     <a href="supprimer-favoris.php?id=<?php echo $favoris[$i]['id'] ?>" class="btn btn-danger rounded-pill espace">
                       <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                         <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                         <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                       </svg>
                     </a>
                   </div>
                 </div>
                   <?php
                  }

              } ?>

          </div>
          <?php
        }
      }
      else
        {
          echo "<p>Veuillez tout d'abord vous créer un compte pour ajouter des activités et jeux en favoris.</p>";
          echo"<a href=\"inscription-formulaire.php\">S'inscrire</a>";
        }
      ?>
  </main>

<?php include "fin-page.inc.php"; ?>
