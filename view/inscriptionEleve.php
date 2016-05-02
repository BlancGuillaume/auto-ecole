<?php 
    // TO DO : CONNEXION A LA BASE DE DONNEES
 	// include('bd/accessBD.php'); 
	// $bd = new accessBD;
	// $bd->connect();

	/* TO DO : POUR LA CONNEXION : affichage alerte si erreur de connexion */
	// if ($_SESSION['erreurConnection'] == -1) {
	// 	unset($_SESSION['erreurConnection']);
	// 	echo '<script>alert("Echec de la connection : mail ou mot de passe invalide.");</script>';
	// }
	
   // On regarde si le formulaire a été complété 
	// TO DO : ajout rafraichissement page
    if (!empty($_POST)) {
   		/*********** DONNEES SUR L'ELEVE ***********/
		// Récupération de toutes les informations sur l'élève
		// TO DO : vérifier format date Oracle
		$date_inscription = date("M-d-Y"); // le format DATE de Oracle
		$naissance_eleve =  $_POST['anniversaireEleve'];  
		// Fonction addslashes pour éviter erreur d'insertions de bdd
		$num_eleve = addslashes($_POST['numEleve']);
		$prenom_eleve = $_POST['prenomEleve'];
		$nom_eleve = addslashes($_POST['nomEleve']);
		$libelle_adresse_eleve = addslashes($_POST['libelleEleve']);
		$ville_adresse_eleve = addslashes($_POST['villeEleve']);
		$cp_adresse_eleve = addslashes($_POST['codePostalEleve']);
		$formule_eleve = addslashes($_POST['formule']);

		/*********** DONNEES SUR LE CLIENT ***********/
		$num_client = addslashes($_POST['numClient']);
		$prenom_client = $_POST['prenomClient'];
		$nom_client = addslashes($_POST['nomClient']);
		$libelle_adresse_client = addslashes($_POST['libelleClient']);
		$ville_adresse_client = addslashes($_POST['villeClient']);
		$cp_adresse_client = addslashes($_POST['codePostalClient']);

		
		// Plusieurs champs obligatoires peuvent avoir été omis.
		// On va consruire le message au fur et a mesure
		$erreurMessage = "La réservation a échouée, le(s) champ(s) suivant doivent être complétés : ";
		$erreurFormulaire = 0;

		if (empty($naissance_eleve)) {
			$erreurMessage .= "Date de naissance de l\'élève, ";
			$erreurFormulaire = 1;
		}
		if (empty($num_eleve)) {
			$erreurMessage .= "Numéro de téléphone de l\'élève, ";
			$erreurFormulaire = 1;
		}
		if (empty($prenom_eleve)) {
			$erreurMessage .= "Prénom de l\'élève, ";
			$erreurFormulaire = 1;
		}
		if (empty($nom_eleve)) {
			$erreurMessage .= "Nom de l\'élève, ";
			$erreurFormulaire = 1;
		}
		if (empty($libelle_adresse_eleve)) {
			$erreurMessage .= "Adresse de l\'élève, ";
			$erreurFormulaire = 1;
		}
		if (empty($ville_adresse_eleve)) {
			$erreurMessage .= "Ville de l\'élève, ";
			$erreurFormulaire = 1;
		}
		if (empty($cp_adresse_eleve)) {
			$erreurMessage .= "Code postal de l\'élève, ";
			$erreurFormulaire = 1;
		}
		if (empty($formule_eleve)) {
			$erreurMessage .= "Formule, ";
			$erreurFormulaire = 1;
		}
		if (empty($num_client)) {
			$erreurMessage .= "Numéro de téléphone du client, ";
			$erreurFormulaire = 1;
		}
		if (empty($prenom_client)) {
			$erreurMessage .= "Prénom du client, ";
			$erreurFormulaire = 1;
		}
		if (empty($nom_client)) {
			$erreurMessage .= "Nom du client, ";
			$erreurFormulaire = 1;
		}
		if (empty($libelle_adresse_client)) {
			$erreurMessage .= "Adresse du client, ";
			$erreurFormulaire = 1;
		}
		if (empty($ville_adresse_client)) {
			$erreurMessage .= "Ville du client, ";
			$erreurFormulaire = 1;
		}
		if (empty($cp_adresse_client)) {
			$erreurMessage .= "Code postal du client, ";
			$erreurFormulaire = 1;
		}
		 
		// Affichage de la pop du succès de la réservation, ou de l'echec dans le cas contraire
		if ($erreurFormulaire == 1) {
			// Il y a eu une erreur
			echo "<script> alert('".$erreurMessage."');</script>";
		} else {
			// Récupération de toutes les informations sur l'élève
			// AFFICHAGE VERIFICATION
			var_dump("date_inscription : " . $date_inscription);
			var_dump("naissance_eleve : " . $naissance_eleve);
			var_dump("num_eleve : " . $num_eleve);
			var_dump("prenom_eleve : " . $prenom_eleve);
			var_dump("nom_eleve : " . $nom_eleve);

			var_dump("libelle_adresse_eleve : " . $libelle_adresse_eleve);
			var_dump("ville_adresse_eleve : " . $ville_adresse_eleve);
			var_dump("cp_adresse_eleve : " . $cp_adresse_eleve);
			var_dump("formule_eleve : " . $formule_eleve);

			var_dump("num_client : " . $num_client);
			var_dump("prenom_client : " . $prenom_client);
			var_dump("nom_client : " . $nom_client);
			var_dump("libelle_adresse_client : " . $libelle_adresse_client);
			var_dump("ville_adresse_client : " . $ville_adresse_client);
			var_dump("cp_adresse_client : " . $cp_adresse_client);
			
			// /*********** AJOUT DES ADRESSES DANS LA BD ***********/
			// /*********** ADRESSE DU CLIENT ***********/
			// $req = "SELECT id_adresse 
			// 		FROM ADRESSE 
			// 		WHERE libelle_adresse = '".$libelle_adresse_client."' 
			// 			  AND ville_adresse = '".$ville_adresse_client."'
			// 			  AND cp_adresse = '".$cp_adresse_client."'"; 		  
			// // TO DO : get_requete()
			// $result = $bd->get_requete($req);

			// // L'adresse est-t-elle déja dans la bd ? 
			// if (empty($result)) {
			// 	// Non : ajout de l'adresse
			// 	$req = "INSERT INTO ADRESSE VALUES ('".$libelle_adresse_client."', 
			// 										'".$ville_adresse_client."', 
			// 										'".$cp_adresse_client."')";
			// 	$bd->set_requete($req);
			// 	$req = "SELECT id_adresse 
			// 			FROM ADRESSE 
			// 			WHERE libelle_adresse = '".$libelle_adresse_client."' 
			// 				  AND ville_adresse = '".$ville_adresse_client."' 
			// 				  AND cp_adresse = '".$cp_adresse_client."'"; 
			// 	$result = $bd->get_requete($req);
			// }
			// $id_adresse_client = $result[0];

			// /*********** ADRESSE DE L'ELEVE ***********/
			// $req = "SELECT id_adresse 
			// 		FROM ADRESSE 
			// 		WHERE libelle_adresse = '".$libelle_adresse_eleve."' 
			// 			  AND ville_adresse = '".$ville_adresse_eleve."'
			// 			  AND cp_adresse = '".$cp_adresse_eleve."'"; 		  
			// // TO DO : get_requete()
			// $result = $bd->get_requete($req);

			// // L'adresse est-t-elle déja dans la bd ? 
			// if (empty($result)) {
			// 	// Non : ajout de l'adresse
			// 	$req = "INSERT INTO ADRESSE VALUES ('".$libelle_adresse_eleve."', 
			// 										'".$ville_adresse_eleve."', 
			// 										'".$cp_adresse_eleve."')";
			// 	$bd->set_requete($req);
			// 	$req = "SELECT id_adresse 
			// 			FROM ADRESSE 
			// 			WHERE libelle_adresse = '".$libelle_adresse_eleve."' 
			// 				  AND ville_adresse = '".$ville_adresse_eleve."' 
			// 				  AND cp_adresse = '".$cp_adresse_eleve."'"; 
			// 	$result = $bd->get_requete($req);
			// }
			// $id_adresse_eleve = $result[0];



			// /*********** AJOUT DU CLIENT DANS LA BD ***********/
			// $req = 	"SELECT id_client 
			// 		 FROM CLIENT 
			// 		 WHERE nom_client = '".$nom_client."' 
			// 			   AND prenom_client = '".$prenom_client."'
			// 			   AND num_client = '".$num_client."'"; 
			// // TO DO : get_requete()
			// $result = $bd->get_requete($req);
   
			// // Le client est t'il déja dans la bd ? 
			// if (empty($result)) {
			// 	// Non : ajout du client
			// 	$req = "INSERT INTO CLIENT VALUES ('".$nom_client."', '".$prenom_client."', 
			// 									   '".$num_client."', '".$id_adresse_client."')";

			// 	$bd->set_requete($req);
			// 	$req = 	"SELECT id_client 
			// 						 FROM CLIENT 
			// 						 WHERE nom_client = '".$nom_client."' 
			// 				      	 AND prenom_client = '".$prenom_client."' 
			// 				      	 AND num_client = '".$num_client."'"; 
			// 	$result = $bd->get_requete($req);
			// } 
			// // TO DO : à vérifier que c'est bien comme ça qu'on récupère l'id
			// $id_client_eleve = $result[0];

   // 			/*********** AJOUT DE L'ELEVE DANS LA BD ***********/
   // 			$req = 	"SELECT id_eleve 
			// 		 FROM CLIENT 
			// 		 WHERE nom_eleve = '".$nom_eleve."' 
			// 		 AND prenom_eleve = '".$prenom_eleve."' 
			// 		 AND num_eleve = '".$num_eleve."'
			// 		 AND naissance_eleve = '".$naissance_eleve."'"; 
			// // TO DO : get_requete()
			// $result = $bd->get_requete($req);
   
			// // L'élève est t'il déja dans la bd ? 
			// if (empty($result)) {
			// 	// Non : ajout du client
			// 	// TO DO : vérifier l'ordre des champs
			// 	$req = "INSERT INTO ELEVE VALUES ('".$nom_eleve."', '".$prenom_eleve."',
			// 									  '".$num_eleve."', '".$date_inscription."', 
			// 									  '".$naissance_eleve."', '".$id_adresse_eleve."', 
			// 									  '".$id_client_eleve."', '".$formule_eleve."',
			// 									  '".$id_salarie_eleve."')";

			// 	$bd->set_requete($req);
			// 	$req = 	"SELECT id_eleve 
			// 		     FROM CLIENT 
			// 		     WHERE nom_eleve = '".$nom_eleve."' 
			// 		           AND prenom_eleve = '".$prenom_eleve."'
			// 		           AND naissance_eleve = '".$naissance_eleve."'";  
			// 	$result = $bd->get_requete($reqClientExiste);
			// } 
		
			// // Popup de succès 
			// echo "<script> alert(\"Réservation effectuée. Nous vous contacterons prochainement\");</script>";
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
		<script>
		  $(function() {
		    $( "#datepicker" ).datepicker();
		  });
		  </script>
		<header>
			<!-- Navigation -->
	        <?php include('nav.php');?>
		</header>
		<form id="page-wrapper" action="inscriptionEleve.php" method="post">
			<div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Inscription Eleve</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <div class="row">
                <div class="col-lg-12">
                	<div class="panel panel-default">
                		<div class="panel-body">
					    	<div class="col-lg-6">
								<div id="formulaireInfosEleve" class="sectionsFormulaireEleve">
									<h3>Eleve</h3>
									<div class="input-group">
										<span class="input-group-addon" id="basic-addon1">Nom</span>
										<input name="nomEleve" type="text" class="form-control" aria-describedby="basic-addon1">
									</div>

									<div class="input-group">
										<span class="input-group-addon" id="basic-addon1">Prénom</span>
										<input name="prenomEleve" type="text" class="form-control" aria-describedby="basic-addon1">
									</div>

									<div class="input-group">
										<span class="input-group-addon glyphicon glyphicon-phone-alt" aria-hidden="true"></span>
										<input name="numEleve" type="text" class="form-control" placeholder="Ex: 0612345678" aria-describedby="basic-addon1">
									</div>

									<div class="input-group">
										<span class="input-group-addon glyphicon glyphicon-gift" aria-hidden="true"></span>
										<input name="anniversaireEleve" type="text" class="form-control" placeholder="TO DO : datepicker" aria-describedby="basic-addon1">
									</div>

									<div class="adresseBouton">
										<h5>Adresse</h5>
										<button onClick="remplirChampsAdresse()">Même adresse</button>
									</div>
									<div class="adresseFormulaire">
										<div class="input-group">
											<span class="input-group-addon" id="basic-addon1">N° et nom de rue</span>
											<textarea id="libelleAdresseEleve" name="libelleEleve" type="text" class="form-control" aria-describedby="basic-addon1" placeholder="Ex: 22 rue des pêcheurs"></textarea>
										</div>
										<div class="input-group">
											<span class="input-group-addon" id="basic-addon1">Code postal</span>
											<input id="codePostalAdresseEleve" name="codePostalEleve" type="text" class="form-control" aria-describedby="basic-addon1">
										</div>
										<div class="input-group">
											<span class="input-group-addon" id="basic-addon1">Ville</span>
											<input id="villeAdresseEleve" name="villeEleve" type="text" class="form-control" aria-describedby="basic-addon1">
										</div>
										<!-- TO DO -->
										<script type="text/javascript">
											remplirChampsAdresse() {
												document.getElementById("libelleAdresseEleve").value = document.getElementById("libelleAdresseClient").value;
												document.getElementById("codePostalAdresseEleve").value = document.getElementById("codePostalAdresseClient").value;
												document.getElementById("villeAdresseEleve").value = document.getElementById("villeAdresseClient").value;
											}
										</script>
									</div>
					    		</div>
					    		<div id="formulaireFormuleEleve" class="sectionsFormulaireEleve">
					    			<h3>Formule</h3>
					    			<div class="input-group">
					    				<div class="input-group">
					    					<span class="input-group-addon" id="basic-addon1">Formule</span>
											<select class="form-control" name="formule">
												<option value="1">Formule 1</option>
												<option value="2">Formule 2</option>
												<option value="3">Formule 3</option>
											</select>
										</div>
									</div>
					    		</div>
					    	</div>
					    	<div class="col-lg-6">
								<div id="formulaireInfosClient" class="sectionsFormulaireEleve">
									<h3>Client</h3>
									<div class="input-group">
										<span class="input-group-addon" id="basic-addon1">Nom</span>
										<input name="nomClient" type="text" class="form-control" aria-describedby="basic-addon1">
									</div>

									<div class="input-group">
										<span class="input-group-addon" id="basic-addon1">Prénom</span>
										<input name="prenomClient" type="text" class="form-control" aria-describedby="basic-addon1">
									</div>

									<div class="input-group">
										<span class="input-group-addon glyphicon glyphicon-phone-alt" aria-hidden="true"></span>
										<input name="numClient" type="text" class="form-control" placeholder="Ex: 0612345678" aria-describedby="basic-addon1">
									</div>

									<h5>Adresse</h5>
									<div class="adresseFormulaire">
										<div class="input-group">
											<span class="input-group-addon" id="basic-addon1">N° et nom de rue</span>
											<textarea id="libelleAdresseClient" name="libelleClient" type="text" class="form-control" aria-describedby="basic-addon1" placeholder="Ex: 22 rue des pêcheurs"></textarea>
										</div>
										<div class="input-group">
											<span class="input-group-addon" id="basic-addon1">Code postal</span>
											<input id="codePostalAdresseClient" name="codePostalClient" type="text" class="form-control" aria-describedby="basic-addon1">
										</div>
										<div class="input-group">
											<span class="input-group-addon" id="basic-addon1">Ville</span>
											<input id="villeAdresseClient" name="villeClient" type="text" class="form-control" aria-describedby="basic-addon1">
										</div>
									</div>
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