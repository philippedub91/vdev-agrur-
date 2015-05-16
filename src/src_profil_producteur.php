<?php
session_start();

//Importations
include('bdd_connect.php'); //Connexion à la base de données

//Vérifie si tous les champs sont conformes
if(isset($_POST['txt_adresse_prod']) && !empty($_POST['txt_adresse_prod']))
{
	if(isset($_POST['txt_nom_representant']) && !empty($_POST['txt_nom_representant']))
	{
		if(isset($_POST['txt_prenom_representant']) && !empty($_POST['txt_prenom_representant']))
		{
			if(isset($_POST['txt_societe']) && !empty($_POST['txt_societe']))
			{
				//Sécurise les valeurs pour éviter les insertions de code
				$adresse_prod = addslashes($_POST['txt_adresse_prod']);
				$nom_representant = addslashes($_POST['txt_nom_representant']);
				$prenom_representant = addslashes($_POST['txt_prenom_representant']);
				$societe = addslashes($_POST['txt_societe']);

				//Préparation de la requête
				$sql = $connexion->prepare('UPDATE producteur SET adresse_prod = :adresse_prod, nom_representant_prod = :nom_representant_prod, prenom_representant_prod = :prenom_representant_prod, societe = :societe WHERE token = :token');
				$sql->bindParam(':adresse_prod', $adresse_prod);
				$sql->bindParam(':nom_representant_prod', $nom_representant);
				$sql->bindParam(':prenom_representant_prod', $prenom_representant);
				$sql->bindParam(':societe', $societe);
				$sql->bindParam(':token', $_SESSION['token']);

				$sql->closeCursor();

				//Execution de la requete
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
				$erreur = 'e1';
			}
		}
		else
		{
			$erreur = 'e1';
		}
	}
	else
	{
		$erreur = 'e1';
	}
}
else
{
	$erreur = 'e1';
}



//Redirection vers la page de gestion des variétés
if(isset($erreur))
{
	header('location: ../interface/profil_producteur.php?msg='.$erreur);
}
else
{
	header('location: ../interface/profil_producteur.php?msg=s1');
}
