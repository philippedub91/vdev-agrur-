<?php
session_start();
?>


<!DOCTYPE html>
<html lang="fr">
<head>
  <title>Mes vergers</title>
  <?php include('../common/head.php'); ?>
  <?php include('../src/bdd_connect.php'); ?>

  <?php
  //Récupère les informations du verger
  if(isset($_GET['verger']) && is_numeric($_GET['verger']))
  {
    $sql = $connexion->prepare('SELECT * FROM verger WHERE id_verger = :id_verger');
    $sql->bindParam(':id_verger', $_GET['verger']);
    try
    {
      $sql->execute();
      $donnees_verger = $sql->fetch();
    }
    catch(Exception $e)
    {
      header('location: vergers_producteur.php');
    }
  }
  else
  {
    header('location: vergers_producteur.php');
  }
  ?>
</head>

<body>
  <header>
    <?php include('../common/header.php'); ?>
  </header>

  <nav>
    <div data-role="navbar">
      <ul>
          <li><a href="espace_producteur.php">Accueil</a></li>
          <li><a href="vergers_producteur.php">Mes vergers</a></li>
      </ul>
    </div>
    
    <div data-role="header">
      <h1><?php echo($donnees_verger['nom_verger']); ?></h1>
    </div>
  </nav>

  <div class="content-body">

  </div>
</body>
</html>
