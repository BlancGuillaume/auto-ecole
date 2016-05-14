<?php 
	// PAGE DISPONIBLE UNIQUEMENT PAR L'ADMINISTRATEUR : sinon redirection à la page de connexion
    session_start();
    if (!isset($_SESSION['login']) && empty($_SESSION['login']))
    {
      header('Location: connexion.php');
    }
    // TO DO : CONNEXION A LA BASE DE DONNEES
 	// include('bd/accessBD.php'); 
	// $bd = new accessBD;
	// $bd->connect();

	/* TO DO : POUR LA CONNEXION : affichage alerte si erreur de connexion */
	// if ($_SESSION['erreurConnection'] == -1) {
	// 	unset($_SESSION['erreurConnection']);
	// 	echo '<script>alert("Echec de la connection : mail ou mot de passe invalide.");</script>';
	// }

	include('..\model\provider\EleveProvider.php');
	$eleves = EleveProvider::get_eleves();
	$clients = ClientProvider::get_clients();
	
   // On regarde si le formulaire a été complété 
	// TO DO : ajout rafraichissement page
    if (!empty($_POST)) {
   		/*********** DONNEES SUR L'ELEVE ***********/
		$nombre_tickets =  isset($_POST['nombreTickets']) ? $_POST['nombreTickets'] : NULL;
		$eleve_achat = isset($_POST['eleveAchat']) ? addslashes($_POST['eleveAchat']) : NULL;
		$client_achat = isset($_POST['clientAchat']) ? addslashes($_POST['clientAchat']) : NULL;

		$erreurMessage1 = "L\'ajout a échouée, le(s) champ(s) suivant(s) doivent être complétés : \\n";
		$erreurMessage2 = "L\'ajout a échouée :\\n";
		$erreurFormulaire = 0;

		if (!is_numeric($nombre_tickets)) {
			$erreurMessage2 .= "le nombre de tickets doit être un nombre entier\\n";
			$erreurFormulaire = 2;
		}
		if (empty($eleve_achat)) {
			$erreurMessage1 .= "Eleve\\n";
			$erreurFormulaire = 1;
		}
		if (empty($client_achat)) {
			$erreurMessage1 .= "Client\\n";
			$erreurFormulaire = 1;
		}
		if (empty($nombre_tickets)) {
			$erreurMessage1 .= "Nombre de tickets\\n";
			$erreurFormulaire = 1;
		}

		if ($erreurFormulaire == 1) {
			// Il y a eu une erreur
			echo "<script> alert('".$erreurMessage1."');</script>";
		} 
		elseif ($erreurFormulaire == 2) {
			// Il y a eu une erreur
			echo "<script> alert('".$erreurMessage2."');</script>";
		} 
		else {
			// AFFICHAGE VERIFICATION
			var_dump("eleve_achat : " . $eleve_achat);
			var_dump("client_achat : " . $client_achat);
			var_dump("nombre_tickets : " . $nombre_tickets);
		}
	}
?>
<!DOCTYPE HTML>
<html>
	<head>
	<meta charset="utf-8" />
		<title>Auto-école</title>
		<link href="css/bootstrap.css" rel="stylesheet" type="text/css">
		<link href="css/bootstrap-theme.min.css" rel="stylesheet" type="text/css">
		<link href="css/bootstrap-theme.css" rel="stylesheet" type="text/css">
		<link href="css/bootstrap.min.css" rel="stylesheet" type="text/css">
		<link href="css/style.css" rel="stylesheet" type="text/css">
	</head>
	<body>
		<!--Import jQuery before materialize.js-->
		<script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
		<script type="text/javascript" src="js/bootstrap.min.js"></script>
		<script type="text/javascript" src="js/bootstrap.js"></script>
		<script type="text/javascript" src="js/npm.js"></script>
		<script type="text/javascript" src="js/jquery-1.12.3.min.js"></script>
		<script type="text/javascript" src="js/script.js"></script>
		<script type="text/javascript" src="js/jquery-ui.js"></script>
		<script type="text/javascript" src="js/jquery-ui.min.js"></script>
		<header>
		<!-- Navigation -->
        <?php include('nav.php');?>

		</header>
		<form class="formulaire" action="ajoutAchat.php" method="post">
			<div id="formulaireAjoutLecon" class="sectionsFormulaireEleve">
				<h3>Achat</h3>
				<div class="input-group">
					<span class="input-group-addon" id="basic-addon1">Client</span>
					<select class="form-control" name="eleveAchat">
						<?php 
                            foreach ($eleves as $eleve) {
                            	echo "<option value=" . $eleve->get_id() . ">" . $eleve->get_prenom() . " " . $eleve->get_nom() . "</option>";
                            }
					    ?>
					</select>
				</div>
				<div class="input-group">
					<span class="input-group-addon" id="basic-addon1">Eleve</span>
					<select class="form-control" name="clientAchat">
						<?php 
                            foreach ($clients as $client) {
                            	echo "<option value=" . $client->get_id() . ">" . $client->get_prenom() . " " . $client->get_nom() . "</option>";
                            }
					    ?>
					</select>
				</div>
				<div class="input-group">
					<span class="input-group-addon" id="basic-addon1">Nombre de tickets</span>
					<input name="nombreTickets" type="text" class="form-control" aria-describedby="basic-addon1">
				</div>
    		</div>
    		<button id="boutonAjoutLecon" type="submit" name="action">Acheter</button>
		</form>

	</body>
</html>