<?php

//Importe la connexion à la base de données
include('bdd_connect.php'); 

if(isset($_GET['verger']) && is_numeric($_GET['verger']))
{
	//Charge les informations du verger et notamment l'id de producteur propriétaire
	$sql = $connexion->prepare('SELECT num_prod FROM verger WHERE id_verger = :id_verger');
	$sql->bindParam(':id_verger', $_GET['verger']);
	try
	{
		$sql->execute();
		$donnees_verger = $sql->fetch();

		if($donnees_verger['num_producteur'] == $_SESSION['num_prod'] || $_SESSION['type'] == 'gestionnaire')
		{
			$sql = $connexion->prepare('DELETE FROM verger WHERE id_verger = :id_verger');
			$sql->bindParam(':id_verger', $_GET['verger']);
			try
			{
				$sql->execute();
			}
			catch(Exception $e)
			{
				echo('Erreur : '.$e->getMessage());
			}

			header('location: ../interface/vergers_producteur.php');
		}
		else
		{
			header('location: vergers_producteur.php');
		}
	}
	catch(Exception $e)
	{
		echo('Erreur : '.$e->getMessage());
	}
}
else
{
	header('location: vergers_producteur.php');
}