<?php
session_start();

//Importations
include('bdd_connect.php'); //Connexion à la base de données
include('fonctions_traitement.php'); //Fichier de fonctions


if(isset($_POST['txt_nom_verger']) && !empty($_POST['txt_nom_verger']))
{
	if(isset($_POST['sld_superficie']) && is_numeric($_POST['sld_superficie']))
	{
		if(isset($_POST['sld_nb_arbre']) && is_numeric($_POST['sld_nb_arbre']))
		{
			if(isset($_POST['txt_commune']) && !empty($_POST['txt_commune']))
			{
				if(isset($_POST['txt_variete']) && !empty($_POST['txt_variete']))
				{

					//Préparation des variables pour l'insertion des données
					$nom_verger = addslashes($_POST['txt_nom_verger']);
					$commune = addslashes($_POST['txt_commune']);
					$variete = addslashes($_POST['txt_variete']);

					$superficie = $_POST['sld_superficie'];
					$nb_arbre = $_POST['sld_nb_arbre'];

					$idCommune = getIdCommune($commune);
					$idVariete = getIdVariete($variete);

					if($idCommune == NULL)
					{
						creerCommune($commune, 0);
						$idCommune = getIdCommune($commune);
					}

					if($idVariete == NULL)
					{
						creerVariete($variete, 0);
						$idVariete = getIdVariete($variete);
					}


					$sql = $connexion->prepare('INSERT INTO verger(nom_verger, superficie, nbr_arbre, id_commune, num_prod, id_variete) VALUES(:nom_verger, :superficie, :nbr_arbre, :id_commune, :num_prod, :id_variete)'); 
					$sql->bindParam(':nom_verger', $nom_verger);
					$sql->bindParam(':superficie', $superficie);
					$sql->bindParam(':nbr_arbre', $nb_arbre);
					$sql->bindParam(':id_commune', $idCommune);
					$sql->bindParam(':num_prod', $_SESSION['num_prod']);
					$sql->bindParam(':id_variete', $idVariete);
					try
					{
						$sql->execute();
					}
					catch(Exception $e)
					{
						echo('Erreur : '.$e->getMessage());
					}

					header('location: ../interface/vergers_producteur.php?msg=s1');
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
}
else
{
	$erreur = 'e1';
}

header('location: ../interface/ajout_verger.php?msg='.$erreur); 
