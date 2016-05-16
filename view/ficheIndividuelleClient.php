<?php 
	// PAGE DISPONIBLE UNIQUEMENT PAR L'ADMINISTRATEUR : sinon redirection à la page de connexion
    session_start();
    if (!isset($_SESSION['login']) && empty($_SESSION['login']))
    {
      header('Location: connexion.php');
    }

	include('..\model\provider\ClientProvider.php');
	//include('..\model\provider\LeconConduiteProvider.php');
	$clients = ClientProvider::get_clients();

	$clientAAfficher = NULL;
	$_SESSION['testChoisi'] = 0;
	if (!empty($_POST)) {
		$_SESSION['testChoisi'] = 1;
		$id_client = isset($_POST['clientChoisi']) ? addslashes($_POST['clientChoisi']) : NULL;

		$_SESSION['eleveChoisi'] = $id_client;

		if ($id_client != NULL) {
			$clientAAfficher = ClientProvider::get_client($id_client);
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
		<script language="Javascript">
			function imprimer(){window.print();}
		</script>
		<header>
		<!-- Navigation -->
        <?php include('nav.php');?>

		</header>
		<form class="formulaire" action="ficheIndividuelleClient.php" method="post">
			<div id="formulaireAjoutLecon" class="sectionsFormulaireEleve">
				<h3>Client</h3>
				<div class="input-group">
					<span class="input-group-addon" id="basic-addon1">Client</span>
					<select class="form-control" name="clientChoisi" id="clientChoisi">
						<?php 
                            foreach ($clients as $client) {
                            	if ($_SESSION['testChoisi'] == 1) {
                            		if($client->get_id() == $_SESSION['eleveChoisi']) {
                            			echo "<option selected=\"selected\" value=" . $client->get_id() . ">" . $client->get_prenom() . " " . $client->get_nom() . "</option>";
                            		}
                            		else {
                            			echo "<option value=" . $client->get_id() . ">" . $client->get_prenom() . " " . $client->get_nom() . "</option>";
                            		}
                            	}
                            	else {
                            		echo "<option value=" . $client->get_id() . ">" . $client->get_prenom() . " " . $client->get_nom() . "</option>";
                            	}
                            	
                            	// 

                            	// 	if($client->get_id() == $_SESSION['eleveChoisi']) {
                            	// 		echo "<option selected=\"selected\" value=" . $eleve->get_id() . ">" . $eleve->get_prenom() . " " . $eleve->get_nom() . "</option>";
                            	// 	}
                            	// 	else {
                            	// 		echo "<option value=" . $eleve->get_id() . ">" . $eleve->get_prenom() . " " . $eleve->get_nom() . "</option>";
                            	// 	}
                            	// }
                            	// else {
                            	// 	echo "<option value=" . $eleve->get_id() . ">" . $eleve->get_prenom() . " " . $eleve->get_nom() . "</option>";
                            	// }
                            }
					    ?>
					</select>
				</div>
    		</div>
    		<button id="boutonAjoutLecon" type="submit" name="action" class="btn btn-primary">Selectionner</button><br/><br/><br/>

    		<h3>Informations générales</h3>
			<div class="input-group">
				<span class="input-group-addon glyphicon glyphicon-phone-alt" aria-hidden="true"></span>
				<input readonly name="numEleve" type="text" class="form-control" aria-describedby="basic-addon1" value=
					<?php 
						if ($clientAAfficher != NULL) {
							echo "\"" . $clientAAfficher->get_telDomicile() . "\"";
						}
					?>
				>
			</div>

			<div class="input-group">
				<span class="input-group-addon glyphicon glyphicon-phone-alt" aria-hidden="true"></span>
				<input readonly name="numTravailEleve" type="text" class="form-control" aria-describedby="basic-addon1" value=
					<?php 
						if ($clientAAfficher != NULL) {
							echo "\"" . $clientAAfficher->get_telPortable() . "\"";
						}
					?>
				>
			</div>
			<div class="adresseFormulaire">
				<div class="input-group">
					<span class="input-group-addon" id="basic-addon1">Adresse</span>
					<input readonly id="resultatCode" name="resultatCode" type="text" class="form-control" aria-describedby="basic-addon1" value=
						<?php 
							if ($clientAAfficher != NULL) {
								echo "\"" . $clientAAfficher->get_adresse()->get_rue() . 
									 " " . $clientAAfficher->get_adresse()->get_codePostal() . 
									 " " . $clientAAfficher->get_adresse()->get_ville() . "\"";
							}
						?>
					>
				</div>
			</div>
			<div class="input-group">
				<span class="input-group-addon" id="basic-addon1">Eleves</span>
				<select readonly class="form-control" name="listeEleves" id="listeEleves">
					<?php 
						if ($clientAAfficher != NULL) {
							$eleves = $clientAAfficher->get_listeEleves();
							foreach ($eleves as $eleve) {
								echo "<option value=" . $eleve->get_id() . ">" . $eleve->get_prenom() . " " . $eleve->get_nom() . "</option>";
							}
							
						}
                        foreach ($achats as $achat) {
                        	
                        }
			    	?>
				</select>
			</div>
			<div class="input-group">
				<span class="input-group-addon" id="basic-addon1">Achats</span>
				<select readonly class="form-control" name="listeAchats" id="listeAchats">
					<?php 
						if ($clientAAfficher != NULL) {
							$achats = $clientAAfficher->get_listeAchats();
							//$achats = AchatProvider::get_achats_dun_client($clientAAfficher->get_id());
							foreach ($achats as $achat) {
								echo "<option value=" . $achat->get_id() . ">" . $achat->getEleveBeneficiaire()->get_prenom() . " " . $achat->getEleveBeneficiaire()->get_nom() . 
									 " - " . $achat->get_dateAchat() . " - " . $achat->get_nbreLecons() ." - ". $achat->get_montant() . "euros</option>";
							}
						}
			    	?>
				</select>
			</div>
			
			<br/><br/>
			<form>
				<div align="center">
					<center>
						<p>
							<input name="B1" onclick="imprimer()" type="button" value="Imprimer" class="btn btn-primary">
						</p>
					</center>
				</div>
			</form>
		</form>
	</body>
</html>
