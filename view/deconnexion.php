<?php
	// DECONNEXION + DESTRUCTION DES VARIABLES SESSION + REDIRECTION VERS LA PAGE DE CONNEXION
	session_start();
	session_unset();
	session_destroy();
	header('Location: connexion.php');
	exit();
?>