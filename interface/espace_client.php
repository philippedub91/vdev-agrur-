<?php
session_start();
?>


<!DOCTYPE html>
<html lang="fr">
<head>
  <title>Espace client</title>
  <?php include('../common/head.php'); ?>
</head>

<body>
  <header>
    <?php include('../common/header.php'); ?>
  </header>

  <div data-role="header">
    <img id="logo-min" src="../images/logo.png" height="40" align="absmiddle" style="float:left;">
    <a href="#" data-icon="shop" data-iconpos="notext" data-shadow="true" data-iconshadow="true" data-transition="slidefade" class="ui-icon"></a>
    <h1>Espace client</h1>
  </div>

  <div class="main-container">
    <div class="sub-container">
      <h4 style="margin-left:10px; margin-right:10px;">Bienvenue dans votre espace personnel <?php echo($_SESSION['prenom']); ?> ! </h4>

      <div data-role="controlgroup">
        <a href="commander_client.php" class="ui-btn ui-corner-all"><img src="../images/icones/commander.png" height="50" style="margin-right:10px; float:left;" align="absmiddle"><span style="float:middle;">Commander</span></a>
        <a href="commandes_producteur.php" class="ui-btn ui-corner-all"><img src="../images/icones/panier.png" height="50" style="margin-right:10px; float:left;" align="absmiddle"><span style="float:middle;">Mes commandes</span></a>
        <a href="commandes_producteur.php" class="ui-btn ui-corner-all"><img src="../images/icones/profil.png" height="50" style="margin-right:10px; float:left;" align="absmiddle"><span style="float:middle;">Mon profil</span></a>
        <a href="../src/session_destroy.php" class="ui-btn ui-corner-all"><img src="../images/icones/deconnexion.png" height="50" style="margin-right:10px; float:left;" align="absmiddle"><span style="float:middle;">Déconnexion</span></a>
      </div>
    </div>
  </div>
</body>
</html>
