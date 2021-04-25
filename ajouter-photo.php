<?php require_once("connexion_base.php"); ?>

<?php
if (!empty($_POST['legende']))
{
    $nom = $_POST['legende'];
    // exécuter une requete MySQL de type INSERT
    $requete="INSERT INTO projet_photo (id_membre, id_fiche, legende, valide) VALUES (?,NOW())";
    $reponse=$pdo->prepare($requete);
    $reponse->execute(array($nom));
    echo "<p>L'oeuvre de votre enfant a été ajoutée.</p>";
    echo "<p>Merci de votre contribution à bientôt sur Fun Kids</p>";

    $dernier_id = $pdo->lastInsertId();
    
    if(!empty($_FILES['fichier']['tmp_name']))
    {
        $size = getimagesize($_FILES['fichier']['tmp_name']);
        print_r($size);
        echo "Filetype : ".$size['mime'];
        if ($size['mime'] == "image/jpeg")
        {
            $uploaddir = $_SERVER['DOCUMENT_ROOT']."/cswd/projet/projet/images-ajoutées";
            $uploadfile = "activité-".$dernier_id.".jpg";
            if (move_uploaded_file($_FILES['fichier']['tmp_name'], $uploaddir.$uploadfile))
            {
            echo "<p>Votre image de l'activité a bien été ajoutée : ".$uploadfile."</p>";
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
