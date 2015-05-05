<?php
class Connexion
{
	private $mail = '';
	private $mdp = '';
	private $active;


	$_SESSION['nom'];
	$_SESSION['prenom'];
	$_SESSION['mail'];
	$_SESSION['token'];
	$_SESSION['type'];
	$_SESSION['num_prod'];
	$_SESSION['num_client'];

	public Connexion($nMail, $nMdp)
	{
		$mail = $nMail;
		$mdp = $nMdp;
		$active = false;
	}

	public verifIdentifiant()
	{
		$sql = $connexion->prepare('SELECT count(num) AS compteur, nom, prenom, mail, token FROM utilisateur WHERE mail = :mail AND mdp = :mdp');
		$sql->bindParam(':mail', $mail);
		$sql->bindParam(':mdp', $mdp);
		try
		{
			$sql->execute();
			$donnees_utilisateur = $sql->fetch();
			if($donnees_utilisateur['compteur'] > 0 )
			{
				$retour = true;
			}
			else
			{
				$retour = false;
			}
		}
		catch(Exception $e)
		{
			$e->getMessage();
		}

		return $retour;
	}


	public initialiserSession()
	{
		$sql = $connexion->prepare('SELECT nom, prenom, mail, token FROM utilisateur WHERE mail = :mail AND mdp = :mdp');
		$sql->bindParam(':mail', $mail);
		$sql->bindParam(':mdp', $mdp);
		try
		{
			$sql->execute();
			$donnees_utilisateur = $sql->fetch();

			$_SESSION['nom'] = $donnees_utilisateur['nom'];
			$_SESSION['prenom'] = $donnees_utilisateur['prenom'];
			$_SESSION['mail'] = $donnees_utilisateur['mail'];
			$_SESSION['token'] = $donnees_utilisateur['token'];
		}
		catch(Exception $e)
		{
			echo('Erreur : '.$e->getMessage());
		}
	}

	public verifierStatut()
	{
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
				$_SESSION['type'] = 'client';
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
						$_SESSION['type'] = 'producteur';
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
								$_SESSION['type'] = 'gestionnaire';
							}
							else
							{
								header('location: ../interface/index.php?msg=2'); //Le compte existe mais n'est pas activé
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

	public activerConnexion()
	{
		$active = true;
	}


}