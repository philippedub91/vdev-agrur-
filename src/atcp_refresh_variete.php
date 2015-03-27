<?php
//Importe la connexion à la base de données
include('bdd_connect.php');

$keyword = '%'.$_POST['keyword'].'%';
$sql = "SELECT * FROM variete WHERE libelle_variete LIKE (:keyword) ORDER BY id_variete ASC LIMIT 0, 10";
$query = $connexion->prepare($sql);
$query->bindParam(':keyword', $keyword, PDO::PARAM_STR);
try
{
	$query->execute();
}
catch(Exception $e)
{
	echo('Erreur : '.$e->getMessage());
}
$query->execute();
$list = $query->fetchAll();
foreach ($list as $rs) {
	// put in bold the written text
	$nom_commune = str_replace($_POST['keyword'], '<b>'.$_POST['keyword'].'</b>', $rs['libelle_variete']);
	// add new option
    echo '<li onclick="set_item(\''.str_replace("'", "\'", $rs['libelle_variete']).'\')">'.$nom_commune.'</li>';
}
?>