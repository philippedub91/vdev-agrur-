<?php
session_start();

//Importations
include('bdd_connect.php'); //Connexion à la base de données


//Ajout d'une certification
//Vérifie si tous les champs sont bien remplis
if(isset($_POST['txt_libelle_certif']))
{
	//Préparation de la requête
	$sql = $connexion->prepare('INSERT INTO certification(libelle_certif) VALUES(:libelle_certif)');
	$sql->bindParam(':libelle_certif', $_POST['txt_libelle_certif']);
	try
	{
		//Envoi de la requête
		$sql->execute();
	}
	catch(Exception $e)
	{
		$erreur = 'La certification n\'a pas pu être ajoutée : '.$e->getMessage();
	}

	$sql->closeCursor(); //Ferme l'objet PDO
}
else //Si tous les champs ne sont pas saisis.
{
	$erreur = 'Le libellé de la certification semble être vide.';
}


//Redirection vers la page de gestion des variétés
if(isset($erreur)) //S'il y a une erreur renvoi vers la page certification avec le code erreur.
{
	header('location: ../interface/certifications.php?err='.$erreur);
}
else //Il n'y a pas d'erreur
{
	header('location: ../interface/certifications.php?msg=Certification ajoutée !');	
}

