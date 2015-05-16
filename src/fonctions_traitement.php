<?php

/**
 * Fonction qui affiche la liste de tous les vergers sous forme de liste
 * Cette fonction fait appel à la méthode getNomVerger();
 *
 * @global pdo $connexion  : Objet de connexion à la base de données
 */
function afficherVerger()
{
	global $connexion;

	$sql = $connexion->query('SELECT id_verger, nom_verger FROM verger');
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

	$sql->closeCursor();
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

	$sql->closeCursor();
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

    $sql->closeCursor();
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

    $sql->closeCursor();
}

/**
 * Fonction qui affiche tous les clients sous forme de liste
 * Cette fonction utilise également la méthode getIdentiteClient()
 *
 * @global pdo $connexion : Objet PDO de connexion à la base de données
 *
 */
function afficherClients()
{
	global $connexion;

	$sql = $connexion->query('SELECT num_client, token FROM client');
	try
	{
		$sql->execute();
		while($donnees_client = $sql->fetch())
		{
		?>
			<li data-filtertext="<?php echo(getIdentiteClient($donnees_client['token'])); ?>"><a href="gerer_client.php?client=<?php echo($donnees_client['num_client']); ?>"><?php echo(getIdentiteClient($donnees_client['token'])); ?></a></li>
		<?php
		}
	}
	catch(Exception $e)
	{
		echo('Erreur : '.$e->getMessage());
	}

	if(isset($sql))
	{
		$sql->closeCursor();
	}
}

/**
 * Fonction qui permet d'obtenir le prénom et le nom d'un client en fonction
 * de son identifiant unique
 *
 * @param string $token : Identifiant unique du client
 *
 * @global pdo $connexion : Objet PDO de connexion à la base de données
 *
 */
function getIdentiteClient($token)
{
	global $connexion;

	$identite = ''; //Initialisation de l'identité.

	//Prépare la requête
	$sql = $connexion->prepare('SELECT nom, prenom FROM utilisateur WHERE token = :token');
	$sql->bindParam(':token', $token);
	try
	{
		$sql->execute();
		$donnees_utilisateur = $sql->fetch();

		//Assemble les valeurs pour former une chaine unique
		$identite = $donnees_utilisateur['prenom'].' '.$donnees_utilisateur['nom'];
	}
	catch(Exception $e)
	{
		echo('Erreur : '.$e->getMessage());
	}


	//Si sql est instantié, fermer la connexion
	if(isset($sql))
	{
		$sql->closeCursor();
	}

	return $identite;
}



/**
 * Fonction qui affiche tous les producteurs sous forme de liste
 * Cette fonction utilise également la méthode getIdentiteProducteur()
 *
 * @global pdo $connexion : Objet PDO de connexion à la base de données
 *
 */
function afficherProducteurs()
{
	global $connexion;

	$sql = $connexion->query('SELECT num_prod FROM producteur');
	try
	{
		$sql->execute();
		while($donnees_producteur = $sql->fetch())
		{
		?>
			<li data-filtertext="<?php echo(getIdentiteProducteur($donnees_producteur['num_prod'])); ?>"><a href="gerer_producteur.php?prod=<?php echo($donnees_producteur['num_prod']); ?>"><?php echo(getIdentiteProducteur($donnees_producteur['num_prod'])); ?></a></li>
		<?php
		}
	}
	catch(Exception $e)
	{
		echo('Erreur : '.$e->getMessage());
	}

	if(isset($sql))
	{
		$sql->closeCursor();
	}
}

/**
 * Fonction qui retourne le nom du producteur dont l'identifiant est donné en paramètre
 * Cette fonction utilise deux autres méthodes : getPrenomProducteur et getNomProducteur.
 *
 * @param int $num_prod : Identifiant du producteur dans la base de données
 *
 * @return string $identite_producteur : Nom du producteur
 */
function getIdentiteProducteur($num_prod)
{
	$identite_producteur = NULL;

	try
	{
		$identite_producteur = getPrenomProducteur($num_prod).' '.getNomProducteur($num_prod); 
	}
	catch(Exception $e)
	{
		echo('Erreur : '.$e->getMessage());
	}
	
	return $identite_producteur;
}

