<?php
session_start();
require_once("connexion_base.php");

$...['...'] = "...";                              // ici il faudra remplacer en fonction de notre doc connexion_base //
$...['...'] = "...";                              // ici il faudra remplacer en fonction de notre doc connexion_base //

include "debut-page.inc.php";
?>

<main>
    <h1> </h1>                                    // titre de l'activité qui evolue d'une page à l'autre//

    <section>
      <article> Thème = ... </article>
      <article> Tranche d'âge = ... </article>
      <article> Temps estimé = ... </article>
    </section>

    <section>
      <article>
        <img src=" " width=" " height=" " />    // image de l'activité qui evolue d'une page à l'autre//
      </article>
      <article>
        Matériel:
        <ul>
          <li> </li>
          <li> </li>
          <li> </li>
          <li> </li>
          <li> </li>
          <li> </li>
        </ul>
      </article>
    </section>

    <table>
      <tr>
       <th>Etape</th>
       <th>Déroulement</th>
      </tr>
      <tr>
        <td>1</td>
        <td>...</td>
       </tr>
       <tr>
        <td>2</td>
        <td>...</td>
       </tr>
       <tr>
         <td>3</td>
         <td>...</td>
       </tr>
       <tr>
         <td>3</td>
         <td>...</td>
       </tr>
       <tr>
         <td>3</td>
         <td>...</td>
       </tr>
       <tr>
         <td>3</td>
         <td>...</td>
       </tr>
       <tr>
         <td>4</td>
         <td>...</td>
       </tr>
       <tr>
         <td>5</td>
         <td>...</td>
       </tr>
    </table>

    Les résultats de vos bouts de chou:
                                                  // donc là si je ne me trompes pas, il faut faire du php... //

    Vos commentaires et remarques sur l'activité ci-dessus:

    <table>                                       // à compléter avec du php comme au td 6 + formulaire
      <tr>
        <td>...</td>
        <td>...</td>
      </tr>
      <tr>
        <td>...</td>
        <td>...</td>
      </tr>
    </table>

</main>

<?php include "fin-page.inc.php"; ?>
