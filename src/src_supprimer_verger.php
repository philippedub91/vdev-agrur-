<?php
session_start();

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

		if($donnees_verger['num_prod'] == $_SESSION['num_prod'] || $_SESSION['type'] == 'GEST')
		{
			$sql = $connexion->prepare('DELETE FROM verger WHERE id_verger = :id_verger');
			$sql->bindParam(':id_verger', $_GET['verger']);
			try
			{
				$sql->execute();
			}
			catch(Exception $e)
			{
				$erreur = 'La suppression du verger à échouée : '.$e->getMessage();
			}

		}
		else
		{
			$erreur = 'Vous ne pouvez supprimer que les vergers qui vous appartiennent';
		}
	}
	catch(Exception $e)
	{
		$erreur = 'La tentative a échouée en raison d\'une erreur liée à la base de données.';
	}
}
else
{
	$erreur = 'La suppression a échouée.'
}


if(isset($erreur))
{
	header('location: ../interface/vergers_producteur.php?err='.$erreur);
}
else
{
	header('location: ../interface/vergers_producteur.php?msg=Le verger a bien été supprimé')
}



