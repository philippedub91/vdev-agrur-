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
			$erreur = 'L\'opération à échouée : '.$e->getMessage());
		}
	}
	else
	{
		$erreur = 'Le poids n\'est pas correctement renseigné');
	}
}
else
{
	$erreur = 'Le libellé du conditionnement ne semble pas renseigné')
}


//Redirection de l'utilisateur 
if(isset($erreur))
{
	//Une erreur a été rencontrée, on affiche un message contenant l'erreur
	header('location: ../interface/conditionnements.php?err='.$erreur);
}
else
{
	//L'opération a réussie
	header('location: ../interface/conditionnements.php?msg=Opération réalisée avec succès !');
}




