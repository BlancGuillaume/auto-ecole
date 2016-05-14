<?php 
	// PAGE DISPONIBLE UNIQUEMENT PAR L'ADMINISTRATEUR : sinon redirection à la page de connexion
    session_start();
    if (!isset($_SESSION['login']) && empty($_SESSION['login']))
    {
      header('Location: connexion.php');
    }
	// TO DO : inclure modèle examen
	//include('../model/Examen.php');
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

		<form id="page-wrapper" action="ajoutExamen.php" method="post">
			<div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Ajout examen</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
	        <div class="row">
	        	<div class="col-lg-12">
                	<div class="panel panel-default">
                		<div class="panel-body">
					    	<div class="col-lg-6">
								<div id="formulaireAjoutLecon" class="sectionsFormulaireEleve">
									<h3>Examen de code</h3>
									<div class="input-group">
										<input name="dateExamenCode" type="text" class="form-control" placeholder="TO DO : datepicker" aria-describedby="basic-addon1">
									</div>
									
					    		</div>
					    	</div>
							<div id="formulaireAjoutLecon" class="sectionsFormulaireEleve">
								<h3>Examen de conduite</h3>
								<div class="input-group">
									<input name="dateExamenConduite" type="text" class="form-control" placeholder="TO DO : datepicker" aria-describedby="basic-addon1">
								</div>
								
				    		</div>
					    </div>
					</div>
				</div>
			</div>
    		<button id="boutonAjout" type="submit" name="action">Ajouter</button>
		</form>

	</body>
</html>