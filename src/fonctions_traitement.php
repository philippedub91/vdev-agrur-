<?php

/**
 * Fonction qui affiche la liste de tous les vergers sous forme de liste
 *
 * @global pdo $connexion  : Objet de connexion à la base de données
 */
function afficherVerger()
{
	global $connexion;

	$sql = $connexion->query('SELECT id_verger nom_verger FROM verger');
	try
	{
		$sql->execute();
		while($donnees_verger = $sql->fetch())
		{
		?>
			<li>
				<a href="gerer_verger.php?verger=<?php echo($donnees_verger['id_verger']); ?>"><?php echo($donnees_verger['nom_verger']); ?></a>
			</li>
		<?php
		}
	}
	catch(Exception $e)
	{
		echo('Erreur : '.$e->getMessage());
	}
}




/**
 * Fonction qui affiche tous les vergers d'un producteur sous forme de liste
 *
 * @param int $id_producteur : Identifiant du producteur dans la base de données
 *
 * @global pdo $connexion : Objet de connexion à la base de données
 */
function afficherVergerProducteur($num_prod)
{
	global $connexion;

	echo('bonjour');

	$sql = $connexion->prepare('SELECT id_verger nom_verger FROM verger WHERE num_prod = :num_prod');
	$sql->bindParam(':num_prod', $num_prod);
	try
	{
		$sql->execute();
		while($donnees_verger = $sql->fetch())
		{
		?>
			<li>
				<a href="gerer_verger.php?verger=<?php echo($donnees_verger['id_verger']); ?>"><?php echo($donnees_verger['nom_verger']); ?></a>
			</li>
		<?php
		}
	}
	catch(Exception $e)
	{
		echo('Erreur : '.$e->getMessage());
	}
}

?>