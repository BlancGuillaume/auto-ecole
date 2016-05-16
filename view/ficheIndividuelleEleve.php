<?php 
	// PAGE DISPONIBLE UNIQUEMENT PAR L'ADMINISTRATEUR : sinon redirection à la page de connexion
    session_start();
    if (!isset($_SESSION['login']) && empty($_SESSION['login']))
    {
      header('Location: connexion.php');
    }

	include('..\model\provider\EleveProvider.php');
	//include('..\model\provider\LeconConduiteProvider.php');
	$eleves = EleveProvider::get_eleves();
	$eleveAAfficher = NULL;
	$_SESSION['testEleveChoisi'] = 0;
	if (!empty($_POST)) {
		$_SESSION['testEleveChoisi'] = 1;
		$id_eleve = isset($_POST['eleveChoisi']) ? addslashes($_POST['eleveChoisi']) : NULL;

		$_SESSION['eleveChoisi'] = $id_eleve;

		if ($id_eleve != NULL) {
			$eleveAAfficher = EleveProvider::get_eleve($id_eleve);
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
		<script language="Javascript">
			function imprimer(){window.print();}
		</script>
		<header>
		<!-- Navigation -->
        <?php include('nav.php');?>

		</header>
		<form class="formulaire" action="ficheIndividuelleEleve.php" method="post">
			<div id="formulaireAjoutLecon" class="sectionsFormulaireEleve">
				<h3>Eleve</h3>
				<div class="input-group">
					<span class="input-group-addon" id="basic-addon1">Client</span>
					<select class="form-control" name="eleveChoisi" id="eleveChoisi">
						<?php 
                            foreach ($eleves as $eleve) {
                            	if ($_SESSION['testEleveChoisi'] == 1) {
                            		if($eleve->get_id() == $_SESSION['eleveChoisi']) {
                            			echo "<option selected=\"selected\" value=" . $eleve->get_id() . ">" . $eleve->get_prenom() . " " . $eleve->get_nom() . "</option>";
                            		}
                            		else {
                            			echo "<option value=" . $eleve->get_id() . ">" . $eleve->get_prenom() . " " . $eleve->get_nom() . "</option>";
                            		}
                            	}
                            	else {
                            		echo "<option value=" . $eleve->get_id() . ">" . $eleve->get_prenom() . " " . $eleve->get_nom() . "</option>";
                            	}
                            	
                            	// 

                            	// 	if($client->get_id() == $_SESSION['eleveChoisi']) {
                            	// 		echo "<option selected=\"selected\" value=" . $eleve->get_id() . ">" . $eleve->get_prenom() . " " . $eleve->get_nom() . "</option>";
                            	// 	}
                            	// 	else {
                            	// 		echo "<option value=" . $eleve->get_id() . ">" . $eleve->get_prenom() . " " . $eleve->get_nom() . "</option>";
                            	// 	}
                            	// }
                            	// else {
                            	// 	echo "<option value=" . $eleve->get_id() . ">" . $eleve->get_prenom() . " " . $eleve->get_nom() . "</option>";
                            	// }
                            }
					    ?>
					</select>
				</div>
    		</div>
    		<button id="boutonAjoutLecon" type="submit" name="action" class="btn btn-primary">Selectionner</button><br/><br/><br/>

    		<h3>Informations générales</h3>
    		<div class="input-group">
				<span class="input-group-addon" id="basic-addon1">Client responsable</span>
				<input readonly id="formuleEleve" name="villeEleve" type="text" class="form-control" aria-describedby="basic-addon1" value=
					<?php 
						if ($eleveAAfficher != NULL) {
							echo "\"" . $eleveAAfficher->get_client()->get_prenom() . " " . $eleveAAfficher->get_client()->get_nom() . "\"";
						}
					?>
				>
			</div>
			<div class="input-group">
				<span class="input-group-addon glyphicon glyphicon-phone-alt" aria-hidden="true"></span>
				<input readonly name="numEleve" type="text" class="form-control" aria-describedby="basic-addon1" value=
					<?php 
						if ($eleveAAfficher != NULL) {
							echo "\"" . $eleveAAfficher->get_telDomicile() . "\"";
						}
					?>
				>
			</div>

			<div class="input-group">
				<span class="input-group-addon glyphicon glyphicon-phone-alt" aria-hidden="true"></span>
				<input readonly name="numTravailEleve" type="text" class="form-control" aria-describedby="basic-addon1" value=
					<?php 
						if ($eleveAAfficher != NULL) {
							echo "\"" . $eleveAAfficher->get_telPortable() . "\"";
						}
					?>
				>
			</div>

			<div class="input-group">
				<span class="input-group-addon glyphicon glyphicon-gift" aria-hidden="true"></span>
				<input readonly name="anniversaireEleve" type="text" class="form-control" aria-describedby="basic-addon1" value=
					<?php 
						if ($eleveAAfficher != NULL) {
							echo "\"" . $eleveAAfficher->get_dateNaissance() . "\"";
						}
					?>
				>
			</div>
			<div class="adresseFormulaire">
				<div class="input-group">
					<span class="input-group-addon" id="basic-addon1">Adresse</span>
					<input readonly id="resultatCode" name="resultatCode" type="text" class="form-control" aria-describedby="basic-addon1" value=
						<?php 
							if ($eleveAAfficher != NULL) {
								echo "\"" . $eleveAAfficher->get_adresse()->get_rue() . 
									 " " . $eleveAAfficher->get_adresse()->get_codePostal() . 
									 " " . $eleveAAfficher->get_adresse()->get_ville() . "\"";
							}
						?>
					>
				</div>
				
			</div>

			<br/><h3>Informations sur l'auto-école</h3>
			<div class="input-group">
				<span class="input-group-addon" id="basic-addon1">Formule choisie</span>
				<input readonly id="formuleEleve" name="villeEleve" type="text" class="form-control" aria-describedby="basic-addon1"value=
					<?php 
						if ($eleveAAfficher != NULL) {
							echo "\"Formule " . $eleveAAfficher->get_formule()->get_id() . "\"";
						}
					?>
				>
			</div>
			<div class="input-group">
				<span class="input-group-addon" id="basic-addon1">Moniteur référent</span>
				<input readonly id="moniteurEleve" name="villeEleve" type="text" class="form-control" aria-describedby="basic-addon1" value=
					<?php 
						if ($eleveAAfficher != NULL) {
							echo "\"" . $eleveAAfficher->get_moniteur()->get_surnom() . "\"";
						}
					?>
				>
			</div>
			<div class="input-group">
				<span class="input-group-addon" id="basic-addon1">Résultat code</span>
				<input readonly id="resultatCode" name="resultatCode" type="text" class="form-control" aria-describedby="basic-addon1" value=
					<?php 
						if ($eleveAAfficher != NULL) {
							if ($eleveAAfficher->get_examenCode() == 1) {
								echo "Oui";
							} else {
								echo "Non";
							}
						}
					?>
				>
			</div>
			<div class="input-group">
				<span class="input-group-addon" id="basic-addon1">Résultat conduite</span>
				<input readonly id="resultatConduite" name="villeEleve" type="text" class="form-control" aria-describedby="basic-addon1" value=
					<?php 
						if ($eleveAAfficher != NULL) {
							if ($eleveAAfficher->get_examenPermis() == 1) {
								echo "Oui";
							} else {
								echo "Non";
							}
							
						}
					?>
				>
			</div>
			<div class="input-group">
				<span class="input-group-addon" id="basic-addon1">Heures faires</span>
				<input readonly id="heureFaites" name="heuresFaites" type="text" class="form-control" aria-describedby="basic-addon1" value=
					<?php 
						if ($eleveAAfficher != NULL) {
							echo "\"" . LeconConduiteProvider::get_nombre_lecons_effectuees($eleveAAfficher->get_id()) . "\"";
						}
					?>
				>
			</div>

			<div class="input-group">
				<span class="input-group-addon" id="basic-addon1">Heures restantes</span>
				<input readonly id="heuresRestantes" name="heuresRestantes" type="text" class="form-control" aria-describedby="basic-addon1" value=
					<?php 
						if ($eleveAAfficher != NULL) {
							echo "\"" . AchatProvider::get_nombre_lecons_achetees($eleveAAfficher->get_id()) . "\"";
						}
					?>
				>
			</div>
			<br/><br/>
			<form>
			<div align="center">
				<center>
					<p>
						<input name="B1" onclick="imprimer()" type="button" value="Imprimer" class="btn btn-primary">
					</p>
				</center>
			</div>
		</form>
		</form>
		
	</body>
</html>
