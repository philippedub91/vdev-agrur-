<?php
session_start();


//Importe la connexion à la base de données
include('../src/bdd_connect.php');

//Importe le fichier de fonctions
include('../src/fonctions_traitement.php');

sessionVerif('GEST'); //Vérifie les autorisations de l'utilisateur

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
  <title>Certifications</title>
  <?php include('../common/head.php'); ?>
  <?php include('../src/bdd_connect.php'); ?>
</head>

<body>
  <header>
    <?php include('../common/header.php'); ?>
  </header>

  <nav>
    <div data-role="header" data-theme="c">
      <a href="#" data-rel="back" data-icon="arrow-l" data-iconpos="notext" data-shadow="true" data-iconshadow="true" data-transition="slidefade" class="ui-icon"></a>
    <nav>
    
    <div data-role="header">
      <a href="#" data-rel="back" data-icon="arrow-l" data-iconpos="notext" data-shadow="true" data-iconshadow="true" data-transition="slidefade" class="ui-icon"></a>
      <h1>Certifications</h1>
    </div>
  </nav>

  <div class="main-container">
    <div class="sub-container">
      <p>
        Voici la liste des certifications qu'un producteur peut obtenir.
        Pour attribuer une certification à un producteur, rendez-vous dans
        la section producteur. Si vous souhaitez ajouter une nouvelle certification
        <a href="#popupAjouter" data-rel="popup" data-position-to="window" data-transition="pop">cliquez ici</a>
      </p>

      <!--Affichage d'un message de succès ou d'erreur-->
      <?php echo($erreur); ?>
      <?php echo($message); ?>
      <!--Fin messages-->

      <!--Affiche la liste des certifications-->
      <ul data-role="listview" data-filter="true" data-filter-placeholder="Chercher une certification" data-inset="true">
        <?php 

          //Fonction qui permet d'afficher la liste de tous les vergers du producteur
          afficherCertifications(); 

        ?>
      </ul>
      <!--Fin liste-->

      <!--Fenêtre modale d'ajout de certification-->
      <div data-role="popup" id="popupAjouter" data-theme="c" class="ui-corner-all">
        <div data-role="header" data-theme="c">
          <h1>Ajouter</h1>
        </div>
        <div role="main" class="ui-content">
          <form method="post" action="../src/src_certifications.php" data-ajax="false">
            <label for="txt_libelle_certif">Libelle de la certification :</label>
            <input type="text" name="txt_libelle_certif" value="">

            <input value="Ajouter" type="submit" data-theme="b">
          </form>
        </div>
      </div>
      <!--Fin fenêtre modale-->

    </div>
  </div>
</body>
</html>
   
    