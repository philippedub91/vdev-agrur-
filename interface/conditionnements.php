<?php
session_start();

//Importe le fichier de fonctions
include('../src/fonctions_traitement.php');

sessionVerif('GEST'); //Vérifie les autorisations de l'utilisateur
?>


<!DOCTYPE html>
<html lang="fr">
<head>
  <title>Conditionnements</title>
  <?php include('../common/head.php'); ?>
  <?php include('../src/bdd_connect.php'); ?>
</head>

<body>
  <header>
    <?php include('../common/header.php'); ?>
  </header>

  <div data-role="header">
    <a href="#" data-rel="back" data-icon="arrow-l" data-iconpos="notext" data-shadow="true" data-iconshadow="true" data-transition="slidefade" class="ui-icon"></a>
    <h1>Conditionnements</h1>
  </div>

  <div class="main-container">
      <div class="sub-container">
        <p>
          Voici la liste des conditionnements. Vous pouvez en ajouter
          <a href="#popupAjouter" data-rel="popup" data-position-to="window" data-transition="pop">en cliquant ici</a>.
        </p>
          
        <ul data-role="listview" data-inset="true">
          <?php listeConditionnements(); ?>
        </ul>

        <!--Fenêtre modale d'ajout de conditionnement-->
        <div data-role="popup" id="popupAjouter" data-theme="c" class="ui-corner-all">
          <div data-role="header" data-theme="c">
            <h1>Ajouter un conditionnement</h1>
          </div>
          <div role="main" class="ui-content">
            <form method="POST" action="../src/src_conditionnements.php" data-ajax="false">
              <label for="txt_conditionnement">Libellé :</label>
              <input type="text" name="txt_conditionnement" placeholder!"ex: Filet">

              <label for="txt_poids">Poids</label>
              <input type="text" name="txt_poids" placeholder!"ex: 1000g">
            
              <input type="submit" class="ui-btn ui-corner-all ui-shadow ui-btn-inline ui-btn-b" value="Ajouter">
            </form>
          </div>

        </div>
      </div>
  </div>
</body>
</html>
