<?php
require_once("connexion_base.php");
$donnees['titre_page'] = "Vos idées";
include "debut-page.inc.php";

 ?>
 <main class="fiches">
   <nav aria-label="breadcrumb">
     <ol class="breadcrumb">
       <li class="breadcrumb-item"><a href="index.php">Accueil</a></li>
       <li class="breadcrumb-item active" aria-current="page">Boîte à idées</li>
     </ol>
   </nav>

   <h2>Boîte à idées</h2>


   <div class="formulaire_question">
     <p>Vous avez une idée géniale ? N'hésitez pas à nous en faire part !<br> Remplissez le formulaire ci dessous pour nous faire parvenir vos idées de jeux et d'activités. </p>

   <form action="ajouter-idee.php" method="post">

       <div class="form-floating mb-3">
         <input type="text" class="form-control" placeholder="Votre pseudo" required="required" id="pseudo" name="pseudo">
         <label for="pseudo">Votre pseudo</label>
       </div>
       <div class="form-floating mb-3">
         <input type="email" class="form-control" placeholder="Votre adresse mail" required="required" id="email" name="email">
         <label for="email">Votre adresse mail</label>
       </div>

     <div class="row g-2">

       <div class="col-md">
    <div class="form-floating">
      <select class="form-select" id="type" aria-label="Floating label select example" required="required" name="type">
        <option selected>Sélectionner</option>
        <option value="1">Jeu</option>
        <option value="2">Activité</option>
      </select>
      <label for="type">Type</label>
    </div>
  </div>

  <div class="col-md">
    <div class="form-floating">
      <select class="form-select" id="age" aria-label="Floating label select example" required="required" name="age">
        <option selected>Sélectionner</option>
        <option value="1">3-5 ans</option>
        <option value="2">6-8 ans</option>
        <option value="3">9-11 ans</option>
      </select>
      <label for="age">Tranche d'âge</label>
    </div>
  </div>

</div>

<div class="row g-2">
  <div class="col-md">
<div class="form-floating">
 <input type="text" class="form-control" id="duree" placeholder="Duree" name="duree" required="required">
 <label for="duree">Durée</label>
</div>
</div>
<div class="col-md">
<div class="form-floating">
 <select class="form-select" id="theme" aria-label="Floating label select example" required="required" name="theme">
   <option selected>Sélectionner</option>
   <option value="1">Fin d'année/Hiver</option>
   <option value="3">Pâques/Printemps</option>
   <option value="4">Plage/Eté</option>
   <option value="5">Halloween/Automne</option>
 </select>
 <label for="theme">Thème</label>
</div>
</div>
</div>

<div class="form-floating">
  <input type="text" class="form-control" id="titre" placeholder="Titre de l'activité" name="titre" required="required">
  <label for="titre">Titre de l'activité/jeu</label>
</div>

<div class="form-floating">
  <textarea class="form-control" placeholder="Matériel" id="floatingTextarea"  name="materiel"></textarea>
  <label for="floatingTextarea">Liste du matériel</label>
</div>

<div class="form-floating">
  <textarea class="form-control" placeholder="Déroulement" id="floatingTextarea2" required="required" name="deroulement"></textarea>
  <label for="floatingTextarea2">Déroulement</label>
</div>

<div class="col-auto">
<button type="submit" class="btn btn-primary rounded-pill" id="bouton_idee">Envoyer</button>
</div>

   </form>
   </div>
 </main>

<?php include "fin-page.inc.php"; ?>
