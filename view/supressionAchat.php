<?php 
	// PAGE DISPONIBLE UNIQUEMENT PAR L'ADMINISTRATEUR : sinon redirection à la page de connexion
    session_start();
    if (!isset($_SESSION['login']) && empty($_SESSION['login']))
    {
      header('Location: connexion.php');
    }
    include('..\model\provider\ClientProvider.php');
    $clients = ClientProvider::get_clients();

    if (!empty($_POST)) {
   		/*********** DONNEES SUR L'ELEVE ***********/
		$liste_achats = isset($_POST['listeAchats']) ? addslashes($_POST['listeAchats']) : NULL;
		$client_achat = isset($_POST['clientAchat']) ? addslashes($_POST['clientAchat']) : NULL;

		$achats = NULL;
		$_SESSION['clientChoisi'] = $client_achat;

		if ($client_achat != NULL) {
			$_SESSION['testClientChoisi'] = 1;
			$achats = AchatProvider::get_achats_dun_client($_SESSION['clientChoisi']);
		}
		$erreurFormulaire = 0;
		$erreurMessage1 = "L\'ajout a échouée, le(s) champ(s) suivant(s) doivent être complétés : \\n";
		if (empty($listeAchats) && empty($client_achat)) {
			$erreurMessage1 .= "Achats\\n";
			$erreurFormulaire = 1;
		}
		if ($erreurFormulaire == 1) {
			// Il y a eu une erreur
			echo "<script> alert('".$erreurMessage1."');</script>";
		} 

		if ($erreurFormulaire == 0) {
			// SUPPRESSION SELECTION
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
		<header>
		<!-- Navigation -->
        <?php include('nav.php');?>

		</header>
		<form class="formulaire" action="supressionAchat.php" method="post">
			<div id="formulaireAjoutLecon" class="sectionsFormulaireEleve">
				<h3>Achat</h3>
				<form class="formulaire" action="supressionAchat.php" method="post">
					<div class="input-group">
						<span class="input-group-addon" id="basic-addon1">Client</span>
						<select class="form-control" name="clientAchat" id="listeClients">
							<?php 
	                            foreach ($clients as $client) {
	                            	if ($_SESSION['testClientChoisi'] == 1) {

	                            		if($client->get_id() == $_SESSION['clientChoisi']) {
	                            			echo "<option  selected=\"selected\" value=" . $client->get_id() . ">" . $client->get_prenom() . " " . $client->get_nom() . "</option>";
	                            		}
	                            		else {
	                            			echo "<option value=" . $client->get_id() . ">" . $client->get_prenom() . " " . $client->get_nom() . "</option>";
	                            		}
	                            	}
	                            	else {
	                            		echo "<option value=" . $client->get_id() . ">" . $client->get_prenom() . " " . $client->get_nom() . "</option>";
	                            	}
	                            }
						    ?>
						</select>
					</div>
					<button id="boutonSelectClient" type="submit" name="action">Selectionner</button>
				</form>
				<div>
					<div class="input-group">
						<span class="input-group-addon" id="basic-addon1">Achats</span>
						<select class="form-control" name="listeAchats" id="listeAchats">
							<?php 
	                            foreach ($achats as $achat) {
	                            	echo "<option value=" . $achat->get_id() . ">" . $achat->getEleveBeneficiaire()->get_prenom() . " " 
	                            	     . $achat->getEleveBeneficiaire()->get_nom() . " " . $achat->get_montant() . "</option>";
	                            }
					    	?>
						</select>
					</div>
				</div>
				<button id="boutonAjoutLecon" type="submit" name="action" class="btn btn-primary">Acheter</button>
    		</div>
    		
		</form>
	</body>
</html>
