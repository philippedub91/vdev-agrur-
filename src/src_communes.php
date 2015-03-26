<?php
session_start();

//Importations
include('bdd_connect.php'); //Connexion à la base de données


//Modification de l'aoc des communes
//Remise à zéro de toutes les communes
$sql = $connexion->query('UPDATE commune SET commune_aoc = 0'); //Remise à zéro de toutes les communes
if(isset($_POST['ckb_aoc']))
{
	foreach($_POST['ckb_aoc'] as $aoc)
	{
		$sql = $connexion->prepare('UPDATE commune SET commune_aoc = 1 WHERE id_commune = :id_commune');
		$sql->bindParam(':id_commune', $aoc);
		try
		{
			$sql->execute();
		}
		catch(Exception $e)
		{
			echo('Erreur : '.$e->getMessage());
		}
	}
}


$sql->closeCursor(); //Ferme l'objet PDO

//Redirection vers la page de gestion des variétés
header('location: ../interface/communes.php');
