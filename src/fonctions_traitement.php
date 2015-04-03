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

	$sql = $connexion->prepare('SELECT id_verger, nom_verger FROM verger WHERE num_prod = :num_prod');
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
 * Fonction qui permet d'afficher la liste des vergers d'un producteur dont le numéro est donné en paramètre. Il s'agit d'une surcharge de la 
 * méthode afficherVergerProducteur.
 *
 * @param int $num_prod : Identifiant du producteur dans la base de données
 *
 * @global pdo $connexion : Objet PDO de connexion à la base de données
 *
 */
function afficherVergerProducteurLst($num_prod)
{
	global $connexion;

	$sql = $connexion->prepare('SELECT id_verger, nom_verger FROM verger WHERE num_prod = :num_prod');
    $sql->bindParam(':num_prod', $_SESSION['num_prod']);
    try
    {
       	$sql->execute();
        while($donnees_verger = $sql->fetch())
        {
        ?>
            <option value="<?php echo($donnees_verger['id_verger']); ?>"><?php echo($donnees_verger['nom_verger']); ?></option>
        <?php
        }
    }
   	catch(Exception $e)
    {
        echo('Erreur : '.$e->getMessage());
    }
}

/** 
 * Fonction qui permet d'afficher la liste des types de produits
 *
 * @global pdo $connexion : Objet PDO de connexion à la base de données de l'application
 *
 */
function afficherTypeProduitLst()
{
	global $connexion; 

	$sql = $connexion->query('SELECT * FROM type_produit');
    try
    {
        $sql->execute();
        while($donnees_type = $sql->fetch())
        {
        ?>
        	<option value="<?php echo($donnees_type['id_type_produit']); ?>"><?php echo($donnees_type['libelle_type_produit']); ?></option>
        <?php
        }
    }
    catch(Exception $e)
    {
        echo('Erreur : '.$e->getMessage());
    }
}

/**
 * Fonction qui retourne le nom du producteur dont l'identifiant est donné en paramètre
 *
 * @param int $num_prod : Identifiant du producteur dans la base de données
 *
 * @global PDO $connexion : Identifiant de connexion à la base de données
 *
 * @return string $identite_producteur : Nom du producteur
 */
function getIdentiteProducteur($num_prod)
{
	global $connexion;

	$identite_producteur = NULL;

	$sql = $connexion->prepare('SELECT nom, prenom FROM utilisateur U, producteur P WHERE num_prod = :num_prod AND U.token = P.token');
	$sql->bindParam(':num_prod', $num_prod);
	try
	{
		$sql->execute();
		$donnees_utilisateur = $sql->fetch();
		$identite_producteur = $donnees_utilisateur['prenom'].' '.$donnees_utilisateur['nom'];
	}
	catch(Exception $e)
	{
		echo('Erreur : '.$e->getMessage());
	}

	return $identite_producteur;
}


/**
 * Fonction qui retourne le nom d'un verger dont l'identifiant est donné en paramètre
 *
 * @param int $id_verger : Identifiant du verger dans la base de données
 *
 * @global PDO $connexion : Objet PDO de connexion à la base de données
 *
 * @return string $nom_verger : Nom du verger
 *
 */
function getNomVerger($id_verger)
{
	global $connexion;

	$nom_verger = NULL;

	$sql = $connexion->prepare('SELECT nom_verger FROM verger WHERE id_verger = :id_verger');
	$sql->bindParam(':id_verger', $id_verger);
	try
	{
		$sql->execute();
		$donnees_verger = $sql->fetch();
		$nom_verger = $donnees_verger['nom_verger'];
	}
	catch(Exception $e)
	{
		echo('Erreur : '.$e->getMessage());
	}

	return $nom_verger;
}


/**
 * Fonction qui retourne le nom du type d'ont l'identifiant est donné en paramètre
 * 
 * @param int $id_type : Identifiant du type de produit
 *
 * @global PDO $connexion : Objet PDO de connexion à la base de données
 *
 * @return strign $nom_type : Nom du type de produit
 *
 */
function getNomType($id_type)
{
	global $connexion;

	$nom_type = NULL;

	$sql = $connexion->prepare('SELECT libelle_type_produit FROM type_produit WHERE id_type_produit = :id_type_produit');
	$sql->bindParam(':id_type_produit', $id_type);
	try
	{
		$sql->execute();
		$donnees_type_produit = $sql->fetch();
		$nom_type = $donnees_type_produit['libelle_type_produit'];
	}
	catch(Exception $e)
	{
		echo('Erreur : '.$e->getMessage());
	}

	return $nom_type;
}

