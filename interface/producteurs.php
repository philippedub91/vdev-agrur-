<?php
session_start();

//Importe le fichier de fonctions
include('../src/fonctions_traitement.php');

sessionVerif('GEST'); //Vérifie les autorisations de l'utilisateur
?>


<!DOCTYPE html>
<html lang="fr">
<head>
  <title>Producteurs</title>
  <?php include('../common/head.php'); ?>
  <?php include('../src/bdd_connect.php'); ?>
</head>

<body>
  <header>
    <?php include('../common/header.php'); ?>
  </header>

  <div data-role="header">
  	<a href="#" data-rel="back" data-icon="arrow-l" data-iconpos="notext" data-shadow="true" data-iconshadow="true" data-transition="slidefade" class="ui-con"></a>
  	<h1>Producteurs</h1>
  </div>

  <div class="main-container">
  	<div class="sub-container">

  		<p>
  			Cette liste, présente tous les producteurs membres de la coopérative.
  		</p>
  		
		<ul data-role="listview" data-filter="true" data-filter-placeholder="Rechercher un producteur" data-inset="true">
			<?php afficherProducteurs(); ?>
		</ul>
    </div>
  </div>
</body>
</html>
