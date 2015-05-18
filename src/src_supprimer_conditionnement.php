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
		$erreur = 'Suppression impossible : '.$e->getMessage();
	}
}


//Redirection de l'utilisateur
if(isset($erreur)
{
	//Une erreur a été rencontrée, on affiche un message d'erreur
	header('location: ../conditionnements.php?err='.$erreur);
}
else
{
	header('location: ../conditionnements.php?msg=Conditionnent supprimé avec succès');
}
?>