<?php
session_start();

//Importe le fichier de fonctions
include('../src/fonctions_traitement.php');

sessionVerif('GEST'); //Vérifie les autorisations de l'utilisateur

//Vérifie si l'identifiant de la certification 
//n'est pas donnée en variable d'adresse.
if(!isset($_GET['certif']))
{
  //Redirige vers la page des certifications
  header('location: certifications.php');
}

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
    <div data-role="header">
      <a href="#" data-rel="back" data-icon="arrow-l" data-iconpos="notext" data-shadow="true" data-iconshadow="true" data-transition="slidefade" class="ui-icon"></a>
      <h1><?php echo(getLibelleCertif($_GET['certif'])); ?></h1>
    </div>
  </nav>

  <div class="main-container">
    <div class="sub-container">
      <p>
      Vous pouvez modifier ou supprimer cette certifications
      </p>

      <!--Affichage d'un message de succès ou d'erreur-->
      <?php echo($erreur); ?>
      <?php echo($message); ?>
      <!--Fin messages-->


      <ul data-role="listview">
        <li><b>Nom de la certification : </b><?php echo(getLibelleCertif($_GET['certif'])); ?></li>
      </ul>


      <!--Fenêtre permettant de modifier les informations du verger-->
      <a href="#popupModifier" data-rel="popup" data-position-to="window" data-transition="pop" class="ui-btn ui-corner-all ui-shadow ui-btn-inline ui-icon-gear ui-btn-icon-left ui-btn-b">Modifier</a>
      <div data-role="popup" id="popupModifier" data-overlay-theme="b" data-theme="c" data-dismissible="false" style="min-width:300px; max-width:400px;">
        <div data-role="header" data-theme="c">
          <h1>Modifier</h1>
        </div>
        <div role="main" class="ui-content">
          <form method="post" action="../src/src_gerer_certif.php" data-ajax="false">
            <label for="txt_libelle_certif">Libelle de la certification :</label>
            <input type="text" name="txt_libelle_certif" value="<?php echo(getLibelleCertif($_GET['certif'])); ?>">

            <!--Contient l'identifiant de la certification-->
            <input type="hidden" name="hd_certif" value="<?php echo($_GET['certif']); ?>">

            <input value="Valider" type="submit" data-theme="b">
          </form>
        </div>
      </div>
      
    </div>
  </div>
</body>
</html>
