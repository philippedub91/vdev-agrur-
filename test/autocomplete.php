<?php
	
	//include('../testserveur/config/parametres_asgard.php');
	require_once('../src/bdd_connect.php');
	
	$query = 'SELECT count(*) FROM `commune` WHERE nom_commune = \'%' . addslashes($_GET['term']) . '%\'';
	$result = $connexion->query($query) or die(print_r($connexion->errorInfo()));
	while($donnees = $result->fetch(PDO::FETCH_ASSOC)) 
	{
			foreach($row as $val)
			$tab[] = $val;
	}

	print json_encode($tab);