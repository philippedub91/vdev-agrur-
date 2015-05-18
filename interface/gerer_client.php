<?php
session_start();

//Importe le fichier de fonctions
include('../src/fonctions_traitement.php');

//Importe la connexion à la base de données
include('../src/bdd_connect.php');

sessionVerif('GEST'); //Vérifie les autorisations de l'utilisateur

################

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

//Si le client est renseigné dans l'adresse
if(isset($_GET['client']))
{
  //Récupère les informations du client pour les afficher dans les champs du formulaire
  $sql = $connexion->prepare('SELECT * FROM client WHERE num_client = :num_client');
  $sql->bindParam(':num_client', $_GET['client']);
  try
  {
    $sql->execute();
    $donnees_client = $sql->fetch();
  }
  catch(Exception $e)
  {
    echo('Erreur : '.$e->getMessage());
  }
}
else //Si le client n'est pas renseigné dans l'adresse
{
  //Redirige l'utilisateur vers son espace personnel
  header('location: espace_gestionnaire.php?err=Impossible de charger les informations utilisateur');
}
?>


<!DOCTYPE html>
<html lang="fr">
<head>
  <title>Mon profil</title>
  <?php include('../common/head.php'); ?>
</head>

<body>
  <header>
    <?php include('../common/header.php'); ?>
  </header>

  <div data-role="header">
    <a href="#" data-rel="back" data-icon="arrow-l" data-iconpos="notext" data-shadow="true" data-iconshadow="true" data-transition="slidefade" class="ui-icon"></a>
    <h1>Informations clients</h1>
  </div>

  <div class="main-container">
    <div class="sub-container">
      <p>
      	Ici, vous pouvez consulter les informations personnelles, ainsi que 
      	les commandes du client sélectionné. 
      </p>

     <!--Affichage d'un message de succès ou d'erreur-->
     <?php echo($erreur); ?>
     <?php echo($message); ?>
     <!--Fin messages-->

     <div class="ui-corner-all custom-corners">
     	<div class="ui-bar ui-bar-c">
     		<h3>Informations personnelles</h3>
     	</div>
     	<div class="ui-body ui-body-c">
     		<div class="ui-field-contain">
     			<ul data-role="listview">
     				<li><b>Identité : </b> <?php echo($donnees_client['nom_client']); ?></li>
     				<li><b>Adresse : </b> <?php echo($donnees_client['adresse_client']); ?></li>
     				<li><b>Responsable des achats : </b> <?php echo($donnees_client['nom_responsable_achat']); ?></li>
     			</ul>
     		</div>
     	</div>
     </div>

     <div style="height:30px;"><!--séparation--></div>

     <div class="ui-corner-all custom-corners">
     	<div class="ui-bar ui-bar-c">
     		<h3>Commandes réalisées</h3>
     	</div>
     	<div class="ui-body ui-body-c">
     		<div class="ui-field-contain">
     			<ul data-role="listview" data-inset="true" data-theme="c" data-divider-theme="c" data-count-theme="c">
	 				<?php

	 				//Préparation et envoi de la requête permettant d'obtenir
	 				//toutes les commandes réalisées par le client.
	 				$sql = $connexion->prepare('SELECT * FROM commande WHERE num_client = :num_client');
	 				$sql->bindParam(':num_client', $_GET['client']);
	 				try
	 				{
	 					$sql->execute();
	 					while($donnees_commande = $sql->fetch())
	 					{
	 					?>
	 						<li>
	 							<table>
	 								<tr>
	 									<td><b>Commande n° :</b></td>
	 									<td><?php echo($donnees_commande['id']); ?></td>
	 								</tr>
	 								<!--tr>
	 									<td><b>Prix :</b></td>
	 									<td><?php echo($donnees_commande['prixHt']); ?> €</td>
	 								</tr-->
                  <tr>
                    <td><b>Conditionnement :</b></td>
                    <td><?php echo(getLibelleConditionnement($donnees_commande['conditionnement'])); ?></td>
                  </tr>
	 								<tr>
	 									<td><b>Quantité :</b></td>
	 									<td><?php echo($donnees_commande['quantite']); ?></td>
	 								</tr>
	 								<tr>
	 									<td><b>Data condi :</b></td>
	 									<td><?php echo($donnees_commande['dateConditionnement']); ?></td>
	 								</tr>
	 								<tr>
	 									<td><b>Date d'envoi :</b></td>
	 									<td><?php echo($donnees_commande['dateEnvoi']); ?></td>
	 								</tr>
	 							</table>
	 						</li>
	 					<?php	
	 					}
	 				}
	 				catch(Exception $e)
	 				{
	 					echo('Erreur : '.$e->getMessage());
	 				}

	 				//Fermeture de la connexion à la base de données
	 				if(isset($sql))
	 				{
	 					$sql->closeCursor();
	 				}
	 				?>
     			</ul>
     		</div>
     	</div>
     </div>
  	</div>
 </div>
</body>
</html>
