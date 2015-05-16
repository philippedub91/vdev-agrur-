<?php
session_start();

//Importations
include('bdd_connect.php'); //Connexion à la base de données

//Ajout du label aoc à une commune
//Si ckbAjouter est coché
if(isset($_POST['ckbAjouter']))
{
	//Pour chaque checkbox nommée ckbAjouter
	foreach($_POST['ckbAjouter'] as $commune)
	{
		//Mettre à jour le commune_aoc avec la valeur 1
		$sql = $connexion->prepare('UPDATE commune SET commune_aoc = 1 WHERE id_commune = :id_commune');
		$sql->bindParam(':id_commune', $commune);
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

//Suppression du label aoc à une commune
//Si ckbRetirer est coché
if(isset($_POST['ckbRetirer']))
{
	//Pour chaque checkbox nommée ckbRetirer
	foreach($_POST['ckbRetirer'] as $commune)
	{
		//Mettre à jour la champ commune_aoc avec la valeur 0
		$sql = $connexion->prepare('UPDATE commune SET commune_aoc = 0 WHERE id_commune = :id_commune');
		$sql->bindParam(':id_commune', $commune);
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

//Ferme la connexion à la bdd si celle ci est initialisée
if(isset($sql))
{
	$sql->closeCursor(); //Ferme l'objet PDO
}

//Redirection vers la page de gestion des variétés
header('location: ../interface/communes.php?msg=s1');