/**
 * Fonction qui retourne le nom d'une commune dont l'ID est donné en paramètre
 *
 * @param int $idCommune : Id de la commune dont on veut connaître le nom
 *
 * @global pdo $connexion : Objet pdo de connexion à la base de données
 * 
 * @return string $nomCommune : Nom de la commune
 *
 */
function getNomCommune($idCommune)
{
	global $connexion;

	$nomCommune = NULL;

	$sql = $connexion->prepare('SELECT nom_commune FROM commune WHERE id_commune = :id_commune');
	$sql->bindParam(':idCommune', $idCommune);
	try
	{
		$sql->execute();
		$donnees_commune = $sql->fetch();
		$nomCommune = $donnees_commune['nom_commune'];
	}
	catch(Exception $e)
	{
		echo('Erreur : '.$e->getMessage());
	}


	return $nomCommune;
}

/**
 * Fonction qui retourne l'id de la première commune dont le nom est donné en paramètre
 *
 * @param string $nomCommune : Nom de la commune dont on veut connaître l'id
 *
 * @global pdo $connexion : Objet de connexion à la base de données
 *
 * @return int $idCommune : Id de la commune
 *
 */
function getIdCommune($nomCommune)
{
	global $connexion;

	$idCommune = NULL;

	$sql = $connexion->prepare('SELECT id_commune FROM commune WHERE nom_commune = :nom_commune');
	$sql->bindParam(':nom_commune', $nomCommune);
	try
	{
		$sql->execute();
		$donnees_commune = $sql->fetch();
		$idCommune = $donnees_commune['id_commune'];
	}
	catch(Exception $e)
	{
		echo('Erreur : '.$e->getMessage());
	}

	return $idCommune;
}

/**
 * Fonction qui retourne le libelle de la variété dont l'id est donné en paramètre
 *
 * @param int $idVariete : Id de la variété dont on veut connaître le libellé
 *
 * @global pdo $connexion  : Objet de connexion à la base de données
 *
 * @return string $libelleVariete : Libellé de la variété
 *
 */
function getLibelleVariete($idVariete)
{
	global $connexion;

	$libelleVariete = NULL;

	$sql = $connexion->prepare('SELECT libelle_variete FROM variete WHERE id_variete = :id_variete');
	$sql->bindParam(':id_variete', $idVariete);
	try
	{
		$sql->execute();
		$donnees_variete = $sql->fetch();
		$libelleVariete = $donnees_variete['libelle_variete'];
	}
	catch(Exception $e)
	{
		echo('Erreur : '.$e->getMessage());
	}

	return $libelleVariete;
}

/**
 * Fonction qui retourne l'id de la variete dont le libelle est donné en paramètre
 *
 * @param string $libelleVariete : Libelle de la variété dont on veut connaître le libelle
 *
 * @global pdo $connexion : Objet de connexion à la base de données
 *
 * @return string $idVariete : Id de la variété
 *
 */
function getIdVariete($libelleVariete)
{
	global $connexion;

	$idVariete = NULL;

	$sql = $connexion->prepare('SELECT id_variete FROM variete WHERE libelle_variete = :libelle_variete');
	$sql->bindParam(':libelle_variete', $libelleVariete);
	try
	{
		$sql->execute();
		$donnees_variete = $sql->fetch();
		$idVariete = $donnees_variete['id_variete'];
	}
	catch(Exception $e)
	{
		echo('Erreur : '.$e->getMessage());
	}

	return $idVariete;
}

/**
 * Fonction qui crée une commune
 * 
 * @param string $nomCommune : Nom de la commune à créer.
 *
 * @param boolean $aoc : Indique si la commune est AOC (1 si elle est AOC, 0 sinon).
 *
 * @global pdo $connexion : Objet de connexion à la base de données.
 *
 * @return boolean $return : Retourne TRUE si l'insertion a réussie FALSE sinon
 *
 */

function creerCommune($nomCommune, $aoc)
{
	global $connexion;

	$sql = $connexion->prepare('INSERT INTO commune (nom_commune, commune_aoc) VALUES(:nom_commune, :commune_aoc)');
	$sql->bindParam(':nom_commune', $nomCommune);
	$sql->bindParam(':commune_aoc', $aoc);
	try
	{
		$sql->execute();
		$return = TRUE;
	}
	catch(Exception $e)
	{
		$return = FALSE;
	}

	return $return;
}


