<?php
session_start();

//Importations
include('bdd_connect.php'); //Connexion à la base de données


//Modification d'une certification
//Vérifie si tous les champs sont bien remplis
if(isset($_POST['lst_calibre']))
{
	if(isset($_POST['sld_quantite']))
	{
		if(isset($_POST['hd_livraison']))
		{
			if(isset($_POST['lst_type_produit']))
			{
				//Prépare la requête d'ajout du lot
				$sql = $connexion->prepare('INSERT INTO lot_production(calibre, type_produit, poids) VALUES(:calibre, :type_produit, :poids)');
				$sql->bindParam(':calibre', $_POST['lst_calibre']);
				$sql->bindParam(':type_produit', $_POST['lst_type_produit'] );
				$sql->bindParam(':poids', $_POST['sld_quantite']);

				try
				{
					$sql->execute(); //Envoi la requête

					//Récupère l'id de la dernière entrée dans la table lot_production
					$sql = $connexion->query('SELECT MAX(id_lot) AS max FROM lot_production');
					$donnees_lot = $sql->fetch();

					//Créé le lien en le lot et la livraison dans la table composer
					$sql = $connexion->prepare('INSERT INTO composer(id_lot, id_livraison, quantite) VALUES(:id_lot, :id_livraison, :quantite)');
					$sql->bindParam(':id_lot', $donnees_lot['max']);
					$sql->bindParam(':id_livraison', $_POST['hd_livraison']);
					$sql->bindParam(':quantite', $_POST['sld_quantite']);
					try
					{
						$sql->execute();

						//Retire la quantité du lot à la quantité de la livraison
						$sql = $connexion->prepare('UPDATE livraison SET poids = (poids - :quantite) WHERE id_livraison = :id_livraison');
						$sql->bindParam(':quantite', $_POST['sld_quantite']);
						$sql->bindParam(':id_livraison', $_POST['hd_livraison']);
						try
						{
							$sql->execute();
						}
						catch(Exception $e)
						{
							$erreur = 'Le lot n\'a pas pu être créé : '.$e->getMessage();
						}
					}
					catch(Exception $e)
					{
						$erreur = 'Le lot n\'a pas pu être créé : '.$e->getMessage();
					}
				}
				catch(Exception $e)
				{
					$erreur = 'Le lot n\'a pas pu être créé : '.$e->getMessage();
				}
			}
			else
			{
				$erreur = 'Le type de produit ne semble pas renseigné';
			}
		}
		else
		{
			$erreur = 'DrruurRRP tanaNDuh! - Erreur interne à l\'application';
		}
	}
	else //Si tous les champs ne sont pas saisis.
	{
		$erreur = 'La quantité ne semble pas renseignée.';
	}
}
else
{
	$erreur = 'Le calibre ne semble pas renseigné.';
}


//Redirection vers la page de gestion des variétés
if(isset($erreur)) //S'il y a une erreur renvoi vers la page certification avec le code erreur.
{
	header('location: ../interface/creer_lot_gestionnaire.php?livraison='.$_POST['hd_livraison'].'&err='.$erreur);
}
else //Il n'y a pas d'erreur
{
	header('location: ../interface/creer_lot_gestionnaire.php?msg=Lot créé avec succès !');	
}

