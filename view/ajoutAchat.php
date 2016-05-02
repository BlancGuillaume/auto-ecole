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
		<form class="formulaire" action="ajoutAchat.php" method="post">
			<div id="formulaireAjoutLecon" class="sectionsFormulaireEleve">
				<h3>Achat</h3>
				<div class="input-group">
					<span class="input-group-addon" id="basic-addon1">Client</span>
					<select class=form-control>
						<option value="s1">1  BORDIN Geoffrey</option>
						<option value="s2">2  PIRATE Jean</option>
						<option value="s3">3  HENRI Carl</option>
					</select>
				</div>
				<div class="input-group">
					<span class="input-group-addon" id="basic-addon1">Eleve</span>
					<select class=form-control>
						<option value="e1">1  GIVELET Elise</option>
						<option value="e2">2  BLANC Guillaume</option>
						<option value="e3">3  PLARE Karine</option>
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