<?php
session_start();

//Importations
include('bdd_connect.php'); //Connexion à la base de données

//Ajout du label aoc à une variete
//Si ckbAjouter est coché
if(isset($_POST['ckbAjouter']))
{
	//Pour chaque checkbox nommée ckbAjouter
	foreach($_POST['ckbAjouter'] as $variete)
	{
		//Mettre à jour le champ AOC avec la valeur 1
		$sql = $connexion->prepare('UPDATE variete SET AOC = 1 WHERE id_variete = :id_variete');
		$sql->bindParam(':id_variete', $variete);
		try
		{
			$sql->execute();
		}
		catch(Exception $e)
		{
			$erreur = 'L\'opération a échouée : '.$e->getMessage();
		}
	}
}

//Suppression du label aoc à une variete
//Si ckbRetirer est coché
if(isset($_POST['ckbRetirer']))
{
	//Pour chaque checkbox nommée ckbRetirer
	foreach($_POST['ckbRetirer'] as $variete)
	{
		//Mettre à jour la champ AOC avec la valeur 0
		$sql = $connexion->prepare('UPDATE variete SET AOC = 0 WHERE id_variete = :id_variete');
		$sql->bindParam(':id_variete', $variete);
		try
		{
			$sql->execute();
		}
		catch(Exception $e)
		{
			$erreur = 'L\'opération a échouée : '.$e->getMessage();
		}
	}
}

/*
//Ajout d'une variété
if(isset($_POST['txt_libelle_variete']) && !empty($_POST['txt_libelle_variete']))
{
	$libelle_variete = addslashes($_POST['txt_libelle_variete']);

	//Vérifie si cette variété n'est pas déjà présente
	$sql = $connexion->prepare('SELECT count(*) AS compteur FROM variete WHERE libelle_variete = :libelle_variete');
	$sql->bindParam(':libelle_variete', $libelle_variete);
	try
	{
		$sql->execute();
		$donnees_variete = $sql->fetch();
		if($donnees_variete['compteur'] == 0) //La variété n'existe pas
		{
			$sql = $connexion->prepare('INSERT INTO variete(libelle_variete) VALUES(:libelle_variete)');
			$sql->bindParam(':libelle_variete', $libelle_variete);
			try
			{
				$sql->execute();
			}
			catch(Exception $e)
			{
				echo('Erreur : '.$e->getMessage());
			}
		}
		else //La variété existe déjà
		{
			header('location: ../interface/varietes.php?msg=1');
		}
	}
	catch(Exception $e)
	{
		echo('Erreur : '.$e->getMessage());
	}
}
*/

$sql->closeCursor(); //Ferme l'objet PDO


//Redirection
if(isset($erreur))
{
	//Une erreur a été rencontrée on redirige et on affiche le message
	header('location: ../interface/varietes.php?err='.$erreur);
}
else
{
	header('location: ../interface/varietes.php?msg=s1');
}

