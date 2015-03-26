<?php
//Fichier de paramètres :
require_once('parametres.php');
//Connexion au serveur
//Configuration
$dns ='mysql:host='.$serveur.';dbname='.$bdd;

// Options de connexion
//1er option : encodage en utf8
//2eme option :"Active" les exceptions 
$options = array(PDO::MYSQL_ATTR_INIT_COMMAND    => "SET NAMES utf8",PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
try 
{	
	$connexion = new PDO($dns,$utilisateur,$motDePasse,$options);	
} 
catch ( Exception $e ) 
{
	echo "Connexion a MySQL impossible : ", $e->getMessage();
	die();
}
?>