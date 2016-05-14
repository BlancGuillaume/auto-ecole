<?php 
    session_start();

    // VERIFIER QUE VARIABLES POST EXISTE
    if (isset($_POST['mdpUtilisateur']) && isset($_POST['nomUtilisateur'])) {
   		if ($_POST['mdpUtilisateur'] == '3SYL' && $_POST['nomUtilisateur'] == '3SYL') {
        session_start();
        $_SESSION['login'] = $_POST['nomUtilisateur'];
        $_SESSION['erreurConnection'] = 0;
        header('Location: index.php');
        exit();
      }
      else {
        $_SESSION['erreurConnection'] = -1;
        header('Location: connexion.php');
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
  </body>
  <form id="page-wrapper" action="connexion.php" method="post">
    <div class="row">
        <div class="col-lg-24">
          <div class="panel panel-default">
            <div class="panel-body">
              <div id="formulaireInfosEleve" class="sectionsFormulaireEleve">
                <h3>Connexion</h3>
                <div class="input-group">
                  <span class="input-group-addon" id="basic-addon1">Login</span>
                  <input name="nomUtilisateur" type="text" class="form-control" aria-describedby="basic-addon1">
                </div>
                <div class="input-group">
                  <span class="input-group-addon" id="basic-addon1">Mot de passe</span>
                  <input type="password" name="mdpUtilisateur" type="text" class="form-control" aria-describedby="basic-addon1">
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <button id="boutonAjout" name="action" type="submit" class="btn btn-primary">Connexion</button>
  </form>
</html>

