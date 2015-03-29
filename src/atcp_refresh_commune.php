<?php
//Importe la connexion à la base de données
include('bdd_connect.php');


//Récupère la valeur saisie dans le champ de texte
$keyword = '%'.$_POST['keyword'].'%';

//Récupère les communes dont le nom correspond aux valeurs saisis dans $_POST['keyword'];
$sql = "SELECT * FROM commune WHERE nom_commune LIKE (:keyword) ORDER BY id_commune ASC LIMIT 0, 10";
$sql = $connexion->prepare($sql);
$sql->bindParam(':keyword', $keyword, PDO::PARAM_STR);

//Execute la requete
try
{
	$sql->execute();
	$donnees_commune = $sql->fetchAll();
	foreach ($donnees_commune as $commune) 
	{
		// Met en gras les caractères correspondants à la saisie
		$nom_commune = str_replace($_POST['keyword'], '<b>'.$_POST['keyword'].'</b>', $rs['nom_commune']);
		//Ajoute une nouvelle option à la liste
    	echo '<li onclick="set_item(\''.str_replace("'", "\'", $rs['nom_commune']).'\')">'.$nom_commune.'</li>';
	}
}
catch(Exception $e)
{
	echo('Erreur : '.$e->getMessage());
}

?>