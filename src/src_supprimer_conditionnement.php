<?php
if(isset($_GET['condi']))
{
	include('bdd_connect.php');

	//Préparation de la requête de suppression du conditionement
	$sql = $connexion->prepare('DELETE FROM conditionnement WHERE id_conditionnement = :id_conditionnement');
	$sql->bindParam(':id_conditionnement', $_GET['condi']);
	try
	{
		$sql->execute();
	}
	catch(Exception $e)
	{
		echo($e->getMessage());
	}
}

header('location: ../conditionnements.php');
