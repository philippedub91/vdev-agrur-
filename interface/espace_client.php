<?php
session_start();

//Importe le fichier de fonctions
include('../src/fonctions_traitement.php');

sessionVerif('CLI'); //Vérifie les autorisations de l'utilisateur

###############

//Gestion des messages de succès et d'erreur
$erreur = ''; //Contiendra éventuellement le message d'erreur
$message = ''; //Contiendra éventuellement le message de succès
if(isset($_GET['err']))
{
  $erreur = addDecorum($_GET['err'], 'ERR');
}
elseif(isset($_GET['msg']))
{
  $message = addDecorum($_GET['msg'], 'SUC'); 
}
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
    
  </div>

  <div class="main-container">
    <div class="sub-container">
      <h4 style="margin-left:10px; margin-right:10px;">Bienvenue dans votre espace personnel <?php echo($_SESSION['prenom']); ?> ! </h4>

      <!--Affichage des messages de succès et d'erreur-->
      <?php echo($erreur); ?>
      <?php echo($message); ?>
      <!--Fin message-->

      <!--Menu-->
      <div data-role="controlgroup">
        <a href="selection_lot_commander.php" class="ui-btn ui-corner-all"><img src="../images/icones/commander.png" height="50" style="margin-right:10px; float:left;" align="absmiddle"><span style="float:middle;">Commander</span></a>
        <a href="commandes_client.php" class="ui-btn ui-corner-all"><img src="../images/icones/panier.png" height="50" style="margin-right:10px; float:left;" align="absmiddle"><span style="float:middle;">Mes commandes</span></a>
        <a href="profil_client.php" class="ui-btn ui-corner-all"><img src="../images/icones/profil.png" height="50" style="margin-right:10px; float:left;" align="absmiddle"><span style="float:middle;">Mon profil</span></a>
        <a href="../src/session_destroy.php" class="ui-btn ui-corner-all"><img src="../images/icones/deconnexion.png" height="50" style="margin-right:10px; float:left;" align="absmiddle"><span style="float:middle;">Déconnexion</span></a>
      </div>
      <!--Fin menu-->
      
    </div>
  </div>
</body>
</html>
