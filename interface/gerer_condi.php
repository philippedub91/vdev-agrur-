<?php
session_start();

//Vérifie si l'identifiant du conditionnement
//n'est pas donné en variable d'adresse.
if(!isset($_GET['condi']))
{
  //Redirige vers la page des conditionnements
  header('location: conditionnements.php');
}
?>


<!DOCTYPE html>
<html lang="fr">
<head>
  <title>Gérer conditionnement</title>
  <?php include('../common/head.php'); ?>
  <?php include('../src/bdd_connect.php'); ?>

  <?php
  //Gestion du message d'erreur
  $erreur = '';

  if(isset($_GET['msg']))
  {
    switch($_GET['msg'])
    {
      case 1:
        $erreur = 'Modification non réalisée. Le nom n\'est pas correctement saisi.';
      break;
      case 2:
        $erreur = 'Modification non réalisée. La superficie saisie n\'est pas conforme';
      break;
      case 3:
        $erreur = 'Modification non réalisée. Le nombre d\'arbres n\'est pas ou mal saisi';
      default:
      break;
    }
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

      <!--Affichage d'un message d'erreur-->
      <p style="color:red;">
        <?php echo($erreur); ?>
      </p>

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
          <a href="../src/src_supprimer_condi.php?condi=<?php echo($_GET['condi']); ?>" class="ui-btn ui-corner-all ui-shadow ui-btn-inline ui-btn-b" data-transition="flow">Supprimer</a>
        </div>
      </div>
    </div>
  </div>
</body>
</html>
