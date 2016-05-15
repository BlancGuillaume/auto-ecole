<?php
	include('../Model/provider/VoitureProvider.php');
	$voitures = VoitureProvider::get_voitures();

	if (!empty($_POST)) {
		$id_voiture = isset($_POST['voitures']) ? addslashes($_POST['voitures']) : NULL;
		$kilometrage_voiture = isset($_POST['kilometrageVoiture']) ? addslashes($_POST['kilometrageVoiture']) : NULL;

		$erreurMessage1 = "L\'ajout a échouée, le(s) champ(s) suivant(s) doivent être complétés : \\n";
		$erreurFormulaire = 0;

		if (empty($kilometrage_voiture)) {
			$erreurMessage1 .= "le kilométrage\\n";
			$erreurFormulaire = 1;
		}
		if (empty($id_voiture)) {
			$erreurMessage1 .= "la voiture\\n";
			$erreurFormulaire = 1;
		}
		if ($erreurFormulaire == 1) {
			// Il y a eu une erreur
			echo "<script> alert('".$erreurMessage1."');</script>";
		} 
		else {
			$voitureNouveauKilometrage = new Voiture($id_voiture, null, null, null, null, null, null, $kilometrage_voiture, null);
	        VoitureProvider::updateKilometrageVoiture($voitureNouveauKilometrage);
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

		<form id="page-wrapper" action="modificationKilometrage.php" method="post">
			<div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Modification kilométrage d'une voiture</h1>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                	<div class="panel panel-default">
                		<div class="panel-body">
                			<div class="input-group">
								<span class="input-group-addon" id="basic-addon1">Responsable</span>
								<select class="form-control" name="voitures">
									<?php 
			                            foreach ($voitures as $voiture) {
			                            	echo "<option value=" . $voiture->get_id() . ">" . $voiture->get_immatriculation() . "</option>";
			                            }
								    ?>
								</select>
							</div>
							<div class="input-group">
								<span class="input-group-addon" id="basic-addon1">Kilométrage</span>
								<input name="kilometrageVoiture" type="text" class="form-control" aria-describedby="basic-addon1">
							</div>
                		</div>
                	</div>
                </div>
            </div>
            <button id="boutonAjout" name="action" type="submit" class="btn btn-primary">Modififer</button>
        </form>

	</body>
</html>