<?php 
    // PAGE DISPONIBLE UNIQUEMENT PAR L'ADMINISTRATEUR : sinon redirection à la page de connexion
    session_start();
    if (!isset($_SESSION['login']) && empty($_SESSION['login']))
    {
      header('Location: connexion.php');
    }
	include('..\model\provider\FormuleProvider.php');
	// include('../Model/Formule.php');
   // On regarde si le formulaire a été complété 
	// TO DO : ajout rafraichissement page
    if (!empty($_POST)) {
   		/*********** DONNEES SUR LA FORMULE ***********/
		// Récupération de toutes les informations sur la formule
		$prix_formule =  isset($_POST['prixFormule']) ? addslashes($_POST['prixFormule']) : NULL;
		$nb_tickets_formule =  isset($_POST['nbTicketsFormule']) ? addslashes($_POST['nbTicketsFormule']) : NULL;
		$prix_lecon_formule = isset($_POST['prixLeconFormule']) ? addslashes($_POST['prixLeconFormule']) : NULL; 
		$details_formule = isset($_POST['detailsFormule']) ? addslashes($_POST['detailsFormule']) : NULL; 
		
		// Plusieurs champs obligatoires peuvent avoir été omis.
		// On va consruire le message au fur et a mesure
		$erreurMessage1 = "L\'ajout a échouée, le(s) champ(s) suivant(s) doivent être complétés : \\n";
		$erreurMessage2 = "L\'ajout a échouée :\\n";
		$erreurFormulaire = 0;

		if (!is_numeric($prix_formule)) {
			$erreurMessage2 .= "le prix doit être un nombre\\n";
			$erreurFormulaire = 2;
		}
		if (!is_numeric($nb_tickets_formule)) {
			$erreurMessage2 .= "le nombre de tickets doit être un nombre\\n";
			$erreurFormulaire = 2;
		}
		if (!is_numeric($prix_lecon_formule)) {
			$erreurMessage2 .= "le prix d\'une leçon doit être un nombre";
			$erreurFormulaire = 2;
		}
		if (empty($prix_formule)) {
			$erreurMessage1 .= "le prix de la formule\\n";
			$erreurFormulaire = 1;
		}
		if (empty($nb_tickets_formule)) {
			$erreurMessage1 .= "le nombre de tickets dans la formule\\n";
			$erreurFormulaire = 1;
		}
		if (empty($prix_lecon_formule)) {
			$erreurMessage1 .= "le nombre de tickets dans la formule";
			$erreurFormulaire = 1;
		}
		 
		// Affichage de la pop du succès de la réservation, ou de l'echec dans le cas contraire
		if ($erreurFormulaire == 1) {
			// Il y a eu une erreur
			echo "<script> alert('".$erreurMessage1."');</script>";
		} 
		elseif ($erreurFormulaire == 2) {
			// Il y a eu une erreur
			echo "<script> alert('".$erreurMessage2."');</script>";
		} 
		else {
			$formule = new Formule(NULL, $prix_formule, $nb_tickets_formule, $prix_lecon_formule, $details_formule);
			FormuleProvider::ajout_formule($formule);
			// AFFICHAGE VERIFICATION
			// var_dump("prix_formule : " . $prix_formule);
			// var_dump("nb_tickets_formule : " . $nb_tickets_formule);
			// var_dump("prix_lecon_formule : " . $prix_lecon_formule);
			// var_dump("details_formule : " . $details_formule);

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
		<form id="page-wrapper" action="ajoutFormule.php" method="post">
			<div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Ajout d'une nouvelle formule</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <div class="row">
                <div class="col-lg-12">
                	<div class="panel panel-default">
                		<div class="panel-body">
							<div id="formulaireInfosEleve" class="sectionsFormulaireEleve">
								<h3>Formule</h3>
								<div class="input-group">
									<span class="input-group-addon" id="basic-addon1">Prix</span>
									<input name="prixFormule" type="text" class="form-control" aria-describedby="basic-addon1">
								</div>
								<div class="input-group">
									<span class="input-group-addon" id="basic-addon1">Nombre de tickets</span>
									<input name="nbTicketsFormule" type="text" class="form-control" aria-describedby="basic-addon1">
								</div>
								<div class="input-group">
									<span class="input-group-addon" id="basic-addon1">Prix d'une leçon</span>
									<input name="prixLeconFormule" type="text" class="form-control" aria-describedby="basic-addon1">
								</div>
								<div class="input-group">
									<span class="input-group-addon" id="basic-addon1">Détails</span>
									<textarea name="detailsFormule" type="text" class="form-control" aria-describedby="basic-addon1" placeholder="Ex: Lecons de code à volonte Lecon de conduite à prendre"></textarea>
								</div>
				    		</div>
					    </div>
			    	</div>
			    </div>
			</div>
    		<button id="boutonAjout" name="action" type="submit" class="btn btn-primary">Inscrire</button>
    		<br/>
		</form>

	</body>
</html>