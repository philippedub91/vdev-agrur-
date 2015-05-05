<?php
session_start();


//Importe la connexion à la base de données
include('../src/bdd_connect.php');

//Gestion des messages d'erreur
$message_erreur = '';
if(isset($_GET['msg']))
{
  switch($_GET['msg'])
  {
    case 1:
      $message_erreur = 'Un ou plusieurs champs ne sont pas ou mal saisis. Merci de vérifier le formulaire avant de continuer.';
    break;
    default:
    break;
  }
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

      <!--Affiche la liste des certifications-->
      <ul data-role="listview" data-filter="true" data-filter-placeholder="Chercher une certification" data-inset="true">
        <?php 

          //Fonction qui permet d'afficher la liste de tous les vergers du producteur
          afficherCertifications(); 

        ?>
      </ul>

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

    </div>
  </div>
</body>
</html>
   
    