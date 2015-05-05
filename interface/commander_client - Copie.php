<?php
session_start();

//Importe la connexion à la base de données
include('../src/bdd_connect.php'); 
?>


<!DOCTYPE html>
<html lang="fr">
<head>
  <title>Finaliser votre commande</title>
  <?php include('../common/head.php'); ?>
</head>

<body>
  <header>
    <?php include('../common/header.php'); ?>
  </header>

  <div data-role="header">
    <img id="logo-min" src="../images/logo.png" height="40" align="absmiddle" style="float:left;">
    <a href="#" data-icon="arrow-l" data-rel="back" data-iconpos="notext" data-shadow="true" data-iconshadow="true" data-transition="slidefade" class="ui-icon"></a>
    <h1>Finaliser votre commande</h1>
  </div>

  <div class="main-container">
    <div class="sub-container">
      <div class="ui-corner-all custom-corners">
        <div class="ui-bar ui-bar-c">
          <h3>Sélection :</h3>
        </div>
        <div class="ui-body ui-body-c">
          <p>Sélection des conditionnements  :</p>
          <div class="ui-field-contain">
            <label for="qt_sachet_250">Sachet de 250g</label>
            <input type="range" name="qt_sachet_250" value="0" min="0" max="100" data-highlight="true">
          </div>

          <div class="ui-field-contain">
            <label for="qt_sachet_500">Sachet de 500g</label>
            <input type="range" name="qt_sachet_500" value="0" min="0" max="100" data-highlight="true">
          </div>

          <div class="ui-field-contain">
            <label for="qt_sachet_1000">Sachet de 1kg</label>
            <input type="range" name="qt_sachet_1000" value="0" min="0" max="100" data-highlight="true">
          </div>

          <div class="ui-field-contain">
            <label for="qt_filet_1000">Filet de 1 kg</label>
            <input type="range" name="qt_filet_1000" value="0" min="0" max="100" data-hightlight="true">
          </div>

          <div class="ui-field-contain">
              <label for="qt_filet_"
        </div>

        <

      </div>

    </div>
  </div>
</body>
</html>
