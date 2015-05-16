<?php

//Importe la base de données
include('bdd_connect.php');

if(isset($_POST['txt_nom_verger']) && !empty($_POST['txt_nom_verger']))
{
	if(isset($_POST['txt_superficie']) && !empty($_POST['txt_superficie']) && is_numeric($_POST['txt_superficie']))
	{
		if(isset($_POST['sld_nbr_arbres']) && !empty($_POST['sld_nbr_arbres']) && $_POST['sld_nbr_arbres'] > 0)
		{
			//Sécurise les valeurs
			$nom_verger = addslashes($_POST['txt_nom_verger']);
			$superficie = $_POST['txt_superficie'];
			$nbr_arbre = addslashes($_POST['sld_nbr_arbres']);


			//Modifie les valeurs
			$sql = $connexion->prepare('UPDATE verger SET nom_verger = :nom_verger, superficie = :superficie, nbr_arbre = :nbr_arbre WHERE id_verger = id_verger');
			$sql->bindParam(':nom_verger', $nom_verger);
			$sql->bindParam(':superficie', $superficie);
			$sql->bindParam(':nbr_arbre', $nbr_arbre);
			try
			{
				$sql->execute();
				header('location: ../interface/gerer_verger.php?verger='.$_POST['id_verger'].'&msg=s1');
			}
			catch(Exception $e)
			{
				echo('Erreur : '.$e->getMessage());
			}
		}
		else
		{
			$erreur = 'e9';
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


if(isset($erreur))
{
	header('location: ../interface/gerer_verger.php?verger='.$_POST['id_verger'].'&msg='.$erreur);
}