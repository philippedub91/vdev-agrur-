<?php
session_start();
?>


<!DOCTYPE html>
<html lang="fr">
<head>
  <title>Espace producteur</title>
  <?php include('../common/head.php'); ?>
</head>

<body>
  <header>
    <?php include('../common/header.php'); ?>
  </header>

  <div class="headline">
    <h1>Espace producteur</h1>
  </div>
  <div class="content-body">
      <h4>Bienvenue dans votre espace personnel <?php echo($_SESSION['prenom']); ?> ! </h4>

      
      <hr>

      <div data-role="controlgroup">
        <a href="commandes_producteur.php" class="ui-btn ui-corner-all"><img src="../images/icones/panier.png" height="50" style="margin-right:10px; float:left;" align="absmiddle"><span style="float:middle;">Mes commandes</span></a>
        <a href="profil_producteur.php" class="ui-btn ui-corner-all"><img src="../images/icones/profil.png" height="50" style="margin-right:10px; float:left;" align="absmiddle"><span style:"float:middle;">Mon profil</span></a>
        <a href="#" class="ui-btn ui-corner-all"><img src="../images/icones/truck.png" height="50" style="margin-right:10px; float:left;" align="absmiddle"><span style="float:middle;">Mes livraisons</span></a>
        <a href="vergers_producteur.php" class="ui-btn ui-corner-all"><img src="../images/icones/verger.png" height="50" style="margin-right:10px; float:left;" align="absmiddle"><span style="float:middle">Mes vergers</span></a>
        <a href="../src/session_destroy.php" class="ui-btn ui-corner-all"><img src="../images/icones/deconnexion.png" height="50" style="margin-right:10px; float:left;" align="absmiddle"><span style="float:middle;">Déconnexion</span></a>
      </div>
      
  </div>
</body>
</html>
