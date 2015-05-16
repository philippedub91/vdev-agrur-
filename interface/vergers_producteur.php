<?php
session_start();

//Importe le fichier de fonctions
include('../src/fonctions_traitement.php');

sessionVerif('PROD'); //Vérifie les autorisations de l'utilisateur


//Importe la connexion à la base de données
include('../src/bdd_connect.php');

//Gestion des messages d'erreur
$message = '';
if(isset($_GET['msg']))
{
  $message = affiMessage($_GET['msg']);
}
?>


<!DOCTYPE html>
<html lang="fr">
<head>
  <title>Mes vergers</title>
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
      <h1>Mes vergers</h1>
    </div>
  </nav>

  <div class="main-container">
    <div class="sub-container">
      <p>
        Voici la liste de tous vos vergers enregistrés.
        Cliquez sur un verger pour afficher plus d'informations 
        et d'options. Vous pouvez également
        <a href="ajout_verger.php">ajouter des vergers</a>.
      </p>

      <!--Affichage d'un message de succès ou d'erreur-->
      <?php echo($message); ?>

      <!--Affiche la liste des vergers du producteur-->
      <ul data-role="listview" data-filter="true" data-filter-placeholder="Chercher un verger" data-inset="true">
        <?php 

          //Fonction qui permet d'afficher la liste de tous les vergers du producteur
          afficherVergerProducteur($_SESSION['num_prod']); 

        ?>
      </ul>
    </div>
  </div>
</body>
</html>
   
    