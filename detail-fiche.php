<?php
require_once("connexion_base.php");
session_start();

$id = $_GET['id']; // Récupération de paramètres de type $_GET

$requete = "SELECT projet_fiche.*,tranche_age,nom FROM projet_fiche,projet_age,projet_theme WHERE projet_fiche.id_age = projet_age.id AND projet_fiche.id_theme = projet_theme.id AND projet_fiche.id = ?;";
$reponse = $pdo->prepare($requete);
$reponse->execute(array($id));
// récupérer tous les enregistrements dans un tableau
$enregistrements = $reponse->fetchAll();
// connaitre le nombre d'enregistrements
$nombreReponses = count($enregistrements);
// parcourir le tableau des enregistrements
$donnees['titre_page'] =  $enregistrements[0]['titre'];

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
      <li class="breadcrumb-item active" aria-current="page"><?php echo $enregistrements[0]['titre']?></li>
    </ol>
  </nav>

  <div class="fav-tit">
    <div class="title">
      <h1 class= "title2"> <?php echo $enregistrements[0]['titre']?> </h1>
      <?php if ($enregistrements[0]['pseudo']!='')
      {
        $pseudo = $enregistrements[0]['pseudo'];
        echo "<h2 class=\"title2\">(@$pseudo)</h2>";
      }?>
    </div>
    <div>
    <!--début mécanisme formulaire-->
    <?php if(isset($_SESSION['id_projet_membre']))
      { $id_membre = $_SESSION['id_projet_membre'];
      ?>
        <form class="d-flex" action="#" method="post">
          <input type="hidden" name="fiche" value="<?php echo $id ?>">
          <input type="hidden" name="membre" value="<?php echo $id_membre ?>">
          <button type="submit" class = "coeur"><svg xmlns="http://www.w3.org/2000/svg" width="35" height="35" fill="currentColor" class="bi bi-heart" viewBox="0 0 16 16" id="heart1">
          	<path d="m8 2.748-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01L8 2.748zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143c.06.055.119.112.176.171a3.12 3.12 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15z" />
          	</svg>
        	</button>
        </form>

        <?php
        //si la personne clique sur le bouton favoris
        if (isset( $_POST['fiche']) AND isset( $_POST['membre']))
        {
          $fiche = $_POST['fiche'];
          $membre = $_POST['membre'];

          //regarder si l'enregistrement existe déjà
          $requete = "SELECT * FROM projet_membre_fiche WHERE id_membre=? AND id_fiche = ?;";
          $reponse = $pdo->prepare($requete);
          $reponse->execute(array($membre, $fiche));
          // récupérer tous les enregistrements dans un tableau
          $favoris = $reponse->fetchAll();
          // connaitre le nombre d'enregistrements
          $nombreReponses = count($favoris);
          // parcourir le tableau des enregistrements

          //si l'enregistrement n'existe pas, c'est à dire si la personne n'a pas encore mis l'activité en favoris
          if ($nombreReponses==0)
          {
            $requete="INSERT INTO projet_membre_fiche (id_membre,id_fiche)
            VALUES (?, ?)";
            $reponse=$pdo->prepare($requete);
            $reponse->execute(array($membre, $fiche));
          }

        }
      }
      else {
      ?>
        <a href="inscription-formulaire.php" id="fafa">
          <svg xmlns="http://www.w3.org/2000/svg" width="35" height="35" fill="currentColor" class="bi bi-heart" viewBox="0 0 16 16" id="heart2">
          <path d="m8 2.748-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01L8 2.748zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143c.06.055.119.112.176.171a3.12 3.12 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15z"/>
          </svg>
        </a>
   <?php } ?>
   <!--fin mécanisme formulaire-->
    </div>
  </div>
  <div class="row" id="olive">
    <div class="col">
      <h5 class="theme"> THEME : <?php echo $enregistrements[0]['nom'] ?></h5>
    </div>
    <div class="col">
      <h5 class="age"> AGE : <?php echo $enregistrements[0]['tranche_age'] ?></h5>
    </div>
    <div class="col">
      <h5 class="duree">DUREE : <?php echo transforme($enregistrements[0]['duree']); ?></h5>
    </div>
  </div>

  <div class="row">

    <?php
    if (file_exists("images/activites/".$enregistrements[0]['id'].".jpg"))
    {?>
        <div class="col" id ="image-activite">
          <img src="images/activites/<?php echo $enregistrements[0]['id'] ?>.jpg" class="rounded-pill" alt="activité-<?php echo $enregistrements[0]['id'] ?>" width="250">
        </div>

        <div class="col">
          <h5 class="materiel"> Vous avez besoin de : </h5>
          <?php echo $enregistrements[0]['materiel']?>
        </div>
    <?php
    }
    else
    {?>
      <div class="row">
        <div class="col">
          <h5 class="materiel2"> Vous avez besoin de : </h5>
          <?php echo $enregistrements[0]['materiel']?>
        </div>
      </div>
      <?php
    } ?>
  </div>

  <div class="row">
    <div class="col">
      <h5 class="deroulement"> Déroulement de l'activité : </h5>
      <?php echo $enregistrements[0]['deroulement']?>
    </div>
  </div>
  <!-- les images des membres -->
  <div id="fofot">
    <h4 class="gris">Les résultats de vos bouts de chou ! </h4>
    <?php
    $requete = "SELECT * FROM projet_photo WHERE id_fiche = ?  AND valide = ?;";
    $reponse = $pdo->prepare($requete);
    $reponse->execute(array($id,1));
    // récupérer tous les enregistrements dans un tableau
    $photos = $reponse->fetchAll();
    // connaitre le nombre d'enregistrements
    $nombreReponses = count($photos);
    // parcourir le tableau des enregistrements
    if ($nombreReponses > 0)
    {
    ?>
      <div class="photo">
     <?php
        for ($i=0; $i<count($photos); $i++)
        {
          if (file_exists("images/images-ajoutées/activité-".$photos[$i]['id'].".jpg"))
          {?>
            <div class="dernier_post">
              <img src="images/images-ajoutées/activité-<?php echo $photos[$i]['id']; ?>.jpg" height="100" class="rounded" alt="activité-<?php echo $photos[$i]['id']; ?>">
            </div>
          <?php
          }
        }?>
      </div>
    <?php
    }
    else
    {
      echo "<p>Il n'y a pas encore de photos. Soyez la première personne à poster le chef d'oeuvre de votre enfant !</p>";
      if (empty($_SESSION['id_projet_membre']))
      {
        echo "<p>Créer un compte : <a href=\"inscription-formulaire.php\">S'inscrire</a></p>";
      }
    }?>
    <div class="row" id="photo_form">
      <div class="col">
        <?php if(isset($_SESSION['id_projet_membre']))
            {?>
              <div>
                <form action="ajouter-photo.php" enctype="multipart/form-data" method="post">
                  <div class="input-group">
                    <input type="file" class="form-control" id="inputGroupFile04" aria-describedby="inputGroupFileAddon04" aria-label="Upload" name="fichier">
                    <input type="hidden" name="MAX_FILE_SIZE" value="3000000" />
                    <input type="hidden" name="fiche" value="<?php echo $id; ?>">
                    <button class="btn btn-primary" type="submit" id="inputGroupFileAddon04">Envoyer</button>
                  </div>
                </form>
              </div>
              <?php
            } ?>
      </div>
    </div>
  </div>


  <div class="row" id="comcom">
    <div class="col">
      <h4 class="gris">Commentaires</h4>
      <?php
      // exécuter une requete MySQL
      $requete = "SELECT projet_commentaire.*,pseudo FROM projet_commentaire, projet_membre WHERE projet_commentaire.id_membre=projet_membre.id AND valide=? AND id_fiche = ?;";
      $reponse = $pdo->prepare($requete);
      $reponse->execute(array(1,$id));
      // récupérer tous les enregistrements dans un tableau
      $enregistrements = $reponse->fetchAll();
      // connaitre le nombre d'enregistrements
      $nombreReponses = count($enregistrements);
      // parcourir le tableau des enregistrements
      if ($nombreReponses==0)
      {
        echo "<p>Soyez la première personne à écrire un commentaire !</p>";
      }
      else
      {?>
        <table class="table" id="table-com">
          <thead>
            <tr>
              <th>Pseudo</th>
              <th>Titre</th>
              <th>Commentaire</th>
              <th>Date</th>
            </tr>
          </thead>
          <tbody>
            <?php
            for ($i=0; $i<count($enregistrements); $i++)
            {
            ?>
              <tr>
                <td><?php echo "@".$enregistrements[$i]['pseudo'];?></td>
                <td> <?php echo $enregistrements[$i]['titre'];?> </td>
                <td> <?php echo $enregistrements[$i]['texte'];?> </td>
                <td> <?php echo $enregistrements[$i]['date'];?> </td>
              </tr>
            <?php
            }
            ?>
          </tbody>
        </table>
      <?php
      } ?>
    </div>
  </div>

    <?php if(isset($_SESSION['id_projet_membre']))
      {?>
          <div class="row">
            <div class="col">
              <div class="formulaire_question">
                <h6 id="gras">Alors ? Qu'est-ce que vous en avez pensé ? </h6>
                <form action="ajouter-commentaire-fiche.php" method="post">
                  <div class="form-floating mb-3">
                    <input type="text" class="form-control" placeholder="Titre" required="required" id="titre" name="titre">
                    <label for="titre">Titre</label>
                  </div>
                  <div class="form-floating mb-3">
                    <textarea class="form-control" placeholder="Votre commentaire" id="commentaire" required="required" name="commentaire"></textarea>
                    <label for="commentaire">Votre commentaire</label>
                  </div>
                  <input type="hidden" name="fiche" value="<?php echo $id; ?>">
                  <div class="col-auto">
                    <button type="submit" class="btn btn-primary rounded-pill">Envoyer</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
      <?php 
      } 
      else {
            echo "<p>Créez un compte pour laisser un commentaire : <a href=\"inscription-formulaire.php\">S'inscrire</a></p>";
          }?>

</main>

<?php include "fin-page.inc.php"; ?>
