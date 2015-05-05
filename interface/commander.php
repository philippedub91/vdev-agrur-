<?php
session_start();

//Importe la connexion à la base de données
include('../src/bdd_connect.php'); 
?>


<!DOCTYPE html>
<html lang="fr">
<head>
  <title>Commander</title>
  <?php include('../common/head.php'); ?>

  <?php
  //Vérifie si $_GET['lot'] est renseigné
  if(isset($_GET['lot']))
  {
    //Récupère le poids du lot
    $poids_lot = getPoidsLot($_GET['lot']);
  }
  else
  {
    header('location: selection_lot_commander.php');
  }
  ?>
</head>

<body>
  <header>
    <?php include('../common/header.php'); ?>
  </header>

  <div data-role="header">
    <img id="logo-min" src="../images/logo.png" height="40" align="absmiddle" style="float:left;">
    <a href="#" data-icon="arrow-l" data-rel="back" data-iconpos="notext" data-shadow="true" data-iconshadow="true" data-transition="slidefade" class="ui-icon"></a>
    <h1>Commander</h1>
  </div>

  <div class="main-container">
    <div class="sub-container">
    	<p>
        Sélectionnez un conditionnement, puis une quantité et enfin validez !
    	</p>

      <div class="ui-corner-all custom-corners">
        <div class="ui-bar ui-bar-c">
          <h3>Heading</h3>
        </div>
        <div class="ui-body ui-body-c">
          <form method="POST" action="../src/src_commander.php">
    	    <?php
    	    $sql = $connexion->query('SELECT * FROM  conditionnement');
    	    try
    	    {
    		    $sql->execute();
    		    while($donnees_conditionnement = $sql->fetch())
    		    {
    		    ?>
              <label for="slider-2"><?php echo($donnees_conditionnement['libelle_conditionnement']); ?></label>
              <input type="range" name="slider-2" id="slider-2" data-highlight="true" min="0" max="<?php echo(getQuantiteCondi($donnees_conditionnement['id_conditionnement'], $poids_lot)); ?>" value="0">
    		      <?php echo(getQuantiteCondi($donnees_conditionnement['id_conditionnement'], $poids_lot)); ?>
            <?php
    		    }
    	   }
    	   catch(Exception $e)
    	   {
    		   echo('Erreur : '.$e->getMessage());
    	   }
   		   ?>
        </form>

        <input type="submit" value="Valider commande">  
      </div>
    </div>
  </div>
</body>
</html>
