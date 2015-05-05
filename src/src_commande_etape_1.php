<?php
if(isset($_POST['lst_variete']) && !empty($_POST['lst_variete']))
{
	if(isset($_POST['lst_type']) && !empty($_POST['lst_type']))
	{
		header('location: ../interface/commander_client.php?var='.$_POST['lst_variete'].'&type='.$_POST['lst_type']);
	}
}