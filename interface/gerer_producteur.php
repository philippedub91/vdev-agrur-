<?php
session_start();

$erreur = "";

//Redirige vers la liste des producteurs si la variable
//d'adresse $_GET['prod'] n'existe pas.
if(!isset($_GET['prod']))
{
	header('location: producteurs.php');
}
?>



<!DOCTYPE html>
<html lang="fr">
<head>
  <?php include('../common/head.php'); ?>
  <?php include('../src/bdd_connect.php'); ?>
  <title>Producteur : <?php echo(getIdentiteProducteur($_GET['prod'])); ?></title>
</head>

<body>
  <header>
    <?php include('../common/header.php'); ?>
  </header>

   <div data-role="header">
     <a href="#" data-rel="back" data-icon="arrow-l" data-iconpos="notext" data-shadow="true" data-iconshadow="true" data-transition="slidefade" class="ui-icon"></a>
     <h1><?php echo(getIdentiteProducteur($_GET['prod'])); ?></h1>
   </div>

   <div class="main-container">
    <div class="sub-container">
      <p>
      	Voici les informations concernant le producteur <?php echo(getIdentiteProducteur($_GET['prod'])); ?>.
      </p>

      <!--Affichage d'un message d'erreur-->
      <p style="color:red;">
        <?php echo($erreur); ?>
      </p>

      <!--Informations personnelles-->
      <div class="ui-corner-all custom-corners">
      	<div class="ui-bar ui-bar-c">
      		<h3>Informations personnelles</h3>
      	</div>
      	<div class="ui-body ui-body-c">
			<ul data-role="listview">
        		<li><b>Identité : </b><?php echo(getIdentiteProducteur($_GET['prod'])); ?></li>
      			<li><b>Adresse : </b><?php echo(getAdresseProducteur($_GET['prod'])) ?></li>
      			<li><b>Date d'adhésion : </b><?php echo(getDateAdhesionProducteur($_GET['prod'])); ?>
      			<li><b>Société représentante : </b><?php echo(getSocieteRepresentante($_GET['prod'])); ?></li>
      			<li><b>Représentant : </b><?php echo(getRepresentantProducteur($_GET['prod'])); ?></li>
      		</ul>
      	</div>
      </div>

      <!--Vergers appartenant au producteur-->
      <div class="ui-corner-all custom-corners">
      	<div class="ui-bar ui-bar-c">
      		<h3>Ses vergers</h3>
      	</div>
      	<div class="ui-body ui-body-c">
      		<ul data-role="listview">
      			<?php afficherVergerProducteur($_GET['prod']); ?>
			</ul>
		</div>
	  </div>

	  <!--Certifications du producteur-->
	  <div class="ui-corner-all custom-corners">
	  	<div class="ui-bar ui-bar-c">
	  		<h3>Ses certifications</h3>
	  	</div>
	  	<div class="ui-body ui-body-c">
	  		<ul data-role="listview">
	  			<?php afficherCertificationsProducteur($_GET['prod']); ?>
	  		</ul>
      </div>
    </div>

	  		<a href="#popupDialog" data-rel="popup" data-position-to="window" data-transition="pop" class="ui-btn ui-corner-all ui-shadow ui-btn-inline ui-icon-star ui-btn-icon-left ui-btn-c">Attributions</a>
	  		<div data-role="popup" id="popupDialog" data-overlay-theme="c" data-theme="c" data-dismissible="false" style="max-width:400px;">
    			<div data-role="header" data-theme="c">
    				<h1>Attribuer des certifications</h1>
    			</div>
    			<div role="main" class="ui-content">
        			<h3 class="ui-title">Cochez les certifications attribuées à ce producteur</p>
        			<form method="POST" action="../src/src_attribuer_certification.php" data-ajax="false">
    					<?php
    					$sql = $connexion->query('SELECT * FROM certification');
    					try
    					{
    						$sql->execute();
    						echo('<ul data-role="listview">');
    						while($donnees_certification = $sql->fetch())
    						{
    						?>
    							<li style="padding-left:15px;">
    								<input type="checkbox" name="ckb_certification[]" value="<?php echo($donnees_certification['id_certif']); ?>">
    								<label><?php echo($donnees_certification['libelle_certif']); ?></label>
    							</li>
    						<?php
    						}

    						echo('</ul>');
    					}
    					catch(Exception $e)
    					{
    						echo('Erreur : '.$e->getMessage());
    					}
    					?>

    					<input type="hidden" name="hd_prod" value="<?php echo($_GET['prod']); ?>">

    					<input type="submit" class="ui-btn ui-corner-all ui-shadow ui-btn-inline ui-btn-b" value="Valider" data-transition="flow">
					</form>

        			<a href="#" class="ui-btn ui-corner-all ui-shadow ui-btn-inline ui-btn-b" data-rel="back">Annuler</a>
    			</div>
			</div>
	  	</div>
	  </div>
   </div>
  </div>
</body>
</html>
