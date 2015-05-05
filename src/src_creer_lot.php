<?php
session_start();

//Importations
include('bdd_connect.php'); //Connexion à la base de données


//Modification d'une certification
//Vérifie si tous les champs sont bien remplis
if(isset($_POST['lst_calibre']))
{
	if(isset($_POST['sld_quantite']))
	{
		if(isset($_POST['hd_livraison']))
		{
			//Prépare la requête
			$sql = $connexion->prepare('INSERT INTO lot_production(calibre, id_livraison, poids) VALUES(:calibre, :id_livraison, :poids)');
			$sql->bindParam(':calibre', $_POST['lst_calibre']);
			$sql->bindParam(':id_livraison', $_POST['hd_livraison']);
			$sql->bindParam(':poids', $_POST['sld_quantite']);

			try
			{
				$sql->execute(); //Envoi la requête
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
	else //Si tous les champs ne sont pas saisis.
	{
		$erreur = 1;
	}
}
else
{
	$erreur = 1;
}


//Redirection vers la page de gestion des variétés
if(isset($erreur)) //S'il y a une erreur renvoi vers la page certification avec le code erreur.
{
	header('location: ../interface/creer_lot_gestionnaire.php?livraison='.$_POST['hd_livraison'].'&msg='.$erreur);
}
else //Il n'y a pas d'erreur
{
	header('location: ../interface/creer_lot_gestionnaire.php');	
}

