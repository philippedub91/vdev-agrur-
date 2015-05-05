<?php
if(isset($_POST['lst_variete']) && !empty($_POST['lst_variete']))
{
	if(isset($_POST['lst_type']) && !empty($_POST['lst_type']))
	{
		if(isset($_POST['lst_calibre']) && !empty($_POST['lst_calibre']))
		{
			header('location: ../interface/commander_client.php?var='.$_POST['lst_variete'].'&type='.$_POST['lst_type'].'&cal='.$_POST['lst_calibre']);
		}
	}
}



//Une ou plusieurs variables n'ont pas été initialisées,
//l'utilisateur est redirigé vers la page de commande
//avec un message d'erreur.
//header('location: ../interface/commander_client.php?msg=1');