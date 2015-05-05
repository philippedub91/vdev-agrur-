<?php
session_start();

//Importations
include('bdd_connect.php'); //Connexion à la base de données


//Ajout d'un conditionnement
if(isset($_POST['txt_conditionnement']) && !empty($_POST['txt_conditionnement']))
{
	if(isset($_POST['txt_poids']) && !empty($_POST['txt_poids']) && is_numeric($_POST['txt_poids']))
	{
		$libelle = addslashes($_POST['txt_conditionnement']);
		$poids = $_POST['txt_poids'];

		$sql = $connexion->prepare('INSERT INTO conditionnement(libelle_conditionnement, poids_conditionnement) VALUES(:libelle_conditionnement, :poids_conditionnement)');
		$sql->bindParam(':libelle_conditionnement', $libelle);
		$sql->bindParam(':poids_conditionnement', $poids);
		try
		{
			$sql->execute();
		}
		catch(Exception $e)
		{
			echo('Erreur : '.$e->getMessage());
		}
	}
	else
	{
		$erreur = 1;
	}
}
else
{
	$erreur = 1;
}


//Redirige vers l'interface
if(isset($erreur)) //Une erreur de saisie a été rencontrée
{
	header('location: ../interface/conditionnements.php?msg='.$erreur);
}
else
{
	header('location: ../interface/conditionnements.php');
}
?>