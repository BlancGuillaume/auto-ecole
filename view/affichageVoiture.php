<?php 
	// PAGE DISPONIBLE UNIQUEMENT PAR L'ADMINISTRATEUR : sinon redirection à la page de connexion
    session_start();
    if (!isset($_SESSION['login']) && empty($_SESSION['login']))
    {
      header('Location: connexion.php');
    }
	include('..\model\provider\VoitureProvider.php');
	include('..\model\Voiture.php');
	$voitures = VoitureProvider::get_voitures();
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
		<!-- Tableau affichant la liste de tous les élèves -->
		<div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Liste des voitures</h1>
                </div>
                <div class="row">
                	<div class="col-lg-12">
	                    <div class="panel panel-default">
	                        <div class="panel-body">
	                            <div class="dataTable_wrapper">
	                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
	                                    <!-- Entête du tableau -->
	                                    <thead>
	                                        <tr>
	                                            <th>Immatriculation</th>
	                                            <th>Responsable</th>
	                                            <th>Kilometrage</th>
	                                            <th>Marque</th>
	                                            <th>Modele</th>
	                                            <th>Achat</th>
	                                            <th>Prix</th>

	                                        </tr>
	                                    </thead>
	                                    <!-- Contenu tableau -->
		                                <tbody>

		                                    <?php 
		                                    	foreach ($voitures as $voiture) {
										            echo "<tr>";
										            echo "<td>" . $voiture->get_immatriculation() . "</td>";
										            echo "<td>" . $voiture->get_responsable()->get_surnom() . "</td>";
										            echo "<td>" . $voiture->get_kilometrage() . "</td>";
										            echo "<td>" . $voiture->get_marque() . "</td>";
										            echo "<td>" . $voiture->get_modele() . "</td>";
										            echo "<td>" . $voiture->get_dateAchat() . "</td>";
										            echo "<td>" . $voiture->get_prixAchat() . "</td>";
										            echo "</tr>";
										        }
										    ?>
                                        </tbody>
	                                </table>
	                            </div>
	                        </div>
	                    </div>
	                </div>
	            </div>
            </div>
        </div>
	</body>
</html>