/**
 * Fonction qui retourne l'adresse du producteur dont l'identifiant est donné en paramètre
 *
 * @param int $num_prod : Identifiant du producteur dans la base de données
 *
 * @global pdo $connexion : Objet PDO de connexion à la base de données
 *
 * @var string $adresse_prod : Contient l'adresse du producteur. Est initialisée à NULL
 *
 * @return string $adresse_prod 
 *
 */
function getAdresseProducteur($num_prod)
{
	global $connexion;

	$adresse_prod = NULL;

	$sql = $connexion->prepare('SELECT adresse_prod FROM producteur WHERE num_prod = :num_prod');
	$sql->bindParam(':num_prod', $num_prod);
	try
	{
		$sql->execute();
		$donnees_producteur = $sql->fetch();
		$adresse_prod = $donnees_producteur['adresse_prod'];
	}
	catch(Exception $e)
	{
		echo('Erreur : '.$e->getMessage());
	}

	$sql->closeCursor();

	return  $adresse_prod;
}

/**
 * Fonction qui retourne la date d'adhésion du producteur dont l'identifiant est donné en paramètre
 *
 * @param int $num_prod : Identifiant du producteur dans la base de données
 *
 * @global pdo $connexion : Objet PDO de connexion à la base de données
 *
 * @return string $societe_representante : Chaine contenant la société représentant le producteur
 *
 */
function getDateAdhesionProducteur($num_prod)
{
	global $connexion;

	$date_adhesion = NULL;

	$sql = $connexion->prepare('SELECT date_adhesion FROM producteur WHERE num_prod = :num_prod');
	$sql->bindParam(':num_prod', $num_prod);
	try
	{
		$sql->execute();
		$donnees_producteur = $sql->fetch();
		$date_adhesion = $donnees_producteur['date_adhesion'];
	}
	catch(Exception $e)
	{
		echo('Erreur : '.$e->getMessage());
	}

	$sql->closeCursor();

	return $date_adhesion;
}

/**
 * Fonction qui retourne la société représentante du producteur dont l'identifiant est donné en paramètre
 *
 * @param int $num_prod : Identifiant du producteur dans la base de données
 *
 * @global pdo $connexion : Objet PDO de connexion à la base de données
 *
 * @return string $societe_representante : Chaine contenant le nom de la société représentante
 *
 */
function getSocieteRepresentante($num_prod)
{
	global $connexion;

	$societe_representante = NULL;

	$sql = $connexion->prepare('SELECT societe FROM producteur WHERE num_prod = :num_prod');
	$sql->bindParam(':num_prod', $num_prod);
	try
	{
		$sql->execute();
		$donnees_producteur = $sql->fetch();
		$societe_representante = $donnees_producteur['societe'];
	}
	catch(Exception $e)
	{
		echo('Erreur : '.$e->getMessage());
	}

	$sql->closeCursor();

	return $societe_representante;
}

function getRepresentantProducteur($num_prod)
{
	global $connexion;

	$representant_producteur = NULL;

	$sql = $connexion->prepare('SELECT prenom_representant_prod, nom_representant_prod FROM producteur WHERE num_prod = :num_prod');
	$sql->bindParam(':num_prod', $num_prod);
	try
	{
		$sql->execute();
		$donnees_producteur = $sql->fetch();
		$representant_producteur = $donnees_producteur['prenom_representant_prod'].' '.$donnees_producteur['nom_representant_prod'];
	}
	catch(Exception $e)
	{
		echo('Erreur : '.$e->getMessage());
	}

	$sql->closeCursor();

	return $representant_producteur;
}



/**
 * Fonction qui retourne le nom d'un producteur dont l'identifiant est donné en paramètre
 *
 * @param int $num_prod : Identifiant du producteur dans la base de données
 *
 * @global PDO $connexion : Objet PDO de connexion à la base de données
 *
 * @return string $nom_producteur : Nom du producteur
 *
 */
function getNomProducteur($num_prod)
{
	global $connexion;

	$nom_producteur = NULL;

	$sql = $connexion->prepare('SELECT nom FROM utilisateur U, producteur P WHERE num_prod = :num_prod AND U.token = P.token');
	$sql->bindParam(':num_prod', $num_prod);
	try
	{
		$sql->execute();
		$donnees_utilisateur = $sql->fetch();
		$nom_producteur = $donnees_utilisateur['nom'];
	}
	catch(Exception $e)
	{
		echo('Erreur : '.$e->getMessage());
	}

	return $nom_producteur;
}

