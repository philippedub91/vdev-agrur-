<?php
session_start();

//Importe le fichier de fonctions
include('../src/fonctions_traitement.php');

sessionVerif('GEST'); //Vérifie les autorisations de l'utilisateur

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

################

//Si l'identifiant du conditionnement
//n'est pas donné en variable d'adresse.
if(!isset($_GET['condi']))
{
  //Redirige vers la page des conditionnements
  header('location: conditionnements.php?err=Aucun conditionnement renseigné vous avez été redigiré');
}
?>


<!DOCTYPE html>
<html lang="fr">
<head>
  <title>Gérer conditionnement</title>
  <?php include('../common/head.php'); ?>
  <?php include('../src/bdd_connect.php'); ?>

  <?php
  //Gestion des messages de succès ou d'erreur
  $message = '';

  if(isset($_GET['msg']))
  {
    $message = affiMessage($_GET['msg']); 
  }
  ?>
</head>

<body>
  <header>
    <?php include('../common/header.php'); ?>
  </header>

  <nav>    
    <div data-role="header">
      <a href="#" data-rel="back" data-icon="arrow-l" data-iconpos="notext" data-shadow="true" data-iconshadow="true" data-transition="slidefade" class="ui-icon"></a>
      <h1><?php echo(getLibelleConditionnement($_GET['condi'])); ?></h1>
    </div>
  </nav>

  <div class="main-container">
    <div class="sub-container">
      <p>Vous pouvez supprimer ce conditionnement en cliquant sur le bouton supprimer</p>

      <!--Affichage d'un message de succès ou d'erreur-->
      <?php echo($erreur); ?>
      <?php echo($message); ?>
      <!--Fin messages-->

      <ul data-role="listview">
        <li><b>Libelle du conditionnement : </b><?php echo(getLibelleConditionnement($_GET['condi'])); ?></li>
      </ul>


      <!--Fenêtre permettant de modifier les informations du verger-->
      <a href="#popupDialog" data-rel="popup" data-position-to="window" data-transition="pop" class="ui-btn ui-corner-all ui-shadow ui-btn-inline ui-icon-delete ui-btn-icon-left ui-btn-b">Supprimer</a>
      <div data-role="popup" id="popupDialog" data-overlay-theme="c" data-theme="c" data-dismissible="false" style="max-width:400px;">
        <div data-role="header" data-theme="c">
          <h1>Confirmation</h1>
        </div>
        <div role="main" class="ui-content">
          <h3 class="ui-title">Voulez-vous vraiment supprimer ce conditionnement ?</h3>
          <p>Cette opération ne pourra pas être annulée !</p>
          <a href="#" class="ui-btn ui-corner-all ui-shadow ui-btn-inline ui-btn-b" data-rel="back">Annuler</a>
          <a href="../src/src_supprimer_conditionnement.php?condi=<?php echo($_GET['condi']); ?>" class="ui-btn ui-corner-all ui-shadow ui-btn-inline ui-btn-b" data-transition="flow">Supprimer</a>
        </div>
      </div>
      <!--Fin fenêtre-->
      
    </div>
  </div>
</body>
</html>
