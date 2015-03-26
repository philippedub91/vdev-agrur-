<?php
session_start();

//Importations
include('bdd_connect.php'); //Connexion à la base de données


//Suppression des conditionnements sélectionnés
if(isset($_POST['ckb_supprimer']))
{
	foreach($_POST['ckb_supprimer'] as $supprimer)
	{
		$sql = $connexion->prepare('DELETE FROM conditionnement WHERE libelle_conditionnement = :libelle_conditionnement');
		$sql->bindParam(':libelle_conditionnement', $supprimer);
		try
		{
			$sql->execute();
		}
		catch(Exception $e)
		{
			echo('Erreur : '.$e->getMessage());
		}
	}
}


//Ajout d'un conditionnement
if(isset($_POST['txt_conditionnement']) && !empty($_POST['txt_conditionnement']))
{
	if(isset($_POST['txt_poids']) && !empty($_POST['txt_poids']))
	{
		$libelle = addslashes($_POST['txt_conditionnement']);

		//Crée un tableau contenant tous les poids saisis
		$poids = explode(',', $_POST['txt_poids']); 

		//Ajout du conditionnement dans la base de données
		foreach($poids as $unPoids)
		{
			$sql = $connexion->prepare('INSERT INTO conditionnement(libelle_conditionnement, poids_conditionnement) VALUES(:libelle_conditionnement, :poids_conditionnement)');
			$sql->bindParam(':libelle_conditionnement', $libelle);
			$sql->bindParam(':poids_conditionnement', $unPoids);
			try
			{
				$sql->execute();
			}
			catch(Exception $e)
			{
				echo('Erreur : '.$e->getMessage());
			}
		}
	}
}

header('location: ../interface/conditionnements.php');
?>