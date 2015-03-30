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

/**
 * Fonction qui vérifie si le verger dont l'id est donné en paramètre, existe
 * 
 * @param int $idVerger : Identifiant du verger dans la base de données.
 *
 * @global pdo $connexion : Objet pdo de connexion à la base de données.
 *
 * @return boolean $return : TRUE si le verger existe, FALSE si le verger n'existe pas.
 *
 */
function vergerExiste($idVerger)
{
	global $connexion;
	$sql = $connexion->prepare('SELECT count(id_verger) AS compteur FROM verger WHERE id_verger = :id_verger');
	$sql->bindParam(':id_verger', $idVerger);
	try
	{
		$sql->execute();
		$donnees_verger = $sql->fetch();
	}
	catch(Exception $e)
	{
		echo('Erreur : '.$e->getMessage());
	}
}

?>