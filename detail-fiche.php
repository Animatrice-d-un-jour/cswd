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
                <h5 class="duree">
                  DUREE : <?php echo transforme($enregistrements[0]['duree']); ?>
                </h5>
            </div>
          </div>
          <div class="row">

              <?php
              if (file_exists("images/activites/".$enregistrements[0]['id'].".jpg"))
                {?>
                  <div class="col" id ="image-activite">
                  <img src="images/activites/<?php echo $enregistrements[0]['id'] ?>.jpg" class="rounded-pill" alt="activité-<?php echo $enregistrements[0]['id'] ?>" width="250px">
                  </div>

                  <div class="col">
                    <h5 class="materiel"> Vous avez besoin de : </h5>
                      <?php echo $enregistrements[0]['materiel']?>
                  </div>
                <?php
              }
              else
              {?>
                <div class="row">
                  <div class="col">
                    <h5 class="materiel2"> Vous avez besoin de : </h5>
                      <?php echo $enregistrements[0]['materiel']?>
                  </div>
                </div>
                <?php
              } ?>

            <div class="row">
              <div class="col">
                <h5 class="deroulement"> Déroulement de l'activité : </h5>
                <?php echo $enregistrements[0]['deroulement']?>
              </div>
            </div>

            <!-- Faire afficher toutes les images déposées par les membres -->
              <h5>Les résultats de vos bouts de chou :</h5>

            <?php if(isset($_SESSION['id_projet_membre']))
            {?>
                <div class="row">
                  <div class="col">
                    <div class="formulaire_question">
                    <form action="ajouter-photo.php" enctype="multipart/form-data" method="post">
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
              <?php
            } ?>
            </div>


            <div class="row">
              <div class="col">
                <h5>Commentaires</h5>
                <?php
                // exécuter une requete MySQL
                $requete = "SELECT projet_commentaire.*,pseudo FROM projet_commentaire, projet_membre WHERE projet_commentaire.id_membre=projet_membre.id AND valide=? AND id_fiche = ?;";
                $reponse = $pdo->prepare($requete);
                $reponse->execute(array(1,$id));
                // récupérer tous les enregistrements dans un tableau
                $enregistrements = $reponse->fetchAll();
                // connaitre le nombre d'enregistrements
                $nombreReponses = count($enregistrements);
                // parcourir le tableau des enregistrements
                if ($nombreReponses==0)
                {
                  echo "<p>Soyez la première personne à écrire un commentaire !</p>";
                }
                else
                {
                for ($i=0; $i<count($enregistrements); $i++)
                {
                ?>
                      <table class="table" id="table-com">
                        <thead>
                          <tr>
                            <th>Pseudo</th>
                            <th>Titre</th>
                            <th>Commentaire</th>
                            <th>Date</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <td><?php echo $enregistrements[$i]['pseudo'];?></td>
                            <td> <?php echo $enregistrements[$i]['titre'];?> </td>
                            <td> <?php echo $enregistrements[$i]['texte'];?> </td>
                            <td> <?php echo $enregistrements[$i]['date'];?> </td>
                          </tr>
                        </tbody>
                      </table>
                  <?php
                } ?>
              </div>
            </div>
          <?php
          } ?>

            <?php if(isset($_SESSION['id_projet_membre']))
            {?>
            <div class="row">
              <div class="col">
                <div class="formulaire_question">
                <h6 id="gras">Alors? Qu'est-ce que vous en avez pensé ? </h6>
                <form action="ajouter-commentaire-fiche.php" method="post">
                    <div class="form-floating mb-3">
                      <input type="text" class="form-control" placeholder="Titre" required="required" id="titre" name="titre">
                      <label for="titre">Titre</label>
                    </div>
                    <div class="form-floating mb-3">
                      <textarea class="form-control" placeholder="Votre commentaire" id="commentaire" required="required" name="commentaire"></textarea>
                      <label for="commentaire">Votre commentaire</label>
                    </div>
                    <input type="hidden" name="fiche" value="<?php echo $id; ?>"
                    <div class="col-auto">
                    <button type="submit" class="btn btn-primary rounded-pill">Envoyer</button>
                  </div>
                </form>
                </div>
                </form>
              </div>
            </div>
          <?php } else {
            echo "<p>Créez un compte pour laisser un commentaire : <a href=\"inscription-formulaire.php\">S'inscrire</a></p>";
          }?>
          </div>
        </div>

        </main>

<?php include "fin-page.inc.php"; ?>
