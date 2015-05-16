<?php
session_start();

//Importe le fichier de fonctions
include('../src/fonctions_traitement.php');

sessionVerif('PROD'); //Vérifie les autorisations de l'utilisateur
?>


<!DOCTYPE html>
<html lang="fr">
<head>
  <title>Mes certifications</title>
  <?php include('../common/head.php'); ?>
  <?php include('../src/bdd_connect.php'); ?>
</head>

<body>
  <header>
    <?php include('../common/header.php'); ?>
  </header>

  <div data-role="header">
    <a href="#" data-rel="back" data-icon="arrow-l" data-iconpos="notext" data-shadow="true" data-iconshadow="true" data-transition="slidefade" class="ui-icon"></a>
    <h1>Mes certifications</h1>
  </div>

  <div class="main-container">
    <div class="sub-container">

      <p>
        Voici la liste des certifications que vous avez obtenues.
      </p>

      <div class="ui-corner-all custom-corners">
        <div class="ui-bar ui-bar-c">
          <h3>Mes certifications</h3>
        </div>
        <div class="ui-body ui-body-c">
          <ul data-role="listview">
            <?php afficherCertificationsProducteur($_SESSION['num_prod']); ?>
          </ul>
        </div>
      </div>

    </div>
  </div>
</body>
</html>
