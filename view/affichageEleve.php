<?php 
	// PAGE DISPONIBLE UNIQUEMENT PAR L'ADMINISTRATEUR : sinon redirection à la page de connexion
    session_start();
    if (!isset($_SESSION['login']) && empty($_SESSION['login']))
    {
      header('Location: connexion.php');
    }

	include('..\model\provider\EleveProvider.php');
	$eleves = EleveProvider::get_eleves();
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
                    <h1 class="page-header">Liste des élèves</h1>
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
	                                            <th>Total heures</th>
	                                            <th>Code</th>
	                                            <th>Conduite</th>
	                                            <th>Naissance</th>
	                                            <th>Adresse</th>
	                                            <th>Responsable</th>
	                                            <th>Formule</th>
	                                            <th>Référent</th>
	                                            <th>Date d'inscription</th>
	                                            <th>Tel 1</th>
	                                            <th>Tel 2</th>
	                                        </tr>
	                                    </thead>
	                                    <!-- Contenu tableau -->
		                                <tbody>
		                                	<?php 
		                                        foreach ($eleves as $eleve) {
		                                        	echo "<tr>";
		                                        	echo "<td>" . $eleve->get_nom() . "</td>";
		                                        	echo "<td>" . $eleve->get_nombreLeconsEffectuees() . "</td>";
		                                        	echo "<td>" .  $eleve->get_examenCode() . "</td>";
										            echo "<td>" . $eleve->get_examenPermis() . "</td>";
		                                        	echo "<td>" . $eleve->get_dateNaissance() . "</td>";
		                                        	echo "<td>" . $eleve->get_adresse()->get_rue() . "</td>";
										            echo "<td>" . $eleve->get_adresse()->get_ville() . "</td>";
										            echo "<td>" . $eleve->get_adresse()->get_codePostal() . "</td>";
										            echo "<td>" . $eleve->get_client()->get_nom() . "</td>";
										            echo "<td>" . $eleve->get_client()->get_prenom() . "</td>";
										            echo "<td>" . $eleve->get_formule()->get_id() . "</td>";
										            echo "<td>" . $eleve->get_moniteur()->get_surnom() . "</td>";
										            echo "<td>" .  $eleve->getDateInscription() . "</td>";
										            echo "<td>" . $eleve->get_telDomicile() . "</td>";
										            echo "<td>" . $eleve->get_telPortable() . "</td>";
										            echo "<tr>";
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