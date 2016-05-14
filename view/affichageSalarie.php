<?php 
	// PAGE DISPONIBLE UNIQUEMENT PAR L'ADMINISTRATEUR : sinon redirection à la page de connexion
    session_start();
    if (!isset($_SESSION['login']) && empty($_SESSION['login']))
    {
      header('Location: connexion.php');
    }
	include('..\model\provider\SalarieProvider.php');
	include('..\model\Salarie.php');
	$salaries = SalarieProvider::get_salaries();


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
		<!-- Tableau affichant la liste de tous les élèves -->
		<div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Liste des salariés</h1>
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
	                                            <th>Nom</th>
	                                            <th>Prénom</th>
	                                            <th>Surnom</th>
	                                            <th>Categorie</th>
	                                            <th>Voiture</th>
	                                            <th>Tel</th>
	                                            <th>Adresse</th>
	                                            <th>Recrutement</th>
	                                        </tr>
	                                    </thead>
	                                    <!-- Contenu tableau -->
		                                <tbody>
		                                    <?php 
		                                    	foreach ($salaries as $moniteur) {
		                                    		echo "<tr>";
										            echo "<td>" . $moniteur->get_nom() . "</td>";
										            echo "<td>" . $moniteur->get_prenom() . "</td>";
										            echo "<td>" . $moniteur->get_surnom() . "</td>";
										            echo "<td>" . $moniteur->get_categorie() . "</td>";
										            echo "<td>" . "TO DO : VOITURE" . "</td>";
										            echo "<td>" . $moniteur->get_telPortable() . "</td>";
										            echo "<td>" . $moniteur->get_adresse()->get_rue() . "</td>";
										            echo "<td>" . $moniteur->get_dateRecrutement() . "</td>";
										            echo "</tr>";
										        }
										    ?>
	                                        <!--<tr class="odd gradeX">
		                                        <td>Trident</td>
		                                        <td>Internet Explorer 4.0</td>
		                                        <td>Win 95+</td>
		                                        <td class="center">4</td>
		                                        <td class="center">X</td>
	                                        </tr>!-->
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