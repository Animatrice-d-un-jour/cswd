<?php session_start();
require_once("connexion_base.php");
$donnees['titre_page'] = "Récapitulatif photo";

$id_membre = $_SESSION['id_projet_membre'];
$fiche=$_POST['fiche'];

$requete = "SELECT projet_fiche.*FROM projet_fiche WHERE projet_fiche.id = ?;";
$reponse = $pdo->prepare($requete);
$reponse->execute(array($fiche));
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
       <li class="breadcrumb-item"><a href="detail-fiche.php?id=<?php echo $fiche ?>"><?php echo $enregistrements[0]['titre']; ?></a></li>
       <li class="breadcrumb-item active" aria-current="page">Récapitulatif photo</li>
     </ol>
   </nav>

 <h2>Récapitulatif</h2>

<?php
if (!empty($_POST['fiche']) AND !empty($_SESSION['id_projet_membre']))
{
    // exécuter une requete MySQL de type INSERT
    $requete="INSERT INTO projet_photo (id_membre, id_fiche, valide, date_ajout) VALUES (?,?,?,NOW())";
    $reponse=$pdo->prepare($requete);
    $reponse->execute(array($id_membre,$fiche,0));

    $dernier_id = $pdo->lastInsertId();

          if(!empty($_FILES['fichier']['tmp_name']))
          {
            $size = getimagesize($_FILES['fichier']['tmp_name']);

            if ($size['mime'] == "image/jpeg")
            {
              $uploaddir = $_SERVER['DOCUMENT_ROOT']."/cswd/projet/images/images-ajoutées/";
              $uploadfile = "activité-".$dernier_id.".jpg";
              if (move_uploaded_file($_FILES['fichier']['tmp_name'], $uploaddir.$uploadfile))
              {
                echo "<p>Le chef d'oeuvre de votre enfant a bien été ajouté : ".$uploadfile.".</p>";
                echo "<p>Merci pour votre participation !</p>";
                $titre = $enregistrements[0]['titre'];
                echo "<p>Retourner sur la page <a href=\"detail-fiche.php?id=$fiche\"> $titre </a></p>";
              }
              else
              {
                echo "<p> Oups... le problème vient de nous... </br> N'hésitez pas à réessayer d'ajouter votre image ^^ </p>";
                $titre = $enregistrements[0]['titre'];
                echo "<p>Retourner sur la page <a href=\"detail-fiche.php?id=$fiche\"> $titre </a></p>";
              }
            }
            else
            {
              echo "<p>Oups, ce n'est pas le bon type de fichier... </p>";
              echo "<p>Réessayez en sélectionnant une image au format <strong>".$size['mime']."</strong> !  </p>";
              $titre = $enregistrements[0]['titre'];
              echo "<p>Retourner sur la page <a href=\"detail-fiche.php?id=$fiche\"> $titre </a></p>";
            }
          }

          else
          {
            echo "<p>Pas de fichier spécifié.</br> Réessayez en sélectionnant une image.</p>";
            $titre = $enregistrements[0]['titre'];
            echo "<p>Retourner sur la page <a href=\"detail-fiche.php?id=$fiche\"> $titre </a></p>";
          }
        }
        ?>

 </main>

 <?php include "fin-page.inc.php";  ?>
