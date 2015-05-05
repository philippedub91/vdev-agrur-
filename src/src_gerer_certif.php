<?php
session_start();

//Importations
include('bdd_connect.php'); //Connexion à la base de données


//Modification d'une certification
//Vérifie si tous les champs sont bien remplis
if(isset($_POST['txt_libelle_certif']))
{
	if(isset($_POST['hd_certif']))
	{
		//Préparation de la requête
		$sql = $connexion->prepare('UPDATE certification SET libelle_certif = :libelle_certif WHERE id_certif = :id_certif');
		$sql->bindParam(':libelle_certif', $_POST['txt_libelle_certif']);
		$sql->bindParam(':id_certif', $_POST['hd_certif']);
		try
		{
			//Envoi de la requête
			$sql->execute();
		}
		catch(Exception $e)
		{
			echo('Erreur : '.$e->getMessage());
		}

		$sql->closeCursor(); //Ferme l'objet PDO
	}
	else //Si tous les champs ne sont pas saisis.
	{
		$erreur = 2;
	}
}
else
{
	$erreur = 3;
}


//Redirection vers la page de gestion des variétés
if(isset($erreur)) //S'il y a une erreur renvoi vers la page certification avec le code erreur.
{
	header('location: ../interface/gerer_certif.php?msg='.$erreur.'&certif='.$_POST['hd_certif']);
}
else //Il n'y a pas d'erreur
{
	header('location: ../interface/certifications.php');	
}

