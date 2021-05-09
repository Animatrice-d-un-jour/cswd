<?php
require_once("connexion_base.php");
$donnees['titre_page'] = "FAQ";

$requete = "SELECT projet_question.*,contenu FROM projet_question, projet_reponse WHERE projet_question.id = projet_reponse.id_question AND valide = 1;";
$reponse = $pdo->prepare($requete);
$reponse->execute();
// récupérer tous les enregistrements dans un tableau
$enregistrements = $reponse->fetchAll();
// connaitre le nombre d'enregistrements
$nombreReponses = count($enregistrements);
// parcourir le tableau des enregistrements


include "debut-page.inc.php";
 ?>
<main class="fiches">
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="index.php">Accueil</a></li>
      <li class="breadcrumb-item active" aria-current="page">FAQ</li>
    </ol>
  </nav>

  <h2>Foire aux questions</h2>
  <p>Toutes les réponses à vos questions.</p>


    <div>
      <?php
      for ($i=0; $i<count($enregistrements); $i++)
      { ?>
        <div class="ask">
          <?php echo $enregistrements[$i]['texte']?> @<?php echo $enregistrements[$i]['pseudo']?>
        </div>
        <div class="answer">
          <?php echo $enregistrements[$i]['contenu'] ?>
        </div>
  <?php
   } ?>
  </div>



  <div class="formulaire_question">
    <p id="gras">Votre question n'est pas dans cette FAQ ?</p>
    <p>Dans ce cas, il vous suffit de remplir le formulaire ci-dessous et nous répondrons à votre question dans les plus brefs délais
    (veuillez remplir tous les champs).</p>
  <form action="ajouter-question.php" method="post">
      <div class="form-floating mb-3">
        <input type="text" class="form-control" placeholder="Votre pseudo" required="required" id="pseudo" name="pseudo">
        <label for="pseudo">Votre pseudo</label>
      </div>
      <div class="form-floating mb-3">
        <input type="email" class="form-control" placeholder="Votre adresse mail" required="required" id="email" name="email">
        <label for="email">Votre adresse mail</label>
      </div>
      <div class="form-floating mb-3">
        <input type="text" class="form-control" id="question" placeholder="Votre question" required="required" name="question">
        <label for="question">Votre question</label>
      </div>
      <div class="col-auto">
      <button type="submit" class="btn btn-primary rounded-pill">Envoyer</button>
    </div>
  </form>
  </div>


</main>

 <?php include "fin-page.inc.php"; ?>
