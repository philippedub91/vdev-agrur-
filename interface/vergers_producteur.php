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
  <title>Mes vergers</title>
  <?php include('../common/head.php'); ?>
</head>

<body>
  <header>
    <?php include('../common/header.php'); ?>
  </header>

  <nav>
    <div data-role="header" data-theme="c">
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
