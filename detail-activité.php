<?php
require_once("connexion_base.php");

$id = $_GET['id']; // Récupération de paramètres de type $_GET

$requete = "SELECT projet_fiche.*,tranche_age,nom FROM projet_fiche,projet_age,projet_theme WHERE projet_fiche.id_age = projet_age.id AND projet_fiche.id_theme = projet_theme.id AND projet_fiche.id = $id;";
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
      <li class="breadcrumb-item"><a href="activité.php">Activités</a></li>
      <li class="breadcrumb-item active" aria-current="page"><?php echo $enregistrements[0]['titre']?></li>
    </ol>
  </nav>

    <h1 class= "title"> <?php echo $enregistrements[0]['titre']?> </h1>

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
