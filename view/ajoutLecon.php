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
	//include('..\model\provider\LeconConduiteProvider.php');
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
		<form class="formulaire" action="ajoutLecon.php" method="post">
			<div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Plannification d'un leçon</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <div class="row">
                <div class="col-lg-12">
                	<div class="panel panel-default">
                		<div class="panel-body">
					    	<div class="col-lg-6">
								<div class="input-group">
									<span class="input-group-addon">
				                        <span class="glyphicon glyphicon-calendar"></span>
				                    </span>
									<input type="text" id="datepicker" class="form-control" name="dateLecon">
								</div>
								<div class="input-group">
									<span class="input-group-addon" id="basic-addon1">Heure</span>
									<input type="text" id="heurepicker" class="form-control" name="heureLecon">
									<span class="input-group-addon" id="basic-addon1">Minute</span>
									<input type="text" id="heurepicker" class="form-control" name="minuteLecon">
								</div>
							</div>



							<div class="col-lg-6">
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
						</div>
					</div>
				</div>
			</div>
    		<button id="boutonAjoutLecon" type="submit" name="action" class="btn btn-primary">Ajouter</button>
		</form>
		<?php
									// On regarde si le formulaire a été complété 
	// TO DO : ajout rafraichissement page
    if (!empty($_POST)) {
   		/*********** DONNEES SUR L'ELEVE ***********/
		$date_lecon =  isset($_POST['dateLecon']) ? addslashes($_POST['dateLecon']) : NULL;
		$heure_lecon =  isset($_POST['heureLecon']) ? addslashes($_POST['heureLecon']) : NULL;
		$minute_lecon =  isset($_POST['minuteLecon']) ? addslashes($_POST['minuteLecon']) : NULL;
		$eleve_lecon = isset($_POST['eleveLecon']) ? addslashes($_POST['eleveLecon']) : NULL;
		$salarie_lecon = isset($_POST['salarieLecon']) ? addslashes($_POST['salarieLecon']) : NULL;
		$voiture_lecon = isset($_POST['voitureLecon']) ? addslashes($_POST['voitureLecon']) : NULL;
		$erreurMessage1 = "L\'ajout a échouée, le(s) champ(s) suivant(s) doivent être complétés : \\n";
		$erreurMessage2 = "L\'ajout a échouée :\\n";
		$erreurFormulaire = 0;

		if (!(is_numeric($heure_lecon))) {
			$erreurMessage2 .= "Heure doit être un nombre\\n";
			$erreurFormulaire = 2;
		}
		else {
			if($heure_lecon < 8) {
				$erreurMessage2 .= "Heure doit être un nombre entre 8 et 20\\n";
				$erreurFormulaire = 2;
			} 
			if($heure_lecon > 20) {
				$erreurMessage2 .= "Heure doit être un nombre entre 8 et 20\\n";
				$erreurFormulaire = 2;
			} 
		}
		if (!(is_numeric($minute_lecon))) {
			$erreurMessage2 .= "Minutes\\n";
			$erreurFormulaire = 2;
		}
		else {
			if($minute_lecon < 0) {
				$erreurMessage2 .= "Minutes doit être un nombre entre 0 et 59\\n";
				$erreurFormulaire = 2;
			} 
			if($minute_lecon > 59) {
				$erreurMessage2 .= "Heure doit être un nombre entre 0 et 59\\n";
				$erreurFormulaire = 2;
			} 
		}
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
		if (empty($heure_lecon)) {
			$erreurMessage1 .= "Heure\\n";
			$erreurFormulaire = 1;
		}
		if (empty($minute_lecon)) {
			$erreurMessage1 .= "Minute\\n";
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
			$eleve = EleveProvider::get_eleve($eleve_lecon);
			$salarie = SalarieProvider::get_salarie($salarie_lecon);
			$voiture = VoitureProvider::get_voiture($voiture_lecon);
			$dateHeure = $date_lecon . " " . $heure_lecon . ":" . $minute_lecon . ":" . "00";
			$lecon = new LeconConduite (NULL, $eleve, $salarie, $voiture, $dateHeure);
			$lecons_en_conflit = LeconConduiteProvider::get_lecons_en_conflit_avec_lecon_courante($lecon);
			if (empty($lecons_en_conflit)) {
				$reussite = LeconConduiteProvider::ajout_lecon($lecon);
				if ($reussite) {
					$message = "Ajout réussi";
					
				}
				else {
					$message = "Echec ajout";
				}
				echo "<script> alert('".$message."');</script>";

			}
			else { 
				echo "<div id=\"page-wrapper\">
	                <div class=\"row\">
	                	<div class=\"col-lg-24\">
		                    <div class=\"panel panel-default\">
		                        <div class=\"panel-body\">
		                            <div class=\"dataTable_wrapper\">
		                                <table class=\"table table-striped table-bordered table-hover\" id=\"dataTables-example\">
		                                    <!-- Entête du tableau -->
		                                    <thead>
		                                        <tr>
		                                            <th>Date</th>
		                                            <th>Eleve</th>
		                                            <th>Moniteur</th>
		                                            <th>Voiture</th>
		                                        </tr>
		                                    </thead>
		                                    <!-- Contenu tableau -->
			                                <tbody>";
			                                        foreach ($lecons_en_conflit as $lecon_en_conflit) {
			                                        	echo "<tr>";
			                                        	echo "<td>" . $lecon_en_conflit->getDate() . "</td>";
			                                        	echo "<td>" . $lecon_en_conflit->get_eleve()->get_prenom() . 
			                                        		 " " . $lecon_en_conflit->get_eleve()->get_nom() . "</td>";
			                                        	echo "<td>" . $lecon_en_conflit->get_salarie()->get_surnom() . "</td>";
			                                        	echo "<td>" . $lecon_en_conflit->get_voiture()->get_immatriculation() . "</td>";
											            echo "</tr>";
											        }
	                                        echo "</tbody>
		                                </table>
		                            </div>
		                        </div>
		                    </div>
		                </div>
		            </div>
            	</div>";
            }
		}
	}
								?>
	</body>
</html>