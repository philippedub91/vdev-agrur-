<?php
session_start();

if(isset($_POST['txt_mail']) && !empty($_POST['txt_mail']))
{
	if(isset($_POST['txt_mdp']) && !empty($_POST['txt_mdp']))
	{
		$mail = addslashes($_POST['txt_mail']);
		$mdp = sha1($_POST['txt_mdp']);

		//Connexion à la base de données
		require_once('bdd_connect.php'); 

		//Vérifie si le compte saisi existe
		$sql = $connexion->prepare('SELECT count(num) AS compteur, nom, prenom, mail, token FROM utilisateur WHERE mail = :mail AND mdp = :mdp');
		$sql->bindParam(':mail', $mail);
		$sql->bindParam(':mdp', $mdp);
		try
		{
			$sql->execute();
			$donnees_utilisateur = $sql->fetch();
			if($donnees_utilisateur['compteur'] > 0)
			{
				$_SESSION['nom'] = $donnees_utilisateur['nom'];
				$_SESSION['prenom'] = $donnees_utilisateur['prenom'];
				$_SESSION['mail'] = $donnees_utilisateur['mail'];
				$_SESSION['token'] = $donnees_utilisateur['token'];

				//Vérifie si l'utilisateur est client
				$sql = $connexion->prepare('SELECT count(num_client) AS compteur, num_client FROM client WHERE token = :token');
				$sql->bindParam(':token', $donnees_utilisateur['token']);
				try
				{
					$sql->execute();
					$donnees_client = $sql->fetch();

					//L'utilisateur est client
					if($donnees_client['compteur'] == 1)
					{
						$_SESSION['type'] = 'CLI';
						$_SESSION['num_client'] = $donnees_client['num_client'];
					}
					else //Il n'est pas client, on vérifie s'il est producteur
					{
						$sql = $connexion->prepare('SELECT count(num_prod) AS compteur, num_prod FROM producteur WHERE token = :token');
						$sql->bindParam(':token', $donnees_utilisateur['token']);
						try
						{
							$sql->execute();
							$donnees_producteur = $sql->fetch();

							//L'utilisateur est client
							if($donnees_producteur['compteur'] == 1)
							{
								$_SESSION['type'] = 'PROD';
								$_SESSION['num_prod'] = $donnees_producteur['num_prod'];
							}
							else //Il n'est pas client, on vérifie s'il est gestionnaire
							{
								$sql = $connexion->prepare('SELECT count(num_gestionnaire) AS compteur FROM gestionnaire WHERE token = :token');
								$sql->bindParam(':token', $donnees_utilisateur['token']);
								try
								{
									$sql->execute();
									$donnees_gestionnaire = $sql->fetch();
									if($donnees_gestionnaire['compteur'] == 1)
									{
										$_SESSION['type'] = 'GEST';
									}
									else
									{
										header('location: ../interface/index.php?msg=Votre compte existe bien, mais ne semble pas activé. Veuillez contacter l\'administrateur.'); //Le compte existe mais n'est pas activé
									}
								}
								catch(Exception $e)
								{
									echo('Erreur : '.$e->getMessage());
								}
							}
						}
						catch(Exception $e)
						{
							echo('Erreur : '.$e->getMessage());
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
				//Le compte n'existe pas
				header('location: ../interface/index.php?err=Les identifiants saisis ne correspondent a aucun utilisateur.');
			}
		}
		catch(Exception $e)
		{
			echo('Erreur : '.$e->getMessage());
		}

		//Redirection vers l'espace personnel de l'utilisateur
		switch($_SESSION['type'])
		{
			case 'PROD':
				header('location: ../interface/espace_producteur.php');
			break;
			case 'CLI':
				header('location: ../interface/espace_client.php');
			break;
			case 'GEST':
				header('location: ../interface/espace_gestionnaire.php');
			break;
			default;
			break;
		}
	}
	else
	{
		//Le mot de passe n'est pas saisi
		header('location: ../interface/index.php?err=Le champ consacré au mot de passe n\'est pas saisi.'); //Le mot de passe n'est pas saisi
	}
}
else
{
	//L'adresse mail n'est pas saisie
	header('location: ../interface/index.php?err=Le champ consacré à l\'adresse mail n\'est pas saisi.'); //L'adresse mail n'est pas saisie
}