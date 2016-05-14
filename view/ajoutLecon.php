<?php 
	// PAGE DISPONIBLE UNIQUEMENT PAR L'ADMINISTRATEUR : sinon redirection à la page de connexion
    session_start();
    if (!isset($_SESSION['login']) && empty($_SESSION['login']))
    {
      header('Location: connexion.php');
    }

	include('..\model\provider\EleveProvider.php');
	$eleves = EleveProvider::get_eleves();
	//include('..\model\provider\SalarieProvider.php');
	$salaries = SalarieProvider::get_salaries();
	//include('..\model\provider\VoitureProvider.php');
	$voitures = VoitureProvider::get_voitures();
	
   // On regarde si le formulaire a été complété 
	// TO DO : ajout rafraichissement page
    if (!empty($_POST)) {
   		/*********** DONNEES SUR L'ELEVE ***********/
		$date_lecon =  isset($_POST['dateLecon']) ? addslashes($_POST['dateLecon']) : NULL;
		$eleve_lecon = isset($_POST['eleveLecon']) ? addslashes($_POST['eleveLecon']) : NULL;
		$salarie_lecon = isset($_POST['salarieLecon']) ? addslashes($_POST['salarieLecon']) : NULL;
		$voiture_lecon = isset($_POST['voitureLecon']) ? addslashes($_POST['voitureLecon']) : NULL;

		$erreurMessage1 = "L\'ajout a échouée, le(s) champ(s) suivant(s) doivent être complétés : \\n";
		$erreurFormulaire = 0;

		if (empty($date_lecon)) {
			$erreurMessage1 .= "Date\\n";
			$erreurFormulaire = 1;
		}
		if (empty($eleve_lecon)) {
			$erreurMessage1 .= "Eleve\\n";
			$erreurFormulaire = 1;
		}
		if (empty($salarie_lecon)) {
			$erreurMessage1 .= "Salarié\\n";
			$erreurFormulaire = 1;
		}
		if (empty($voiture_lecon)) {
			$erreurMessage1 .= "Voiture\\n";
			$erreurFormulaire = 1;
		}

		if ($erreurFormulaire == 1) {
			// Il y a eu une erreur
			echo "<script> alert('".$erreurMessage1."');</script>";
		} 
		else {
			// AFFICHAGE VERIFICATION
			// var_dump("date_lecon : " . $date_lecon);
			// var_dump("eleve_lecon : " . $eleve_lecon);
			// var_dump("salarie_lecon : " . $salarie_lecon);
			// var_dump("voiture_lecon : " . $voiture_lecon);
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
		<script>
		  $(function() {
		    $( "#datepicker" ).datepicker();
		  });
		  </script>
		<header>
		<!-- Navigation -->
        <?php include('nav.php');?>

		</header>
		<form class="formulaire" action="ajoutLecon.php" method="post">
			<div id="formulaireAjoutLecon" class="sectionsFormulaireEleve">
				<h3>Leçon</h3>
				<div class="input-group">
					<span class="input-group-addon" aria-hidden="true">Date</span>
					<input name="dateLecon" type="text" class="form-control" placeholder="TO DO : datepicker" aria-describedby="basic-addon1">
				</div>

				<div class="input-group">
					<span class="input-group-addon" id="basic-addon1">Eleve</span>
					<select class="form-control" name="eleveLecon">
						<?php 
                            foreach ($eleves as $eleve) {
                            	echo "<option value=" . $eleve->get_id() . ">" . $eleve->get_prenom() . " " . $eleve->get_nom() . "</option>";
                            }
					    ?>
					</select>
				</div>

				<div class="input-group">
					<span class="input-group-addon" id="basic-addon1">Salarie</span>
					<select class="form-control" name="salarieLecon">
						<?php 
                            foreach ($salaries as $salarie) {
                            	echo "<option value=" . $salarie->get_id() . ">" . $salarie->get_prenom() . " " . $salarie->get_nom() . "</option>";
                            }
					    ?>
					</select>
				</div>

				<div class="input-group">
					<span class="input-group-addon" id="basic-addon1">Voiture</span>
					<select class="form-control" name="voitureLecon">
						<?php 
                            foreach ($voitures as $voiture) {
                            	echo "<option value=" . $voiture->get_id() . ">" . $voiture->get_id() . " " . $voiture->get_immatriculation() . "</option>";
                            }
					    ?>
					</select>
				</div>
    		</div>
    		<button id="boutonAjoutLecon" type="submit" name="action">Ajouter</button>
		</form>

	</body>
</html>