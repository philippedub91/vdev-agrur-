<?php
session_start();

//Importe la connexion à la base de données
include('../src/bdd_connect.php'); 

//Importe le fichier de fonctions
include('../src/fonctions_traitement.php');

sessionVerif('CLI'); //Vérifie les autorisations de l'utilisateur

##########

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
  <title>Sélectionner un lot de production</title>
  <?php include('../common/head.php'); ?>
</head>

<body>
  <header>
    <?php include('../common/header.php'); ?>
  </header>

  <div data-role="header">
    <img id="logo-min" src="../images/logo.png" height="40" align="absmiddle" style="float:left;">
    <a href="#" data-icon="arrow-l" data-rel="back" data-iconpos="notext" data-shadow="true" data-iconshadow="true" data-transition="slidefade" class="ui-icon"></a>
    <h1>Sélectionner un lot de production</h1>
  </div>

  <div class="main-container">
    <div class="sub-container">
    	<p>
    		Sélectionnez un lot de production à partir duquel vous souhaitez réaliser
    		une commande.
    	</p>

      <!--Affichage des messages de succes et d'erreur-->
      <?php echo($erreur); ?>
      <?php echo($message); ?>
      <!--Fin messages-->

    	<?php
    	$sql = $connexion->query('SELECT * FROM  lot_production');
    	try
    	{
    		$sql->execute();
    		while($donnees_lot = $sql->fetch())
    		{
    		?>
    			<div class="ui-corner-all custom-corners">
  					<div class="ui-bar ui-bar-c">
    					<h3>Lot n° <?php echo($donnees_lot['id_lot']); ?></h3>
  					</div>
  					<div class="ui-body ui-body-c">
    					<table>
    						<tr>
    							<td><b>Calibre :</b></td>
    							<td><?php echo(getLibelleCalibre($donnees_lot['id_lot'])); ?></td>
    						</tr>
    						<tr>
    							<td><b>Poids :</b></td>
    							<td><?php echo($donnees_lot['poids']); ?></td>
    						</tr>
    						<tr>
    							<td><b>Variété :</b></td>
    							<td><?php echo(getLibelleVarieteLot($donnees_lot['id_lot'])); ?></td>
    						</tr>
    						<tr>
    							<td><b>Type :</b></td>
    							<td><?php echo(getTypeNoixLot($donnees_lot['id_lot'])); ?></td>
    						</tr>
    					</table>
    					<a href="commander.php?lot=<?php echo($donnees_lot['id_lot']); ?>" class="ui-btn ui-shadow">Commander ce lot</a>
  					</div>
				</div>
    		<?php
    		}
    	}
    	catch(Exception $e)
    	{
    		echo('Erreur : '.$e->getMessage());
    	}
   		?>





         
     </div>
  </div>
</body>
</html>
