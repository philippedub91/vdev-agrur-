<?php
session_start();

//Gestion des messages d'erreur :
$message = ''; //Initialise message

if(isset($_GET['msg']) && $_GET['msg'] == 1 )
{
  $message = 'Un ou plusieurs champs n\'ont pas été saisis correctement.'; 
} 
?>


<!DOCTYPE html>
<html lang="fr">
<head>
  <title>Créer des lots</title>
  <?php include('../common/head.php'); ?>
  <?php include('../src/bdd_connect.php'); ?>
</head>

<body>
  <header>
    <?php include('../common/header.php'); ?>
  </header>

  <div data-role="header">
    <a href="#" data-rel="back" data-icon="arrow-l" data-iconpos="notext" data-shadow="true" data-iconshadow="true" data-transition="slidefade" class="ui-icon"></a>
    <h1>Créer des lots</h1>
  </div>

  <div class="main-container">
    <div class="sub-container">

      <p>
        Pour créer des lots, veuillez remplir le formulaire ci-dessous. Chaque lot correspond à 
        un calibre.
      </p>

      <div class="ui-corner-all custom-corners">
        <div class="ui-bar ui-bar-c">
          <h3>Création du lot</h3>
        </div>
        <div class="ui-body ui-body-c">
          <h3><?php echo('12250kg'); ?></h3>
          <form method="POST" action="src/src_creer_lot.php">
            <label for="ckb_calibre_1">Calibre 1 :</label>
            <input type="range" name="slider-1" id="slider-1" min="0" max="100" value="50">
          </form>
        </div>
      </div>
      <form method="POST" action="src/src_creer_lot.php">
      </form>
    </div>
  </div>
</body>
</html>