/**
 * Fonction qui crée une variété
 *
 * @param string $libelleVariete : Libellé de la variété à créer
 *
 * @param boolean $aoc : Indique si la variété est une variété AOC
 *
 * @global pdo $connexion : Objet de connexion à la base de données
 *
 * @return boolean $return : Retourne TRUE si l'insertion a réussie FALSE sinon.
 *
 */
function creerVariete($libelleVariete, $aoc)
{
	global $connexion;

	$sql = $connexion->prepare('INSERT INTO variete(libelle_variete, AOC) VALUES(:libelle_variete, :aoc)');
	$sql->bindParam(':libelle_variete', $libelleVariete);
	$sql->bindParam(':aoc', $aoc);
	try
	{
		$sql->execute();
		$return = TRUE;
	}
	catch(Exception $e)
	{
		$return = FALSE;
	}

	return $return;
}


/**
 * Fonction qui permet d'afficher la liste des variétés
 *
 * @global pdo $connexion : Objet PDO de connexion à la base de données
 *
 */
function afficherVarietes()
{
	global $connexion;

	$sql = $connexion->query('SELECT * FROM variete');
	try
	{
		$sql->execute();
		while($donnees_variete = $sql->fetch())
		{
		?>
			<li>
				<a href="commander_select_prod.php?variete=<?php echo($donnees_variete['id_variete']); ?>"><?php echo($donnees_variete['libelle_variete']); ?></a>
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
 * Fonction qui permet de savoir si un verger est AOC
 * c'est à dire que la variété cultivée et la ville ou se 
 * situe le verger sont considérées comme AOC
 *
 * @param int $idVerger : Identifiant du verger dans la base de données
 *
 * @global pdo $connexion : Objet PDO de connexion à la base de données
 *
 * @var int $idCommune : Identifiant de la commune dans laquelle se trouve le verger
 * @var int $idVariete : Identifiant le variété cultivée dans le verger
 * @var boolean $aoc_commune : Indique si la commune est AOC
 * @var boolean $aoc_variete : Indique si la variété est AOC
 * 
 * @return boolean $return : renvoi TRUE si le verger est AOC, FALSE sinon
 *
 */
/*
function estAOC($idVerger)
{
	global $connexion;

	//Déclaration des variables
	$idCommune = NULL;
	$idVerger = NULL;

	$aoc_commune = FALSE; //Indique si la commune est AOC
	$aoc_variete = FALSE; //Indique si la variété est AOC

	echo('C peut etre dans la fonction erreur testons demain');

	$sql = $connexion->prepare('SELECT id_commune, id_variete FROM verger WHERE id_verger = :id_verger');
	$sql->bindParam(':id_verger', $idVerger);
	try
	{
		$sql->execute();
		$donnees_verger = $sql->fetch();

		$idCommune = $donnees_verger['id_commune'];
		$idVariete = $donnees_verger['id_variete'];


		//Requête qui récupère la valeur de commune_aoc
		$sql = $connexion->prepare('SELECT commune_aoc FROM commune WHERE id_commune = :id_commune');
		$sql->bindParam(':id_commune', $idCommune);
		try
		{
			$sql->execute();
			$donnees_aoc_commune = $sql->fetch();

			$aoc_commune = $donnees_aoc_commune['commune_aoc'];
		}
		catch(Exception $e)
		{
			echo('Erreur : '.$e->getMessage());
		}


		//Requête qui récupère la valeur de AOC dans la table variété
		$sql = $connexion->prepare('SELECT AOC FROM variete WHERE id_variete = :id_variete');
		$sql->bindParam(':id_variete', $idVariete);
		try
		{
			$sql->execute();
			$donnees_aoc_variete = $sql->fetch();

			$aoc_variete = $donnees_aoc_variete['AOC'];
		}
		catch(Exception $e)
		{
			echo('Erreur : '.$e->getMessage());
		}
	}

	//On vérifie si $aoc_commune et $aoc_verger vallent TRUE
	if($aoc_commune == TRUE && $aoc_variete == TRUE)
	{
		$return = TRUE;
	}
	else
	{
		$return = FALSE;
	}

	return $return;
}
*/

?>