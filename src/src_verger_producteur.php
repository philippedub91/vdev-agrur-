<?php
session_start();

//Importations
include('bdd_connect.php'); //Connexion à la base de données


//Ajout d'un verger
//Contrôle si les saisies sont conformes
if(isset($_POST['txt_nom_verger']) && !empty($_POST['txt_nom_verger']))
{
	if(isset($_POST['txt_superficie']) && !empty($_POST['txt_superficie']) && is_numeric($_POST['txt_superficie']))
	{
		if(isset($_POST['txt_nbr_arbres']) && !empty($_POST['txt_nbr_arbres']) && is_numeric($_POST['txt_nbr_arbres']))
		{
			if(isset($_POST['lst_commune']) && !empty($_POST['lst_commune']))
			{
				if(isset($_POST['lst_variete']) && !empty($_POST['lst_variete']))
				{
					//Sécurise les saisies (pour éviter les insertion de code)
					$nom_verger = addslashes($_POST['txt_nom_verger']);
					$superficie = addslashes($_POST['txt_superficie']);
					$nbr_arbres = addslashes($_POST['txt_nbr_arbre']);

					$commune = $_POST['lst_commune'];
					$variete = $_POST['lst_variete'];

					//Préparation de la requête
					$sql = $connexion->prepare('INSERT INTO verger(nom_verger, superficie, nbr_arbre, id_commune, num_prod, id_variete) VALUES(:nom_verger, :superficie, :nbr_arbre, :id_commune, :num_prod, :id_variete)');
					$sql->bindParam(':nom_verger', $nom_verger);
					$sql->bindParam(':superficie', $superficie);
					$sql->bindParam(':nbr_arbre', $nbr_arbres);
					$sql->bindParam(':id_commune', $commune);
					$sql->bindParam(':num_prod', $_SESSION['num_prod']);
					$sql->bindParam(':id_variete', $variete);

					//Envoi de la requête
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
}
else
{
	$erreur = 1;
}

//Suppression de vergers



$sql->closeCursor(); //Ferme l'objet PDO

//Redirection vers la page de gestion des variétés
header('location: ../interface/producteurs.php');
