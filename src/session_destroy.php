<?php
session_start();

//Tente de fermer la session
try
{
	session_destroy();
}
catch(Exception $e)
{
	echo('Erreur : '.$e->getMessage());
}

header('location: ../interface/index.php'); //Redirige vers la page de connexion
?>