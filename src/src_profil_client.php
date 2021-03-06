<?php
session_start();

//Importations
include('bdd_connect.php'); //Connexion à la base de données

//Vérifie si tous les champs sont conformes
if(isset($_POST['txt_nom_client']) && !empty($_POST['txt_nom_client']))
{
	if(isset($_POST['txt_adresse_client']) && !empty($_POST['txt_adresse_client']))
	{
		if(isset($_POST['txt_nom_responsable_achat']) && !empty($_POST['txt_nom_responsable_achat']))
		{
			//Sécurise les valeurs pour éviter les insertions de code
			$nom_client = addslashes($_POST['txt_nom_client']);
			$adresse_client = addslashes($_POST['txt_adresse_client']);
			$nom_responsable_achat = addslashes($_POST['txt_nom_responsable_achat']);

			//Préparation de la requête
			$sql = $connexion->prepare('UPDATE client SET nom_client = :nom_client, adresse_client = :adresse_client, nom_responsable_achat = :nom_responsable_achat WHERE token = :token');
			$sql->bindParam(':nom_client', $nom_client);
			$sql->bindParam(':adresse_client', $adresse_client);
			$sql->bindParam(':nom_responsable_achat', $nom_responsable_achat);
			$sql->bindParam(':token', $_SESSION['token']);

			$sql->closeCursor();

			//Execution de la requete
			try
			{
				$sql->execute();
			}
			catch(Exception $e)
			{
				$erreur = 'Modification du profil impossible : '.$e->getMessage();
			}

			//Modification du mot de passe
			if(isset($_POST['txt_mdp']) && !empty($_POST['txt_mdp']))
			{
				//Vérifie que le champ de vérification est saisi
				if(isset($_POST['txt_repeter_mdp']) && !empty($_POST['txt_repeter_mdp']))
				{
					//Vérifie que les valeurs des deux champs de mot de passe correspondent
					if($_POST['txt_mdp'] == $_POST['txt_repeter_mdp'])
					{
						//Prépare et envoi la requête
						$sql = $connexion->prepare('UPDATE utilisateur SET mdp = :mdp WHERE token = :token');
						$sql->bindParam(':mdp', $_POST['txt_mdp']);
						$sql->bindParam(':token', $_SESSION['token']);
						try
						{
							$sql->execute();
						}
						catch(Exception $e)
						{
							$erreur = ('Modification du mot de passe impossible : '.$e->getMessage());
						}
					}
					else
					{
						$erreur = 'Les deux mot de passe saisis ne correspondent pas.';
					}
				}
				else
				{
					$erreur = 'Le mot de passe doit être saisi deux fois.';
				}
			}
		}
		else
		{
			$erreur = 'Le nom du responsable ne semble pas saisi.';
		}
	}
	else
	{
		$erreur = 'L\'adresse du client ne semble pas renseignée.';
	}
}
else
{
	$erreur = 'Le nom du client ne semble pas renseigné';
}




//Redirection vers la page de gestion des variétés
if(isset($erreur))
{
	//Une erreur a été rencontrée
	header('location: ../interface/profil_client.php?err='.$erreur);
}
else
{
	header('location: ../interface/profil_client.php?msg=Modifications enregistrées !');
}
