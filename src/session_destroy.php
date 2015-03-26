<?php
session_destroy(); //Détruit la session
header('location: ../interface/index.php'); //Redirige vers la page de connexion
?>