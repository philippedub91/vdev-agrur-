<?php
session_start();

//Importe la connexion à la base de données
include('../src/bdd_connect.php'); 
?>


<!DOCTYPE html>
<html lang="fr">
<head>
  <title>Commander</title>
  <?php include('../common/head.php'); ?>
</head>

<body>
  <header>
    <?php include('../common/header.php'); ?>
  </header>

  <div data-role="header">
    <img id="logo-min" src="../images/logo.png" height="40" align="absmiddle" style="float:left;">
    <a href="#" data-icon="arrow-l" data-rel="back" data-iconpos="notext" data-shadow="true" data-iconshadow="true" data-transition="slidefade" class="ui-icon"></a>
    <h1>Commander</h1>
  </div>

  <div class="main-container">
    <div class="sub-container">

      <!--Résumé de la commande-->
      <div class="ui-corner-all custom-corners">
        <div class="ui-bar ui-bar-b">
          <h3>Votre commande pas à pas :</h3>
        </div>
        <div class="ui-body ui-body-c">
          <table>
            <tr>
              <td><b>Variété sélectionnée : </b></td>
              <td><?php echo($_GET['variete']); ?></td>
            </tr>
          </table>
        </div>
      </div>

      <h1>2. Sélectionner un type de produit :</h1>

      <p>Veuillez choisir un type de produit : </p>

      <ul data-role="listview">
        <li><a href="commander_select_calibre.php">Entière fraiche</a></li>
        <li><a href="commander_select_calibre.php">Entière sèche</a></li>
      </ul>
      
    </div>
  </div>
</body>
</html>
