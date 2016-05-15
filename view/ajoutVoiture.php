<?php 
	// PAGE DISPONIBLE UNIQUEMENT PAR L'ADMINISTRATEUR : sinon redirection à la page de connexion
    session_start();
    if (!isset($_SESSION['login']) && empty($_SESSION['login']))
    {
      header('Location: connexion.php');
    }
    
	include('../Model/provider/VoitureProvider.php');
	$salaries = SalarieProvider::get_salaries();
   // On regarde si le formulaire a été complété 
	// TO DO : ajout rafraichissement page
    if (!empty($_POST)) {
   		/*********** DONNEES SUR LA FORMULE ***********/
		// Récupération de toutes les informations sur la formule
		$immatriculation_voiture =  isset($_POST['immatriculationVoiture']) ? addslashes($_POST['immatriculationVoiture']) : NULL;
		$prix_voiture =  isset($_POST['prixVoiture']) ? addslashes($_POST['prixVoiture']) : NULL;
		$kilometrage_voiture = isset($_POST['kilometrageVoiture']) ? addslashes($_POST['kilometrageVoiture']) : NULL;
		$marque_voiture = isset($_POST['marqueVoiture']) ? addslashes($_POST['marqueVoiture']) : NULL;
		$modele_voiture = isset($_POST['modeleVoiture']) ? addslashes($_POST['modeleVoiture']) : NULL;
		$date_achat_voiture = isset($_POST['dateAchatVoiture']) ? addslashes($_POST['dateAchatVoiture']) : NULL;
		$responsable_voiture = isset($_POST['responsableVoiture']) ? addslashes($_POST['responsableVoiture']) : NULL;

		
		// Plusieurs champs obligatoires peuvent avoir été omis.
		// On va consruire le message au fur et a mesure
		$erreurMessage1 = "L\'ajout a échouée, le(s) champ(s) suivant(s) doivent être complétés : \\n";
		$erreurMessage2 = "L\'ajout a échouée :\\n";
		$erreurFormulaire = 0;

		if (!is_numeric($prix_voiture)) {
			$erreurMessage2 .= "le prix doit être un nombre\\n";
			$erreurFormulaire = 2;
		}
		if (!is_numeric($kilometrage_voiture)) {
			$erreurMessage2 .= "le kilométrage doit être un nombre\\n";
			$erreurFormulaire = 2;
		}
		if (empty($immatriculation_voiture)) {
			$erreurMessage1 .= "l\'immatriculation\\n";
			$erreurFormulaire = 1;
		}
		if (empty($prix_voiture)) {
			$erreurMessage1 .= "le prix\\n";
			$erreurFormulaire = 1;
		}
		if (empty($kilometrage_voiture)) {
			$erreurMessage1 .= "le kilométrage\\n";
			$erreurFormulaire = 1;
		}
		if (empty($marque_voiture)) {
			$erreurMessage1 .= "la marque\\n";
			$erreurFormulaire = 1;
		}
		if (empty($modele_voiture)) {
			$erreurMessage1 .= "la modèle\\n";
			$erreurFormulaire = 1;
		}
		if (empty($date_achat_voiture)) {
			$erreurMessage1 .= "la date d\'achat";
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
			$salarie = SalarieProvider::get_salarie($responsable_voiture);
			$voiture = new Voiture(NULL, $immatriculation_voiture, $date_achat_voiture, $prix_voiture, NULL, $marque_voiture, $modele_voiture, $kilometrage_voiture, $salarie);
			VoitureProvider::ajout_voiture($voiture);
			// AFFICHAGE VERIFICATION
			// var_dump("prix_voiture : " . $prix_voiture);
			// var_dump("immatriculation_voiture : " . $immatriculation_voiture);
			// var_dump("kilometrage_voiture : " . $kilometrage_voiture);
			// var_dump("marqueVoiture : " . $marqueVoiture);
			// var_dump("modeleVoiture : " . $modeleVoiture);
			// var_dump("date_achat_voiture : " . $date_achat_voiture);

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

		<link href="css/jquery-ui.css" rel="stylesheet" type="text/css">
		<link href="css/jquery-ui.min.css" rel="stylesheet" type="text/css">
		<link href="css/jquery-ui.structure.css" rel="stylesheet" type="text/css">
		<link href="css/jquery-ui.structure.min.css" rel="stylesheet" type="text/css">
		<link href="css/jquery-ui.theme.css" rel="stylesheet" type="text/css">
		<link href="css/jquery-ui.theme.min.css" rel="stylesheet" type="text/css">
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
		<script type="text/javascript" src="js/jquery-ui-timepicker-addon-0.6.2.js"></script>
		
		<script>
			jQuery(function($) {
				$('#datepicker').datepicker({ dateFormat: 'yy-mm-dd' });
			});
		</script>
		<header>
			<!-- Navigation -->
	        <?php include('nav.php');?>
		</header>
		<form id="page-wrapper" action="ajoutVoiture.php" method="post">
			<div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Ajout d'une nouvelle voiture</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <div class="row">
                <div class="col-lg-12">
                	<div class="panel panel-default">
                		<div class="panel-body">
							<div id="formulaireInfosEleve" class="sectionsFormulaireEleve">
								<h3>Voiture</h3>
								<div class="input-group">
									<span class="input-group-addon" id="basic-addon1">Immatriculation</span>
									<input name="immatriculationVoiture" type="text" class="form-control" aria-describedby="basic-addon1">
								</div>
								<div class="input-group">
									<span class="input-group-addon" id="basic-addon1">Prix</span>
									<input name="prixVoiture" type="text" class="form-control" aria-describedby="basic-addon1">
								</div>
								<div class="input-group">
									<span class="input-group-addon" id="basic-addon1">Kilométrage</span>
									<input name="kilometrageVoiture" type="text" class="form-control" aria-describedby="basic-addon1">
								</div>
								<div class="input-group">
									<span class="input-group-addon" id="basic-addon1">Marque</span>
									<input name="marqueVoiture" type="text" class="form-control" aria-describedby="basic-addon1">
								</div>
								<div class="input-group">
									<span class="input-group-addon" id="basic-addon1">Modèle</span>
									<input name="modeleVoiture" type="text" class="form-control" aria-describedby="basic-addon1">
								</div>
								<div class="input-group">
									<span class="input-group-addon" id="basic-addon1">Responsable</span>
									<select class="form-control" name="responsableVoiture">
										<?php 
				                            foreach ($salaries as $salarie) {
				                            	echo "<option value=" . $salarie->get_id() . ">" . $salarie->get_prenom() . " " . $salarie->get_nom() . "</option>";
				                            }
									    ?>
									</select>
								</div>
								<div class="input-group">
									<span class="input-group-addon">
				                        <span class="glyphicon glyphicon-calendar"></span>
				                    </span>
									<input type="text" id="datepicker" class="form-control" name="dateAchatVoiture">
								</div>
				    		</div>
					    </div>
			    	</div>
			    </div>
			</div>
    		<button id="boutonAjout" name="action" type="submit" class="btn btn-primary">Ajouter</button>
    		<br/>
		</form>

	</body>
</html>