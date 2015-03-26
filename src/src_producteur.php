<?php
session_start();

//Importations
include('bdd_connect.php'); //Connexion à la base de données


if(isset($_POST['lst_utilisateurs']) && !empty($_POST['lst_utilisateurs']))
{
	//Modifie le type d'utilisateur dans la table utilisateur
	$sql = $connexion->prepare('UPDATE utilisateur SET type = 1 WHERE token = :token');
	$sql->bindParam(':token', $_POST['lst_utilisateurs']);
	try
	{
		$sql->execute();
	}
	catch(Exception $e)
	{
		echo('Erreur : '.$e->getMessage());
	}

	//Ajout de l'identifiant (token) dans la table producteur
	$sql = $connexion->prepare('INSERT INTO producteur(token) VALUES (:token)');
	$sql->bindParam(':token', $_POST['lst_utilisateurs']);
	try
	{
		$sql->execute();
	}
	catch(Exception $e)
	{
		echo('Erreur : '.$e->getMessage());
	}
}

$sql->closeCursor(); //Ferme l'objet PDO

//Redirection vers la page de gestion des variétés
header('location: ../interface/producteurs.php');