/**
 * Fonction qui retourne le prenom d'un producteur dont l'identifiant est donné en paramètre
 *
 * @param int $num_prod : Identifiant du producteur dans la base de données
 *
 * @global PDO $connexion : Objet PDO de connexion à la base de données
 *
 * @return string $prenom_producteur : Prenom du producteur
 *
 */
function getPrenomProducteur($num_prod)
{
	global $connexion;

	$prenom_producteur = NULL;

	$sql = $connexion->prepare('SELECT prenom FROM utilisateur U, producteur P WHERE num_prod = :num_prod AND U.token = P.token');
	$sql->bindParam(':num_prod', $num_prod);
	try
	{
		$sql->execute();
		$donnees_utilisateur = $sql->fetch();
		$prenom_producteur = $donnees_utilisateur['prenom'];
	}
	catch(Exception $e)
	{
		echo('Erreur : '.$e->getMessage());
	}

	return $prenom_producteur;
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
 * Fonction qui retourne le libellé d'un conditionnement dont l'identifiant est donné en paramètre
 *
 * @param int $id_conditionnement : Identifiant du conditionnement dont on veut obtenir le nom
 *
 * @global PDO $connexion : Objet PDO de connexion à la base de données
 *
 * @return string $libelle_conditionnement : Libellé du conditionnement + poids du conditionnement
 */
function getLibelleConditionnement($id_conditionnement)
{
	global $connexion;
	
	$libelle_conditionnement = NULL;

	$sql = $connexion->prepare('SELECT libelle_conditionnement, poids_conditionnement FROM conditionnement WHERE id_conditionnement = :id_conditionnement');
	$sql->bindParam(':id_conditionnement', $id_conditionnement);
	try
	{
		$sql->execute();
		$donnees_conditionnement = $sql->fetch();
		$libelle_conditionnement = $donnees_conditionnement['libelle_conditionnement'].' '.$donnees_conditionnement['poids_conditionnement'].' Kg';
	}
	catch(Exception $e)
	{
		echo('Erreur : '.$e->getMessage());
	}

	return $libelle_conditionnement;
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
 * Retourne toutes les informations d'un producteur sous forme de tableau (Array)
 *
 * @param int $idProducteur : Identifiant du producteur dont on veut obtenir toutes les informations
 *
 * @global PDO $connexion : Objet PDO de connexion à la base de données de l'application
 *
 * @return array $donnees_producteur : Tableau contenant toutes les informations d'un producteur
 *
 */
function getProducteur($idProducteur)
{
	global $connexion;
	$donnees_producteur = NULL;

	$sql = $connexion->prepare('SELECT * FROM utilisateur WHERE token = :token');
    $sql->bindParam(':token', $_SESSION['token']);
    try 
    {
      $sql->execute();
      $donnees_utilisateur = $sql->fetch();

      //Données producteur
      $sql = $connexion->prepare('SELECT * FROM producteur WHERE token = :token');
      $sql->bindParam(':token', $_SESSION['token']);
      try
      {
        $sql->execute();
        $donnees_producteur = $sql->fetch();
      }
      catch(Exception $e)
      {
        echo('Erreur : '.$e->getMessage());
      }

    } 
    catch (Exception $e) 
    {
       echo('Erreur : '.$e->getMessage());
    } 

    return $donnees_producteur;
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
 * Fonction qui affiche la liste des certifications que possède un producteur
 *
 * @param int $num_prod : Identifiant du producteur dans la base de données
 *
 * @global pdo $connexion : Objet PDO de connexion à la base de données
 *
 */
function afficherCertificationsProducteur($num_prod)
{
	global $connexion;

	$sql = $connexion->prepare('SELECT id_certif, date_obtention FROM posseder WHERE num_prod = :num_prod');
	$sql->bindParam(':num_prod', $num_prod);
	try
	{
		$sql->execute();
		while($donnees_certification = $sql->fetch())
		{
		?>
			<li><?php echo('<b>'.getLibelleCertif($donnees_certification['id_certif']).'</b> - Obtenu le : '.$donnees_certification['date_obtention']); ?></li>
		<?php
		}
	}
	catch(Exception $e)
	{
		echo('Erreur : '.$e->getMessage());
	}

	$sql->closeCursor();
}


/**
 * Fonction qui permet d'afficher toutes les varietes de noix sous forme de liste déroulante
 *
 * @param string $nomListe : Correspont à l'attribut nom en HTML. Permet d'identifier le champ dans un formulaire
 *
 * @global PDO $connexion : Objet PDO de connexion à la base de données
 *
 */
function listeVariete($nomListe)
{
	global $connexion;

	echo('<select name="'.$nomListe.'" data-native-menu="false">');
	$sql = $connexion->query('SELECT id_variete, libelle_variete FROM variete');
	try
	{
		$sql->execute();
		while($donnees_variete = $sql->fetch())
		{
			echo('<option value="'.$donnees_variete['id_variete'].'">'.$donnees_variete['libelle_variete'].'</option>');
		}
	}
	catch(Exception $e)
	{
		echo('<option>Une erreur rencontrée</option>');
	}
	echo('</select>');
}


/**
 * Fonction qui permet d'afficher tous types de noix sous forme de liste déroulante
 *
 * @param string $nomListe : Correspont à l'attribut nom en HTML. Permet d'identifier le champ dans un formulaire
 *
 * @global PDO $connexion : Objet PDO de connexion à la base de données
 *
 */
function listeType($nomListe)
{
	global $connexion;

	echo('<select name="'.$nomListe.'" data-native-menu="false">');
	$sql = $connexion->query('SELECT id_type_produit, libelle_type_produit FROM type_produit');
	try
	{
		$sql->execute();
		while($donnees_type = $sql->fetch())
		{
			echo('<option value="'.$donnees_type['id_type_produit'].'">'.$donnees_type['libelle_type_produit'].'</option>');
		}
	}
	catch(Exception $e)
	{
		echo('<option>Une erreur rencontrée</option>');
	}
	echo('</select>');
}


/**
 * Fonction qui permet d'afficher tous les calibres sous forme de liste déroulante
 *
 * @param string $nomListe : Correspont à l'attribut nom en HTML. Permet d'identifier le champ dans un formulaire
 *
 * @global PDO $connexion : Objet PDO de connexion à la base de données
 *
 */
function listeCalibre($nomListe)
{
	global $connexion;

	echo('<select name="'.$nomListe.'" data-native-menu="false">');
	$sql = $connexion->query('SELECT id_calibre, libelle_calibre FROM calibre_noix');
	try
	{
		$sql->execute();
		while($donnees_calibre = $sql->fetch())
		{
			echo('<option value="'.$donnees_calibre['id_calibre'].'">'.$donnees_calibre['libelle_calibre'].'</option>');
		}
	}
	catch(Exception $e)
	{
		echo('<option>Une erreur rencontrée</option>');
	}
	echo('</select>');
}

/**
 * Fonction qui affiche la liste des conditionnements sous la forme d'une liste à puces
 * 
 * @global pdo $connexion : Objet PDO de connexion à la base de données
 *
 */
function listeConditionnements()
{
	global $connexion;

	 $sql = $connexion->query('SELECT * FROM conditionnement');
	 try
	 {
	 	$sql->execute();
	 	while($donnees_conditionnement = $sql->fetch())
	 	{
	 	?>
	 		<li><a href="gerer_condi.php?condi=<?php echo($donnees_conditionnement['id_conditionnement']); ?>"><?php echo($donnees_conditionnement['libelle_conditionnement'].' '.$donnees_conditionnement['poids_conditionnement'].' grammes'); ?></a></li>
	 	<?php
	 	}
	 }
	 catch(Exception $e)
	 {
	 	echo('Erreur : '.$e->getMessage());
	 }
}

/**
 * Fonction qui affiche la liste des lots de production dont les caractéristiques
 * correspondent aux valeurs données en paramètre.
 *
 * @param int $id_variete : Identifiant d'une variete dans la base de données
 *
 * @param int $id_produit : Identifiant d'un type de produit dans la base de données
 *
 * @param int $id_calibre : Identifiant d'un calibre de noix dans la base de données
 *
 * @global pdo $connexion : Objet PDO de connexion à la base de données
 *
 */
function afficherLots($id_variete, $id_produit, $id_calibre)
{
	global $connexion; 

	//Création de la balise <ul>
	echo('<ul data-role="listview" data-inset="true">');

	$sql = $connexion->prepare('SELECT LP.poids AS poids, LP.id_lot as id_lot FROM lot_production LP, livraison L WHERE LP.id_livraison = L.id_livraison AND L.type = :type AND L.id_variete = :id_variete AND LP.calibre = :calibre');
	$sql->bindParam(':type', $id_produit);
	$sql->bindParam(':id_variete', $id_variete);
	$sql->bindParam(':calibre', $id_calibre);
	try
	{
		$sql->execute();
		while($donnees_lot = $sql->fetch())
		{
		?>
    	<li>
    		<a href="finaliser_commande_client.php?lot=<?php echo($donnees_lot['id_lot']); ?>"><?php echo("Lot n° : ".$donnees_lot['id_lot']); ?></a>
  		</li>
		<?php
		}
	}
	catch(Exception $e)
	{
		echo('Erreur : '.$e->getMessage());
	}

	//Fermeture de la balise ul
	echo('</ul>');
}


/**
 * Permet d'afficher la liste des certifications enregistrées dans la base de données
 * 
 * @global pdo $connexion : Objet PDO de connexion à la base de données
 *
 */
function afficherCertifications()
{
	global $connexion;

	$sql = $connexion->query('SELECT id_certif, libelle_certif FROM certification');
	try
	{
		$sql->execute();
		while($donnees_certification = $sql->fetch())
		{
		?>
			<li>
				<a href="gerer_certif.php?certif=<?php echo($donnees_certification['id_certif']); ?>"><?php echo($donnees_certification['libelle_certif']); ?></a>
			</li>
		<?php
		}
	}
	catch(Exception $e)
	{
		echo('Erreur : '.$e->getMessage());
	}

	$sql->closeCursor();
}


/**
 * Fonction qui permet d'obtenir le libellé d'une certification
 *
 * @param int $certif : Identifiant de la certification dans la base de données
 *
 * @global pdo $connexion : Objet PDO de connexion à la base de données
 *
 * @return string $libelle_certif : Libelle de la certification
 */
function getLibelleCertif($certif)
{
	global $connexion;

	$libelle_certif = ''; //Initialise la variable

	$sql = $connexion->prepare('SELECT libelle_certif FROM certification WHERE id_certif = :id_certif');
	$sql->bindParam(':id_certif', $certif);
	try
	{
		$sql->execute();
		$donnees_certification = $sql->fetch();
		$libelle_certif = $donnees_certification['libelle_certif']; 
	}
	catch(Exception $e)
	{
		echo('Erreur : '.$e->getMessage());
	}

	return $libelle_certif;
}

/**
 * Focntion qui retourne le libellé d'un calibre
 *
 * @param int $idCalibre : Identifiant du calibre dans la base de données
 *
 * @global pdo $connexion : Objet de connexion à la base de données
 *
 * @return string $libelleCalibre : Libellé du calibre
 *
 */
function getLibelleCalibre($idCalibre)
{
	global $connexion;

	$libelleCalibre = ''; //Initialise la variable

	$sql = $connexion->prepare('SELECT libelle_calibre FROM calibre_noix WHERE id_calibre = :id_calibre');
	$sql->bindParam(':id_calibre', $idCalibre);
	try
	{
		$sql->execute();
		$donnees_calibre = $sql->fetch();
		$libelleCalibre = $donnees_calibre['libelle_calibre']; 
	}
	catch(Exception $e)
	{
		echo('Erreur : '.$e->getMessage());
	}

	return $libelleCalibre;
}


/**
 * Fonction qui permet d'obtenir le type de noix d'un lot
 * 
 * @param int $id_lot : Idenifiant du lot dans la base de données
 * 
 * @global pdo $connexion : objet PDO de connexion à la base de données
 *
 * @return string $type : Libellé du type de la noix
 *
 */
function getTypeNoixLot($id_lot)
{
	global $connexion;

	$libelle_type = NULL;

	$sql = $connexion->prepare('SELECT libelle_type_produit FROM lot_production LP, livraison L, type_produit TP WHERE LP.id_lot = :id_lot AND LP.id_livraison = L.id_livraison AND TP.id_type_produit = L.type');
	$sql->bindParam(':id_lot', $id_lot);
	try
	{
		$sql->execute();
		$donnees_lot = $sql->fetch();
		$libelle_type = $donnees_lot['libelle_type_produit'];
	}
	catch(Exception $e)
	{
		$e->getMessage();
	}

	return $libelle_type; 
}

/**
 * Fonction qui retourne le libelle d'une variété de noix d'un lot
 *
 * @param int $id_lot : Identifiant du lot dans la base de données
 *
 * @global pdo $connexion : objet PDO de connexion à la base de données
 *
 * @return string $libelle_variete : Libelle de la variété
 *
 */
function getLibelleVarieteLot($id_lot)
{
	global $connexion;

	$libelle_variete = NULL;

	$sql = $connexion->prepare('SELECT libelle_variete FROM lot_production LP, livraison L, variete V WHERE LP.id_lot = :id_lot AND LP.id_livraison = L.id_livraison AND V.id_variete = L.id_variete');
	$sql->bindParam(':id_lot', $id_lot);
	try
	{
		$sql->execute();
		$donnees_variete = $sql->fetch();
		$libelle_variete = $donnees_variete['libelle_variete'];
	}
	catch(Exception $e)
	{
		$e->getMessage();
	}

	return $libelle_variete;
}

/**
 * Fonction qui calcul le nombre de conditionnements d'un type donné qu'il est
 * possible de commander pour un lot.
 * 
 * @global pdo $connexion : Objet PDO de connexion à la base de données
 *
 * @param int $id_condi : Identifiant du conditionnement dans la base de données
 *
 * @param int $id_lot : Identifiant du lot dans la base de données
 *
 * @return int $quantite : Quantité de conditionnements possibles du type donnée en paramètre pour le lot donné en paramètre
 *
 */
function getQuantiteCondi($id_condi, $id_lot)
{
	global $connexion;

	$poids_conditionnement = NULL;
	$poids_lot = NULL;

	//Récupère le poids que peut contenir le conditionnement
	$sql = $connexion->prepare('SELECT poids_conditionnement FROM conditionnement WHERE id_conditionnement = :id_conditionnement');
	try
	{
		$sql->execute();
		$donnees_conditionnement = $sql->fetch();
		$poids_conditionnement = $donnees_conditionnement['poids_conditionnement'];
	}
	catch(Exception $e)
	{
		echo('Erreur : '.$e->getMessage());
	}

	$sql->closeCursor();

	//Récupère la quantité du lot
	$sql = $connexion->prepare('SELECT poids FROM lot_production WHERE id_lot = :id_lot');
	$sql->bindParam(':id_lot', $id_lot);
	try
	{
		$sql->execute();
		$donnees_conditionnement = $sql->fetch();
		$poids_lot = $donnees_conditionnement['poids'];
	}
	catch(Exception $e)
	{
		echo('Erreur : '.$e->getMessage());
	}

	//Convertion du poids du conditionnement en kg
	$poids_conditionnement = $poids_conditionnement * 0.001;
	echo('poids conditionnement : '.$poids_conditionnement);
	
	//Calcul de la quantité possible
	$quantite = $poids_lot / $poids_conditionnement;


	return $quantite;
}

/**
 * Fonction qui récupère le poids d'un lot de production
 *
 * @param int $id_lot : Identifiant du lot dans la base de données
 *
 * @global pdo $connexion : Objet PDO de connexion à la base de données
 *
 * @return int $poids : Poids du lot
 *
 */
function getPoidsLot($id_lot)
{
  global $connexion;

  $poids = NULL;

  $sql = $connexion->prepare('SELECT poids FROM lot_production WHERE id_lot = :id_lot');
  $sql->bindParam(':id_lot', $id_lot);
  try
  {
    $sql->execute();
    $donnees_lot = $sql->fetch();
    $poids = $donnees_lot['poids'];
  }
  catch(Exception $e)
  {
    echo('Erreur : '.$e->getMessage());
  }

  return $poids;
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
function estAOC($idVerger)
{
	global $connexion;

	//Déclaration des variables
	$idCommune = NULL;
	$idVariete = NULL;

	$aoc_commune = 0; //Indique si la commune est AOC
	$aoc_variete = 0; //Indique si la variété est AOC

	//Récupère l'identifiant de la commune dans laquelle se trouve le verger
	//Récupère l'identifiant de la variété cultivée dans la commune
	//Préparation de la requête
	$sql = $connexion->prepare('SELECT id_commune, id_variete FROM verger WHERE id_verger = :id_verger');
	$sql->bindParam(':id_verger', $idVerger);
	try
	{
		//Exécution de la requête
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
	catch(Exception $e)
	{
		echo('Erreur : '.$e->getMessage());
	}

	//On vérifie si $aoc_commune et $aoc_verger vallent TRUE
	if($aoc_commune == 1 && $aoc_variete == 1)
	{
		$return = 1;
	}
	else
	{
		$return = 0;
	}

	return $return;
}

/**
 * Fonction qui permet de vérifier si l'utilisateur à les autorisations d'accès à la page
 * et de le rediriger dans le cas contraire
 *
 * @param string $autorisation : Indique quel type d'utilisateur peut accéder à la page : PROD pour les producteurs, CLI pour les clients, et GEST pour les gestionnaires
 *
 * @global pdo $connexion : Objet PDO de connexion à la base de données
 * @global $_SESSION
 *
 */
function sessionVerif( $autorisation)
{
	global $connexion;
	global $_SESSION;

	//Vérifie que la variable $_SESSION['token'] existe
	if(isset($_SESSION['token']))
	{
		switch($autorisation)
		{

			//Sélectionne une requête en fonction du type de compte donné en paramètre
			case 'PROD': //Producteur
				$req = 'SELECT count(num_prod) AS compteur FROM producteur WHERE token = :token';
			break;
			case 'CLI': //Client
				$req = 'SELECT count(num_client) AS compteur FROM client WHERE token = :token';
			break;
			case 'GEST': //Gestionnaire
				$req = 'SELECT count(num_gestionnaire) AS compteur FROM gestionnaire WHERE token = :token';
			break;
			default:
			break;

			//Prépare la requête
			$sql = $connexion->prepare($req);
			$sql->bindParam(':token', $token);
			try
			{
				//Envoi la requête
				$sql->execute();
				$donnees_utilisateur = $sql->fetch();

				if($donnees_utilisateur['compteur'] < 1)
				{
					header('location: index.php');
				}
			}
			catch(Exception $e)
			{
				echo('Erreur : '.$e->getMessage());
			}
		}
	}
	else
	{
		//Redirige vers la page de connexion
		header('location: ../interface/index.php');
	}
}


/**
 * Fonction qui retourne un message en fonction du code
 * donné en paramètre
 *
 * @param string $code : Code du message
 *
 * @return string $message : Contenu du message
 *
 */
function affiMessage($code)
{
	//Sélectionne un message en fonction du code
	switch($code)
	{
		case "e1":
			$message = "Un ou plusieurs champs n'ont pas été correctement saisis";
		break;
		case "e2":
			$message = "Un des champs saisis ne doit pas contenir de caractères numériques";
		break;
		case "e3":
			$message = "Un des champs saisis ne dois contenir que des caractères alphabétiques";
		break;
		case "e4":
			$message = "Les identifiants saisis ne correspondent à aucun utilisateur";
		break;
		case "e5":
			$message = "Votre compte existe bien, mais n'est pas forcément activé";
		break;
		case "e6":
			$message = "Une erreur interne à l'application a été rencontrée. L'opération n'a put être réalisée";
		break;
		case "e7":
			$message = "Votre mot de passe n'est pas saisi";
		break;
		case "e8":
			$message = "Votre adresse mail n'est pas saisie";
		break;
		case "e9":
			$message = "Le nombre d'arbres sélectionnés est inférieur à zéro";
		break;
		case "e10":
			$message = "Les deux mots de passe saisis sont différents";
		break;
		case "e11":
			$message = "Vous n'avez pas confirmé le mot de passe";
		break;
		case "s1":
			$message = "L'opération a été réalisée avec succès";
		break;
		case "s2":
			$message = "Votre commande a bien été enregistrée";
		break;
		case "s3":
			$message = "Votre commande a bien été supprimée";
		break;
		default:
			$message = '';
		break;

		$message = 'connard de merde';

		return $message;
	}
}
?>