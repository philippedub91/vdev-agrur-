<?php
session_start();

//Importations
include('bdd_connect.php'); //Connexion à la base de données

//Modification de l'aoc des variétés
//Remise à zéro de toutes les variétés
$sql = $connexion->query('UPDATE variete SET AOC = 0'); //Remise à zéro de toutes les variétés

if(isset($_POST['ckb_aoc']))
{
	foreach($_POST['ckb_aoc'] as $aoc)
	{
		$sql = $connexion->prepare('UPDATE variete SET AOC = 1 WHERE id_variete = :id_variete');
		$sql->bindParam(':id_variete', $aoc);
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

//Suppression des variétés sélectionnées
if(isset($_POST['ckb_supprimer']))
{
	foreach($_POST['ckb_supprimer'] as $variete)
	{
		$sql = $connexion->prepare('DELETE FROM variete WHERE id_variete = :id_variete');
		$sql->bindParam(':id_variete', $variete);
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

//Ajout d'une variété
if(isset($_POST['txt_libelle_variete']) && !empty($_POST['txt_libelle_variete']))
{
	$libelle_variete = addslashes($_POST['txt_libelle_variete']);

	//Vérifie si cette variété n'est pas déjà présente
	$sql = $connexion->prepare('SELECT count(*) AS compteur FROM variete WHERE libelle_variete = :libelle_variete');
	$sql->bindParam(':libelle_variete', $libelle_variete);
	try
	{
		$sql->execute();
		$donnees_variete = $sql->fetch();
		if($donnees_variete['compteur'] == 0) //La variété n'existe pas
		{
			$sql = $connexion->prepare('INSERT INTO variete(libelle_variete) VALUES(:libelle_variete)');
			$sql->bindParam(':libelle_variete', $libelle_variete);
			try
			{
				$sql->execute();
			}
			catch(Exception $e)
			{
				echo('Erreur : '.$e->getMessage());
			}
		}
		else //La variété existe déjà
		{
			header('location: ../interface/varietes.php?msg=1');
		}
	}
	catch(Exception $e)
	{
		echo('Erreur : '.$e->getMessage());
	}
}

$sql->closeCursor(); //Ferme l'objet PDO

//Redirection vers la page de gestion des variétés
header('location: ../interface/varietes.php');