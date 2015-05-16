<?php

//Importe la connexion à la base de données
include('bdd_connect.php');


if(isset($_POST['txt_nom']) && !empty($_POST['txt_nom']))
{
	if(isset($_POST['txt_prenom']) && !empty($_POST['txt_prenom']))
	{
		if(isset($_POST['txt_mail']) && !empty($_POST['txt_mail']))
		{
			if(isset($_POST['txt_mdp']) && !empty($_POST['txt_mdp']))
			{
				if(isset($_POST['lst_type_compte']) && !empty($_POST['lst_type_compte']))
				{
					//Initialisation et préparation des variables
					$nom = $_POST['txt_nom'];
					$prenom = $_POST['txt_prenom'];
					$mail  = $_POST['txt_mail'];
					$mdp = sha1($_POST['txt_mdp']); //Crypte le mot de passe en sha1
					$token  = uniqid(); //Génére un identifiant unique
					$type_compte = $_POST['lst_type_compte'];

					//Prépare la requête d'ajout d'un utilisateur
					$sql = $connexion->prepare('INSERT INTO utilisateur(nom, prenom, mail, mdp, token) VALUES(:nom, :prenom, :mail, :mdp, :token)');
					$sql->bindParam(':nom', $nom);
					$sql->bindParam(':prenom', $prenom);
					$sql->bindParam(':mail', $mail);
					$sql->bindParam(':mdp', $mdp);
					$sql->bindParam(':token', $token);
					try
					{
						//Envoi de la requête
						$sql->execute();

						//Vérifie quel type de compte il faut créer et prépare la requête
						switch($type_compte)
						{
							case 'prod':
								$req = ('INSERT INTO producteur(date_adhesion, token) VALUES(now(), :token)');
							break;
							case 'cli':
								$req = ('INSERT INTO client(token) VALUES(:token)');
							break;
							case 'gest':
								$req = ('INSERT INTO gestionnaire(token) VALUES(:token)');
							break;
							default:
							break;
						}

						if(isset($req) && !empty($req))
						{
							//Prépare et envoi la requête
							$sql = $connexion->prepare($req);
							$sql->bindParam(':token', $token);
							try
							{
								$sql->execute();
							}
							catch(Exception $e)
							{
								$erreur = 'e6'; //Erreur interne(base de données)
							}
						} 
					}
					catch(Exception $e)
					{
						$erreur = 'e6'; //Erreur interne (base de données)
					}
				}
				else
				{
					$erreur = 'e6'; //Erreur de saisie
				}
			}
			else
			{
				$erreur = 'e1'; //Erreur de saisie
			}
		}
		else
		{
			$erreur = 'e1'; //Erreur de saisie
		}
	}
	else
	{
		$erreur = 'e1'; //Erreur de saisie
	}
}
else
{
	$erreur = 'e1'; //Erreur de saisie
}


//Redirection de l'utilisateur
if(isset($erreur)) //La création du compte à échouée
{
	header('location: ../interface/espace_gestionnaire.php?msg='.$erreur);
}
else //La création du compte à réussie.
{
	header('location: ../interface/espace_gestionnaire.php?msg=s1');
}



