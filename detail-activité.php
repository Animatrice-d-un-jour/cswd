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

    <h5> THEME : </h5> <?php echo $enregistrements[0]['nom'] ?>
    <h5> AGE : </h5> <?php echo $enregistrements[0]['tranche_age'] ?>
    <h5> DUREE : </h5> <?php echo $enregistrements[0]['duree'] ?>

    <img src="activités/<?php echo $enregistrements[0]['id'] ?>.jpg" class="card-img-top" alt="..." id="activités">
    <h5> Vous avez besoin de:</h5>
    <?php echo $enregistrements[0]['materiel']?>
    <br>

    <h5> Déroulement de l'activité: </h5>
    <?php echo $enregistrements[0]['deroulement']?>
    <br>

    <h5> Les résultats de vos bouts de chou:</h5>
    // ajouter les résultats des internautes
    <br>

    <h5> Les commentaires des internautes:</h5>
    // ajouter les commentaires des internautes
    <br>

    <h5> Voici le formulaire pour laisser votre commentaire</h5>
    <div class="formulaire_question">
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
    <br>

</main>

<?php include "fin-page.inc.php"; ?>
