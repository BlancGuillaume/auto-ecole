<?php 
	include('..\model\provider\LeconConduiteProvider.php');
	// include_once('../model/LeconConduite.php');
	// include_once('../model/Salarie.php');
	// include_once('../model/Voiturephp');
	// include_once('../model/provider/FormuleProvider.php');
	// include_once('../model/provider/AchatProvider.php');
	// include_once('../model/provider/EleveProvider.php');
	// include_once('../model/provider/VoitureProvider.php');
	$lecons = LeconConduiteProvider::get_lecons();
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
                    <h1 class="page-header">Liste des leçons</h1>
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
	                                            <th>Date</th>
	                                            <th>Eleve</th>
	                                            <th>Salarie</th>
	                                            <th>Voiture</th>
	                                        </tr>
	                                    </thead>
	                                    <!-- Contenu tableau -->
		                                <tbody>
			                                <?php 
										        foreach ($lecons as $lecon) {
										        	echo "<tr>";
													echo "<td>" . $lecon->getDate() . "</td>";
													echo "<td>" . $lecon->get_eleve()->get_prenom() . " " . $lecon->get_eleve()->get_nom() . "</td>";
													echo "<td>" . $lecon->get_salarie()->get_surnom() . "</td>";
													echo "<td>" . $lecon->get_voiture()->get_immatriculation() . "</td>";
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

<thead>
	                                        