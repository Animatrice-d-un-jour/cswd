<?php
require_once("connexion_base.php");
$donnees['titre_page'] = "Récapitulatif photo";
$pseudo = $_POST['pseudo'];

include "debut-page.inc.php";
 ?>
<?php
if (!empty($_POST['pseudo']))
{
     $nom = $_POST['pseudo'];
    // exécuter une requete MySQL de type INSERT
    $requete="INSERT INTO projet_photo (id_membre, id_fiche, legende)  WHERE projet_photo.id_membre= projet_membre.id VALUES (?,NOW())";
    $reponse=$pdo->prepare($requete);
    $reponse->execute(array($nom));
    echo "<p>Le chef d'oeuvre de votre enfant a été ajouté.</p>";
    echo "<p>Merci pour votre participation, à bientôt sur Fun Kids!</p>";?>
    Vous allez revenir sur la page pricipale des <a href="fiche.php">Activités et jeux</a>

    <?php
    $dernier_id = $pdo->lastInsertId();

    if(!empty($_FILES['fichier']['tmp_name']))
    {
        $size = getimagesize($_FILES['fichier']['tmp_name']);
        print_r($size);
        echo "Filetype : ".$size['mime'];
        if ($size['mime'] == "image/jpeg")
        {
            $uploaddir = $_SERVER['DOCUMENT_ROOT']."/cswd/projet/images-ajoutées/";
            $uploadfile = "activité-".$dernier_id.".jpg";
            if (move_uploaded_file($_FILES['fichier']['tmp_name'], $uploaddir.$uploadfile))
            {
            echo "<p>L'activité a bien été ajouté : ".$uploadfile."</p>";
            }
            else
            {
            echo "<p>Probleme sur le serveur : ".$uploaddir."</p>";
            }
        }
        else
        {
            echo "<p>Pas le bon type de fichier : ".$size['mime']."</p>";
        }
    }
    else
    {
        echo "<p>Pas de fichier spécifié.</p>";
    }
}
?>
