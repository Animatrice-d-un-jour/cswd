<?php
/*convertir minutes en heures*/
function transforme($duree)
{
    if ($duree>=60)
    {
        $heure = floor($duree/60);
        $minute = $duree%60;

        $result = $heure.'h'.$minute.'min ';
        return $result;
    }
    elseif ($duree < 60)
    {
        $result = $duree.'min';
        return $result;
    }
}
 ?>
<!doctype html>
<html lang="fr">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
  <link href="css/main.css" rel="stylesheet">
  <link rel="shortcut icon" href="images/favicon.ico" type="images/x-icon" />
  <title><?php echo $donnees['titre_page']; ?></title>
</head>

<body>
  <a href="#hautdepage" class="stick">
    <svg xmlns="http://www.w3.org/2000/svg" width="35" height="35" fill="currentColor" class="bi bi-arrow-up-circle-fill" viewBox="0 0 16 16" id="fleche">
      <path d="M16 8A8 8 0 1 0 0 8a8 8 0 0 0 16 0zm-7.5 3.5a.5.5 0 0 1-1 0V5.707L5.354 7.854a.5.5 0 1 1-.708-.708l3-3a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1-.708.708L8.5 5.707V11.5z" />
    </svg>
  </a>

  <header id="hautdepage">
    <!--- Première barre de navigation avec le logo et les icones favoris, compte -->
    <nav class="navbar navbar-light bg-white">
      <div class="container">

        <a class="navbar-brand" href="index.php">
          <!--- Image logo -->
          <img src="images/logo_5.png" height="80" alt="logo" id="logo">
        </a>
        <div class="icon">
          <div class="case" id="recherche">
            <form class="d-flex" action="recherche.php" method="post">
              <input class="form-control me-2 rounded-pill" type="search" placeholder="Recherche" aria-label="Search" name="mot">
              <button class="btn btn-primary rounded-pill" type="submit">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                  <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"></path>
                </svg>
                <span class="visually-hidden">Button</span>
              </button>
            </form>
          </div>

          <div class="picto">

            <div class="case">
              <a href="connexion.php">
                <!--- il faudra ajouter un lien -->
                <!--- Icone membre -->
                <svg xmlns="http://www.w3.org/2000/svg" width="35" height="35" fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16" id="people">
                  <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z" />
                  <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z" />
                </svg>
              </a>
            </div>
            <div class="case">
              <a href="favoris.php">
                <!--- il faudra ajouter un lien -->
                <!--- Icone coeur pour les favoris -->
                <svg xmlns="http://www.w3.org/2000/svg" width="35" height="35" fill="currentColor" class="bi bi-heart" viewBox="0 0 16 16" id="heart">
                  <path d="m8 2.748-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01L8 2.748zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143c.06.055.119.112.176.171a3.12 3.12 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15z" />
                </svg>
              </a>
            </div>
          </div>
        </div>
      </div>
    </nav>

    <!--- Deuxième barre de navigation avec les différentes pages -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white nav-fill">
      <div class="container-fluid">
        <!--- Menu hamburger -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">

            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                ACTIVITES
              </a>
              <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                <li><a class="dropdown-item" href="fiche.php?id=2&n=1">3-5 ans</a></li>
                <li><a class="dropdown-item" href="fiche.php?id=2&n=2">6-8 ans</a></li>
                <li><a class="dropdown-item" href="fiche.php?id=2&n=3">9-11 ans</a></li>
                <li><a class="dropdown-item" href="fiche.php?id=2">Tout</a></li>
              </ul>
            </li>

            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="coloriage.php">COLORIAGES</a>
            </li>

            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                JEUX
              </a>
              <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                <li><a class="dropdown-item" href="fiche.php?id=1&n=1">3-5 ans</a></li>
                <li><a class="dropdown-item" href="fiche.php?id=1&n=2">6-8 ans</a></li>
                <li><a class="dropdown-item" href="fiche.php?id=1&n=3">9-11 ans</a></li>
                <li><a class="dropdown-item" href="fiche.php?id=1">Tout</a></li>
              </ul>
            </li>

            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                THEMES
              </a>
              <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                <li><a class="dropdown-item" href="theme.php?n=1">Fin d'année/Hiver</a></li>
                <li><a class="dropdown-item" href="theme.php?n=3">Pâques/Printemps</a></li>
                <li><a class="dropdown-item" href="theme.php?n=4">Plage/Eté</a></li>
                <li><a class="dropdown-item" href="theme.php?n=5">Halloween/Automne</a></li>
              </ul>
            </li>

            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                A VOUS DE JOUER !
              </a>
              <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                <li><a class="dropdown-item" href="faq.php">FAQ</a></li>
                <li><a class="dropdown-item" href="idee.php">Boîte à idées</a></li>
              </ul>
            </li>

          </ul>
        </div>
      </div>
    </nav>
  </header>
