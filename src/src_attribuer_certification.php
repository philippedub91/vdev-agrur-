<?php
session_start();

//Importations
include('bdd_connect.php'); //Connexion à la base de données
include('fonctions_traitement.php'); //Fichier de fonctions



if(isset($_POST['hd_prod']))
{
	//Supprime toutes les certifications attribuées au producteur
	$sql = $connexion->prepare('DELETE FROM posseder WHERE num_prod = :num_prod');
	$sql->bindParam(':num_prod', $_POST['hd_prod']);
	try
	{	
		//Execute et vérifie que l'execution s'est bien déroulée
		if($sql->execute())
		{
			if(isset($_POST['ckb_certification']))
			{
				//Pour chaque checkbox (certification) envoi un requete demandant d'ajouter la certification
				foreach($_POST['ckb_certification'] as $certification)
				{
					//Préparation et envoi de la requête
					$sql = $connexion->prepare('INSERT INTO posseder(id_certif, num_prod, date_obtention) VALUES(:id_certif, :num_prod, now())');
					$sql->bindParam(':id_certif', $certification);
					$sql->bindParam(':num_prod', $_POST['hd_prod']);
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
		}
	}
	catch(Exception $e)
	{
		echo('Erreur : '.$e->getMessage());
	}
}
else
{
	$erreur = 'e6';
}





//Redirige l'utilisateur vers la page de gestion du producteur
if(isset($erreur)) //Une erreur a été rencontrée
{
	header('location: ../interface/gerer_producteur.php?msg='.$erreur.'&prod='.$_POST['hd_prod']);
}
else //Il n'y a pas d'erreurs
{
	header('location: ../interface/gerer_producteur.php?prod='.$_POST['hd_prod'].'&msg=s1');
}

//header('location: ../interface/ajout_verger.php?msg='.$erreur); 
