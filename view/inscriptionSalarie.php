<?php 
	// PAGE DISPONIBLE UNIQUEMENT PAR L'ADMINISTRATEUR : sinon redirection à la page de connexion
    session_start();
    if (!isset($_SESSION['login']) && empty($_SESSION['login']))
    {
      header('Location: connexion.php');
    }

	// Pour remplir la liste déroulante Voiture
	include('..\model\provider\VoitureProvider.php');
	$voitures = VoitureProvider::get_voitures();


	
   // On regarde si le formulaire a été complété 
	// TO DO : ajout rafraichissement page
    if (!empty($_POST)) {
   		/*********** DONNEES SUR L'ELEVE ***********/
		// Récupération de toutes les informations sur le salarié
		// Fonction addslashes pour éviter erreur d'insertions de bdd
		$num_salarie = isset($_POST['numSalarie']) ? addslashes($_POST['numSalarie']) : NULL;
		$prenom_salarie = isset($_POST['prenomSalarie']) ? addslashes($_POST['prenomSalarie']) : NULL;
		$surnom = isset($_POST['surnomSalarie']) ? addslashes($_POST['surnomSalarie']) : NULL;
		$nom_salarie = isset($_POST['nomSalarie']) ? addslashes($_POST['nomSalarie']) : NULL;
		$categorie_salarie = isset($_POST['categorieSalarie']) ? addslashes($_POST['categorieSalarie']) : NULL;
		$libelle_adresse_salarie = isset($_POST['libelleSalarie']) ? addslashes($_POST['libelleSalarie']) : NULL;
		$ville_adresse_salarie = isset($_POST['villeSalarie']) ? addslashes($_POST['villeSalarie']) : NULL;
		$cp_adresse_salarie = isset($_POST['codePostalSalarie']) ? addslashes($_POST['codePostalSalarie']) : NULL;
		$voiture_salarie = isset($_POST['voiture']) ? addslashes($_POST['voiture']) : NULL;
		$date_recrutement_salarie = isset($_POST['dateRecrutement']) ? addslashes($_POST['dateRecrutement']) : NULL;


		// Plusieurs champs obligatoires peuvent avoir été omis.
		// On va consruire le message au fur et a mesure
		$erreurMessage1 = "L\'ajout a échouée, le(s) champ(s) suivant(s) doivent être complétés : \\n";
		$erreurMessage2 = "L\'ajout a échouée :\\n";
		$erreurFormulaire = 0;

		if (!preg_match('#^[0-9]{5}$#', $cp_adresse_salarie)) {
			$erreurMessage2 .= "le code postal est un nombre à 5 chiffres\\n";
			$erreurFormulaire = 2;
		}
		if (!preg_match('#^[0-9]{10}$#', $num_salarie)) {
			$erreurMessage2 .= "le numéro de téléphone du salarié doit contenir 10 chiffres\\n";
			$erreurFormulaire = 2;
		}
		if (empty($nom_salarie)) {
			$erreurMessage1 .= "Nom du salarié\\n";
			$erreurFormulaire = 1;
		}
		if (empty($prenom_salarie)) {
			$erreurMessage1 .= "Prénom du salarié\\n";
			$erreurFormulaire = 1;
		}
		if (empty($num_salarie)) {
			$erreurMessage1 .= "Numéro de téléphone du salarié\\n";
			$erreurFormulaire = 1;
		}
		if (empty($libelle_adresse_salarie)) {
			$erreurMessage1 .= "Adresse du salarié\\n";
			$erreurFormulaire = 1;
		}
		if (empty($ville_adresse_salarie)) {
			$erreurMessage1 .= "Ville du salarié\\n";
			$erreurFormulaire = 1;
		}
		if (empty($cp_adresse_salarie)) {
			$erreurMessage1 .= "Code postal du salarié";
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
			$adresse_salarie = new Adresse(NULL, $libelle_adresse_salarie, $ville_adresse_salarie, $cp_adresse_salarie);
			AdresseProvider::ajout_adresse($adresse_salarie);
			$id_adresse_salarie = AdresseProvider::get_id_adresse($adresse_salarie);
			$adresse_salarie = new Adresse($id_adresse_salarie, $libelle_adresse_salarie, $ville_adresse_salarie, $cp_adresse_salarie);

			$voiture = new Voiture($voiture_salarie, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
			$salarie = new Salarie(NULL, $prenom_salarie, $nom_salarie, NULL, NULL, 
							   $num_salarie, $adresse_salarie, $surnom, $date_recrutement_salarie, $categorie_salarie, $voiture, NULL);
			SalarieProvider::ajout_salarie($salarie);
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
		<header>
		<!-- Navigation -->
        <?php include('nav.php');?>

		</header>
		<form id="page-wrapper" action="inscriptionSalarie.php" method="post">
			<div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Inscription Salarié</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <div class="row">
                <div class="col-lg-12">
                	<div class="panel panel-default">
						<div id="formulaireInfosClient" class="sectionsFormulaireEleve">
							<div class="input-group">
								<span class="input-group-addon" id="basic-addon1">Nom</span>
								<input name="nomSalarie" type="text" class="form-control" aria-describedby="basic-addon1">
							</div>

							<div class="input-group">
								<span class="input-group-addon" id="basic-addon1">Prénom</span>
								<input name="prenomSalarie" type="text" class="form-control" aria-describedby="basic-addon1">
							</div>
							
							<div class="input-group">
								<span class="input-group-addon" id="basic-addon1">Surnom</span>
								<input name="surnomSalarie" type="text" class="form-control" aria-describedby="basic-addon1">
							</div>
							<div class="input-group">
								<span class="input-group-addon glyphicon glyphicon-phone-alt" aria-hidden="true"></span>
								<input name="numSalarie" type="text" class="form-control" placeholder="Ex: 0612345678" aria-describedby="basic-addon1">
							</div>

							<h5>Adresse</h5>
							<div class="adresseFormulaire">
								<div class="input-group">
									<span class="input-group-addon" id="basic-addon1">N° et nom de rue</span>
									<textarea name="libelleSalarie" type="text" class="form-control" aria-describedby="basic-addon1" placeholder="Ex: 22 rue des pêcheurs"></textarea>
								</div>
								<div class="input-group">
									<span class="input-group-addon" id="basic-addon1">Code postal</span>
									<input name="codePostalSalarie" type="text" class="form-control" aria-describedby="basic-addon1">
								</div>
								<div class="input-group">
									<span class="input-group-addon" id="basic-addon1">Ville</span>
									<input name="villeSalarie" type="text" class="form-control" aria-describedby="basic-addon1">
								</div>
							</div>
			    			<br/>
			    			<div class="input-group">
			    				<div class="input-group">
			    					<span class="input-group-addon" id="basic-addon1">Voiture</span>
			    					<!-- TO DO : remplir champs avec la BD -->
									<select class="form-control" name="voiture">
										<option value="0">Aucune</option>
										<?php 
											foreach ($voitures as $voiture) {
									            echo "<option value=" . $voiture->get_id() . "> Voiture " . 
									            	 $voiture->get_id() . " - " . $voiture->get_immatriculation() . "</option>";
										    }
										?>
									</select>
								</div>
							</div>
			    			<div class="input-group">
			    				<div class="input-group">
			    					<span class="input-group-addon" id="basic-addon1">Catégorie</span>
									<select class="form-control" name="categorieSalarie">
										<option value="moniteur">Moniteur</option>
										<option value="secretaire">Secrétaire</option>
									</select>
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