<?php
session_start();

//Importe la connexion à la base de données
include('../src/bdd_connect.php');

//Importe le fichier de fonctions
include('../src/fonctions_traitement.php');

sessionVerif('GEST'); //Vérifie les autorisations de l'utilisateur

//Gestion des messages d'erreur et de succès
$message = '';
if(isset($_GET['msg']))
{
  $message = affiMessage($_GET['msg']);
}
?>


<!DOCTYPE html>
<html lang="fr">
<head>
  <title>Les vergers</title>
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
      <h1>Les vergers</h1>
    </div>
  </nav>

  <div class="main-container">
    <div class="sub-container">
      <p>
      	Voici la liste de tous les vergers actuellement en lien avec
      	AGRUR. Si vous souhaitez obtenir plus d'informations concernant un
      	de ces vergers, cliquez dessus.
      </p>

      <!--Affichage des messages de succès ou d'erreur-->
      <?php echo($message); ?>

      <!--Affiche la liste des vergers du producteur-->
      <ul data-role="listview" data-filter="true" data-filter-placeholder="Chercher un verger" data-inset="true">
        <?php 

          //Fonction qui permet d'afficher la liste de tous les vergers du producteur
          afficherVerger(); 

        ?>
      </ul>
    </div>
  </div>
</body>
</html>
   
    