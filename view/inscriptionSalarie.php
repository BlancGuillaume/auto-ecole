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
		<div id="formulaireNouvelEleve">
			<div id="formulaireInfosClient" class="sectionsFormulaireEleve">
				<h3>Salarié</h3>
				<div class="input-group">
					<span class="input-group-addon" id="basic-addon1">Nom</span>
					<input name="nomSalarie" type="text" class="form-control" aria-describedby="basic-addon1">
				</div>

				<div class="input-group">
					<span class="input-group-addon" id="basic-addon1">Prénom</span>
					<input name="prenomSalarie" type="text" class="form-control" aria-describedby="basic-addon1">
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
    		</div>
    		<div id="formulaireFormuleEleve" class="sectionsFormulaireEleve">
    			<h3>Voiture</h3>
    			<div class="input-group">
    				<div class="input-group">
    					<span class="input-group-addon" id="basic-addon1">Formule</span>
						<select class=form-control>
							<option value="v0">Aucune</option>
							<option value="v1">Voiture 1</option>
							<option value="v2">Voiture 2</option>
							<option value="v3">Voiture 3</option>
						</select>
					</div>
				</div>
    		</div>
		</div>

	</body>
</html>