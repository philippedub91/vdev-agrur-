<?php
session_start();

//Importations
include('bdd_connect.php');

//Suppression d'un poids
if(isset($_POST['ckb_supprimer']))
{
	foreach($_POST['ckb_supprimer'] AS $supprimer)
	{
		$sql = $connexion->prepare('DELETE FROM conditionnement WHERE id_conditionnement = :id_conditionnement');
		$sql->bindParam(':id_conditionnement', $supprimer);
		try
		{
			$sql->execute();
		}
		catch(Exception $e)
		{
			$erreur = 'Le poids n\'a pas put $etre supprimé : '.$e->getMessage());
		}
	}
}


//Ajout d'un poids
if(isset($_POST['txt_poids']) && !empty($_POST['txt_poids']))
{
	if(isset($_POST['hd_libelle']) && !empty($_POST['hd_libelle']))
	{
		$sql = $connexion->prepare('INSERT INTO conditionnement(libelle_conditionnement, poids_conditionnement) VALUES(:libelle_conditionnement, :poids_conditionnement)');
		$sql->bindParam(':libelle_conditionnement', $_POST['hd_libelle']);
		$sql->bindParam(':poids_conditionnement', $_POST['txt_poids']);
		try
		{
			$sql->execute();
		}
		catch(Exception $e)
		{
			$erreur = 'Le poids n\'a pas put être ajouté :'.$e->getMessage());
		}
	}
}


//Redirection de l'utilisateur
if(isset($erreur))
{
	//Une erreur a été rencontrée, on affiche un message d'erreur
	header('location: ../interface/options_conditionnement.php?err='.$erreur);
}
else
{
	header('location: ../interface/options_conditionnement.php?msg=Les modifications ont été enregistrées avec succès !');
}
	





