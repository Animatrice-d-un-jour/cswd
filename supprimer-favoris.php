<?php
session_start();
require_once("connexion_base.php");
?>
<!DOCTYPE html>
<html lang="fr">

  <?php
  if (isset($_GET['id'])) {
    $id=$_GET['id'];
  }
  $requete="DELETE FROM projet_membre_fiche WHERE projet_membre_fiche.id_fiche=$id;";
  $reponse = $pdo->prepare($requete);
  $reponse->execute();
  header("location:favoris.php");
  ?>
<html>
