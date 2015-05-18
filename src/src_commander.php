<?php
session_start();

//Importe la connexion à la base de données
include('bdd_connect.php'); 

//Importe le fonctions
include('fonctions_traitement.php');

//Vérifie la validité des champs de saisie
if(isset($_POST['lst_conditionnement']) && isset($_POST['nb_quantite']) && isset($_POST['hd_lot']) && isset($_POST['hd_poids']))
{
	if(!empty($_POST['lst_conditionnement']) && !empty($_POST['nb_quantite']) && !empty($_POST['hd_lot']) && !empty($_POST['hd_poids']))
	{
		//Ajoute une commande
		$sql = $connexion->prepare('INSERT INTO commande(conditionnement, quantite, num_client, id_lot) VALUES(:conditionnement, :quantite, :num_client, :id_lot)');
		$sql->bindParam(':conditionnement', $_POST['lst_conditionnement']);
		$sql->bindParam(':quantite', $_POST['nb_quantite']);
		$sql->bindParam(':num_client', $_SESSION['num_client']);
		$sql->bindParam(':id_lot', $_POST['hd_lot']);
		try
		{
			$sql->execute();

			//Calcul le nouveau poids du lot
			$poidsRestant = $_POST['hd_poids'] - ($_POST['lst_conditionnement'] * $_POST['nb_quantite']);


			//Modifie la quantité disponible pour le lot
			$sql = $connexion->prepare('UPDATE lot_production SET poids = :poidsRestant WHERE id_lot = :id_lot');
			$sql->bindParam(':poidsRestant', $poidsRestant);
			$sql->bindParam(':id_lot', $_POST['hd_lot']);
			try
			{
				$sql->execute();
			}
			catch(Exception $e)
			{
				$erreur = 'La commande n\'a pas été réalisée : '.$e->getMessage();
			}
		}
		catch(Exception $e)
		{
			$erreur = 'La commande n\'a pas été réalisée : '.$e->getMessage();
		}
	}
	else
	{
		$erreur = 'Certains champs semblent vides.';
	}
}
else
{
	$erreur = 'Certains champs semblent ne pas avoir été saisis.';
}

//Redirection
if(isset($erreur))
{
	header('location: ../interface/commander.php?err='.$erreur);
}
else
{
	header('location: ../interface/espace_client.php?msg=Votre commande a bien été enregistrée. Merci de votre confiance !');
}
?>