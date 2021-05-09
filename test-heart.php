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
      <li class="breadcrumb-item"><a href="activité.php">Activités</a></li>
      <li class="breadcrumb-item active" aria-current="page"><?php echo $enregistrements[0]['titre']?></li>
    </ol>
  </nav>

    <h1 class= "title"> <?php echo $enregistrements[0]['titre']?> </h1>

    <!--formulaire pour mettre en favoris (on peut mettre un if, formulaire ne s'affiche que si variable de session existe sinon, le coeur est un lien renvoyant vers la page d'inscription)-->
    <form class="d-flex" action="" method="post">
      <input type="hidden" name="fiche" value="<?php echo $id ?>">
      <!-- remplacer la valeur du dessous par la variable de session-->
      <input type="hidden" name="membre" value="1">
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

     ?>

     <script type="text/javascript">
     document.getElementsById("heart1").addEventListener("click", change)
     function change()
     {
       document.getElementsById("heart1").innerHTML =
     }

     </script>

    <div class="container">
      <div class="row">
        <div class="col">
            <h5 class="theme"> THEME : <?php echo $enregistrements[0]['nom'] ?></h5>
        </div>
        <div class="col">
            <h5 class="age"> AGE : <?php echo $enregistrements[0]['tranche_age'] ?></h5>
        </div>
        <div class="col">
            <h5 class="duree"> DUREE : <?php echo $enregistrements[0]['duree'] ?></h5>
        </div>
      </div>
      <div class="row">
        <div class="col">
          <img src="activités/<?php echo $enregistrements[0]['id'] ?>.jpg" class="rounded-pill" width="500" height="350" id="activités">
        </div>
        <div class="col">
          <h5 class="materiel"> Vous avez besoin de: </h5>
            <?php echo $enregistrements[0]['materiel']?>
        </div>
      </div>
      <div class="row">
        <div class="col">
          <h6 class="deroulement"> Déroulement de l'activité: </h6>
          <?php echo $enregistrements[0]['deroulement']?>
        </div>
      </div>
      <div class="row">
        <div class="col">

          <div class="formulaire_question">
          <h6 id="gras">Les résultats de vos bouts de chou:</h6>
          <form action="ajouter-photo.php" enctype="multipart/form-data" method="post">
              <div class="form-floating mb-3">
                <input type="text" class="form-control" placeholder="Votre pseudo" required="required" id="pseudo" name="pseudo">
                <label for="pseudo">Votre pseudo</label>
              </div>
              <div class="form-floating mb-3">
                <input type="hidden" name="MAX_FILE_SIZE" value="3000000" required="required" />
                <input type="file" name="fichier" /><br />
              </div>
              <div class="col-auto">
              <button type="submit" class="btn btn-primary rounded-pill">Envoyer</button>
              </div>
            </div>
          </form>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col">
          <h6> Les commentaires des internautes:</h6>
          //inclure les commentaires!
        </div>
      </div>
      <div class="row">
        <div class="col">
          <div class="formulaire_question">
          <h6 id="gras">Voici le formulaire pour laisser votre commentaire</h6>
          <form action="ajouter-commentaire-activité.php" method="post">
              <div class="form-floating mb-3">
                <input type="text" class="form-control" placeholder="Votre pseudo" required="required" id="pseudo" name="pseudo">
                <label for="pseudo">Votre pseudo</label>
              </div>
              <div class="form-floating mb-3">
                <input type="text" class="form-control" id="commentaire" placeholder="Votre commentaire" required="required" name="commentaire">
                <label for="commentaire">Votre commentaire</label>
              </div>
              <div class="col-auto">
              <button type="submit" class="btn btn-primary rounded-pill">Envoyer</button>
            </div>
          </form>
          </div>
          </form>
        </div>
      </div>
    </div>

</main>

<?php include "fin-page.inc.php"; ?>
