<?php
session_start();

//Importation de la base de données
include('bdd_connect.php');

if(isset($_POST['txt_date_livraison']) && !empty($_POST['txt_date_livraison']))
{
	if(isset($_POST['lst_verger']) && !empty($_POST['lst_verger']))
	{
		if(isset($_POST['lst_type_produit']) && !empty($_POST['lst_type_produit']))
		{
			if(isset($_POST['txt_quantite']) && !empty($_POST['txt_quantite']) && is_numeric($_POST['txt_quantite']))
			{
				$sql = $connexion->prepare('INSERT INTO livraison(date_livraison, num_prod, poids, type, id_verger) VALUES(:date_livraison, :num_prod, :poids, :type, :id_verger)');
				$sql->bindParam(':date_livraison', $_POST['txt_date_livraison']);
				$sql->bindParam(':num_prod', $_SESSION['num_prod']);
				$sql->bindParam(':poids', $_POST['txt_quantite']);
				$sql->bindParam(':type', $_POST['lst_type_produit']);
				$sql->bindParam(':id_verger', $_POST['lst_verger']);
				try
				{
					$sql->execute();
				}
				catch(Exception $e)
				{
					$erreur = 'Ajout impossible, il y a une erreur : '.$e->getMessage();
				}
			}
			else
			{
				$erreur = 'La quantité ne semble pas correctement renseignée.';
			}
		}
		else
		{
			$erreur = 'Le type de produit ne semble pas renseigné.';
		}
 	}
 	else
 	{
 		$erreur = 'Le verger ne semble pas renseigné.';
 	}
}
else
{
	$erreur = 'La date de livraison ne semble pas renseignée.';
}

//Redirection
if(isset($erreur))
{
	//Une erreur a été rencontrée, on affiche un message
	header('location: ../interface/livraison_producteur.php?err='.$erreur);
}
else
{
	header('location: ../interface/livraison_producteur.php?msg=La livraison a bien été ajoutée !');
}

