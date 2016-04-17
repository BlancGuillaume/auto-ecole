<!DOCTYPE html>
<html>
<head>

</head>
<body>
<h1>Script de connexion Oracle librairie OCI</h1>
<?php
	// CONNEXION
	// BDD Oracle locale, sp�cification de l'instance de la BDD dans le fichier tnsnames.ora en troisi�me param�tre de la fonction oci_connect(), ne fonctionne pas chez moi en local.
	// Login : xav; pwd : xav
	// $conn = oci_connect('xav', 'xav', 'localhost:1521/XE');
	$conn = oci_connect('xav', 'xav');
	if (!$conn) {
		$e = oci_error();
		echo "ERREUR DE CONNEXION : ". $e['message'];
	} else {
		// Formalisation de la requete
		$req = oci_parse($conn, 'SELECT nom FROM personnes');
		// execution de la requ�te
		oci_execute($req);
		// Affichage du r�sultat
		while ($row = oci_fetch_array($req)) {
			foreach ($row as $item) {
				echo $item.'<br/>';
			}
		}
	}
?>
</body>
</html>
