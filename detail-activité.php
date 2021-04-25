<?php
require_once("connexion_base.php");

$id = $_GET['id']; // Récupération de paramètres de type $_GET

$requete = "SELECT * FROM projet_fiche WHERE id = $id;";
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

    <h1> <?php echo $enregistrements[0]['titre']?> </h1>

    <div class="container">
      <div class="row">
        <div class="col">
          <h6> THEME : </h6> <?php echo $enregistrements[0]['nom'] ?>
        </div>
        <div class="col">
          <h6> AGE : </h6> <?php echo $enregistrements[0]['tranche_age'] ?>
        </div>
        <div class="col">
          <h6> DUREE : </h6> <?php echo $enregistrements[0]['duree'] ?>
        </div>
      </div>
      <div class="row">
        <div class="col">
          <img src="activités/<?php echo $enregistrements[0]['id'] ?>.jpg" width="400" height="400" id="activités">
        </div>
        <div class="col">
          <h6> Vous avez besoin de:</h6>
          <?php echo $enregistrements[0]['materiel']?>
        </div>
      </div>
      <div class="row">
        <div class="col">
          <h6> Déroulement de l'activité: </h6>
          <?php echo $enregistrements[0]['deroulement']?>
        </div>
      </div>
      <div class="row">
        <div class="col">
          <h6> Les résultats de vos bouts de chou:</h6>
            <form action="ajouter-photo.php" enctype="multipart/form-data" method="post">
            <input type="text" name="nom" /><br />
                <input type="hidden" name="MAX_FILE_SIZE" value="3000000" />
                <input type="file" name="fichier" /><br />
                <input type="submit" />
            </form>
        </div>
      </div>
      <div class="row">
        <div class="col">
          <h6> Les commentaires des internautes:</h6>
          // ajouter les commentaires des internautes
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

