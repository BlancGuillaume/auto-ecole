<?php

/**
 * Description of LeconConduiteProvider
 *
 * @author Guillaume Blanc
 */

include_once('C:\wamp\www\auto-ecole\model\LeconConduite.php');
include_once('C:\wamp\www\auto-ecole\model\Salarie.php');
include_once('C:\wamp\www\auto-ecole\model\Voiture.php');
include_once('C:\wamp\www\auto-ecole\model\provider\FormuleProvider.php');
include_once('C:\wamp\www\auto-ecole\model\provider\AchatProvider.php');
include_once('C:\wamp\www\auto-ecole\model\provider\EleveProvider.php');
include_once('C:\wamp\www\auto-ecole\model\provider\VoitureProvider.php');

/**
 * Décommenter pour tester les requetes
 */
// LeconConduiteProvider::testMethodes();




class LeconConduiteProvider {
    
    /**
     * Récupère le nombre de lecons de conduite effectués par un élève
     * @param type $id - l'identifiant de l'élève
     * @return type le nombre de lecons effectuées par l'élève
     */
    public static function get_nombre_lecons_effectuees($id) {
        
        // Connection à la bdd
        include_once('ConnectionManager.php');
        $connectionManager = new ConnectionManager();
        $conn = $connectionManager->connect();

        // Récupération du nombre de lecons effectuées
        $req = oci_parse($conn, 'SELECT COUNT (*) '
                              . 'FROM LECON WHERE id_eleve_lecon = '. $id);

        // Execution de la requête
        oci_execute($req);

        // Traitement du résultat : récupération du nombre de lecons effectuées 
        $nombreLecons = 0; // par défaut
        while (($resultat = oci_fetch_array($req, OCI_RETURN_NULLS)) != false) {
            // une seule occruence
               $nombreLecons = $resultat[0];
        }
        
        return $nombreLecons;
    }
    
    /**
     * Détermine le nombres de lecons de conduites disponibles pour un élève
     * @param type $idEleve - l'identifiant de l'élève
     * @param type $idFormule - l'identifiant de la formule souscrite par l'élève
     * @return type le nombre de lecons disponibles
     */
    public static function get_nombre_lecons_disponibles($idEleve, $idFormule) {
        
        $nbreHeuresFormule = FormuleProvider::get_formule($idFormule)->get_nombreTickets();
        $nbreHeuresAchetees = AchatProvider::get_nombre_lecons_achetees($idEleve);
        $nbreHeuresConsommees = LeconConduiteProvider::get_nombre_lecons_effectuees($idEleve);
                
        return $nbreHeuresFormule + $nbreHeuresAchetees - $nbreHeuresConsommees;  
    }
    
    /**
     * Récupère toutes les lecons effectuées ou qui vont etre effectuées
     * @return les lecons de conduite
     */
    public static function get_lecons() {
        
        // Connection à la bdd
        include_once('ConnectionManager.php');
        $connectionManager = new ConnectionManager();
        $conn = $connectionManager->connect();
        
        // Récupération du nombre des lecons
        $req = oci_parse($conn, 'SELECT * FROM LECON');
        // Execution de la requête
        oci_execute($req);
        
         // Traitement du résultat : construction des lecons de conduite
        $lecons = array(); // tableau de lecons 
        while (($lecon = oci_fetch_array($req, OCI_RETURN_NULLS)) != false) {
            
            array_push($lecons, new LeconConduite($lecon['ID_LECON'],
                                                  EleveProvider::get_eleve($lecon['ID_ELEVE_LECON']),
                                                  SalarieProvider::get_nom_prenom_surnom_moniteur($lecon['ID_SALARIE_LECON']),
                                                  VoitureProvider::get_voiture($lecon['ID_VOITURE_LECON']),
                                                  $lecon['DATE_LECON']));
        }
        
        return $lecons;
    }
    
    /**
     * Récupère toutes les lecons effectuées ou qui vont etre effectuées par l'eleve
     * @return les lecons de conduite
     */
    public static function get_lecons_pour_un_eleve($id) {
        
        // Connection à la bdd
        include_once('ConnectionManager.php');
        $connectionManager = new ConnectionManager();
        $conn = $connectionManager->connect();
        
        // Récupération du nombre des lecons
        $req = oci_parse($conn, 'SELECT * FROM LECON WHERE id_eleve_lecon = '.$id);
        // Execution de la requête
        oci_execute($req);
        
         // Traitement du résultat : construction des lecons de conduite
        $lecons = array(); // tableau de lecons 
        while (($lecon = oci_fetch_array($req, OCI_RETURN_NULLS)) != false) {
            
            array_push($lecons, new LeconConduite($lecon['ID_LECON'],
                                                  EleveProvider::get_eleve($lecon['ID_ELEVE_LECON']),
                                                  SalarieProvider::get_nom_prenom_surnom_moniteur($lecon['ID_SALARIE_LECON']),
                                                  VoitureProvider::get_voiture($lecon['ID_VOITURE_LECON']),
                                                  $lecon['DATE_LECON']));
        }
        
        return $lecons;
    }
    
    /**
     * Récupère toutes les lecons effectuées ou qui vont etre encadrées par le moniteur
     * @return les lecons de conduite
     */
    public static function get_lecons_pour_un_salarie($id) {
        
        // Connection à la bdd
        include_once('ConnectionManager.php');
        $connectionManager = new ConnectionManager();
        $conn = $connectionManager->connect();
        
        // Récupération du nombre des lecons
        $req = oci_parse($conn, 'SELECT * FROM LECON WHERE id_salarie_lecon = '.$id);
        // Execution de la requête
        oci_execute($req);
        
         // Traitement du résultat : construction des lecons de conduite
        $lecons = array(); // tableau de lecons 
        while (($lecon = oci_fetch_array($req, OCI_RETURN_NULLS)) != false) {
            
            array_push($lecons, new LeconConduite($lecon['ID_LECON'],
                                                  EleveProvider::get_eleve($lecon['ID_ELEVE_LECON']),
                                                  SalarieProvider::get_nom_prenom_surnom_moniteur($lecon['ID_SALARIE_LECON']),
                                                  VoitureProvider::get_voiture($lecon['ID_VOITURE_LECON']),
                                                  $lecon['DATE_LECON']));
        }
        
        return $lecons;
    }
    
     /**
     * Récupère toutes les lecons effectuées qui concernent uen voiture
     * @param id - l'id de la voiture
     * @return les lecons de conduite
     */
    public static function get_lecons_pour_une_voiture($id) {
        
        // Connection à la bdd
        include_once('ConnectionManager.php');
        $connectionManager = new ConnectionManager();
        $conn = $connectionManager->connect();
        
        // Récupération du nombre des lecons
        $req = oci_parse($conn, 'SELECT * FROM LECON WHERE id_voiture_lecon = '.$id);
        // Execution de la requête
        oci_execute($req);
        
         // Traitement du résultat : construction des lecons de conduite
        $lecons = array(); // tableau de lecons 
        while (($lecon = oci_fetch_array($req, OCI_RETURN_NULLS)) != false) {
            
            array_push($lecons, new LeconConduite($lecon['ID_LECON'],
                                                  EleveProvider::get_eleve($lecon['ID_ELEVE_LECON']),
                                                  SalarieProvider::get_nom_prenom_surnom_moniteur($lecon['ID_SALARIE_LECON']),
                                                  VoitureProvider::get_voiture($lecon['ID_VOITURE_LECON']),
                                                  $lecon['DATE_LECON']));
        }
        
        return $lecons;
    }
    
    
        
    /**
     * Recupere une lecon de conduite en fonction de son identifiant
     * @param type $id - l'identifiant de la lecon
     */
    public static function get_lecon($id) {
        
        // Connection à la bdd
        include_once('ConnectionManager.php');
        $connectionManager = new ConnectionManager();
        $conn = $connectionManager->connect();
        
        // Récupération du nombre des lecons
        $req = oci_parse($conn, 'SELECT * FROM LECON WHERE id_lecon = '.$id);
        // Execution de la requête
        oci_execute($req);
        
        // Traitement du résultat : construction des lecons de conduite
        $lecon = null; // tableau de lecon
        while (($resultat = oci_fetch_array($req, OCI_RETURN_NULLS)) != false) {
            
            $lecon =  new LeconConduite($resultat['ID_LECON'],
                                                  EleveProvider::get_eleve($resultat['ID_ELEVE_LECON']),
                                                  SalarieProvider::get_nom_prenom_surnom_moniteur($resultat['ID_SALARIE_LECON']),
                                                  VoitureProvider::get_voiture($resultat['ID_VOITURE_LECON']),
                                                  $resultat['DATE_LECON']);
        }
        
        return $lecon;
    }
  
    
    /**
     * Ajoute une leçon dans la base de donnée
     * @param LeconConduite $leconConduite la leçon a ajouter
     */
    public static function ajout_lecon(LeconConduite $leconConduite) {
        
        // Connection à la bdd
        include_once('ConnectionManager.php');
        $connectionManager = new ConnectionManager();
        $conn = $connectionManager->connect();
         
        $req = "INSERT INTO LECON VALUES (examen_conduite_seq.nextVal,TO_DATE('"
                                            .$leconConduite->getDate()."', 'yyyy/mm/dd'), '"
                                            .$leconConduite->get_eleve()->get_id()."', '"
                                            .$leconConduite->get_salarie()->get_id()."', '"
                                            .$leconConduite->get_voiture()->get_id()."')"; 
        
        var_dump($req);
                                            
        // Execution de la requete
        $aExecuter = oci_parse($conn, $req);
        $resultat = oci_execute($aExecuter);
        
        var_dump($resultat);
       
    }
    
     /**
     * Test des méthodes ci dessus
     */
    public static function testMethodes() {

        $nbreLeconsEffectuees = LeconConduiteProvider::get_nombre_lecons_effectuees(3);
        echo "nbre lecons effectues : " . $nbreLeconsEffectuees . "<br>";

        $nbreLeconsDisponibles = LeconConduiteProvider::get_nombre_lecons_disponibles(3, 2);
        echo "nbre lecons disponibles : " . $nbreLeconsDisponibles . "<br>";

        // Test ajout d'une lecon de conduite
        $salarie = new Salarie(1, null, null, null, null, null, null, null, null, null, null, null); // pour le test
        $voiture = new Voiture(1, "biordeded", date("Y/m/d"), 15000, true, "audi", "tt", "239", null);
        $eleve = new Eleve(1, null, null, null, null, null, null, null, null, null, null, null, null, null, null);
        $lecon = new LeconConduite(1, $eleve, $salarie, $voiture, date("Y/m/d"));
        LeconConduiteProvider::ajout_lecon($lecon);

        /* récupération de toutes les lecons */
        $lecons = LeconConduiteProvider::get_lecons();
        echo "récupération de toutes les lecons de l'auto ecole <br>";
        foreach ($lecons as $lecon) {
            echo "id : " . $lecon->get_id() . "<br>";

            // Eleve qui participe a la lecon
            echo "eleve qui participe a la lecon <br>";
            echo "id : " . $lecon->get_eleve()->get_id() . "<br>";
            echo "nom : " . $lecon->get_eleve()->get_nom() . "<br>";
            echo "prenom :" . $lecon->get_eleve()->get_prenom() . "<br>";
            echo "<br>";

            // Voiture de la lecon
            echo "voiture de la lecon <br>";
            echo "id : " . $lecon->get_voiture()->get_id() . "<br>";
            echo "immatriculation : " . $lecon->get_voiture()->get_immatriculation() . "<br>";
            echo "marque : " . $lecon->get_voiture()->get_marque() . "<br>";
            echo "modele ; " . $lecon->get_voiture()->get_modele() . "<br>";
            echo "<br>";

            // Moniteur qui encadre la lecon
            echo "moniteur qui encadre la lecon <br>";
            echo "id : " . $lecon->get_salarie()->get_id() . "<br>";
            echo "nom : " . $lecon->get_salarie()->get_nom() . "<br>";
            echo "prenom : " . $lecon->get_salarie()->get_prenom() . "<br>";
            echo "surnom : " . $lecon->get_salarie()->get_surnom() . "<br>";
            echo "<br>";
            echo "<br>";
        }


        /* Récupération d'une lecon de conduite */
        echo "Récupération d'une lecon de conduite <br>";
        $uneLecon = LeconConduiteProvider::get_lecon(1);
        echo "id : " . $uneLecon->get_id() . "<br>";

// Eleve qui participe a la lecon
        echo "eleve qui participe a la lecon <br>";
        echo "id : " . $uneLecon->get_eleve()->get_id() . "<br>";
        echo "nom : " . $uneLecon->get_eleve()->get_nom() . "<br>";
        echo "prenom :" . $uneLecon->get_eleve()->get_prenom() . "<br>";
        echo "<br>";

// Voiture de la lecon
        echo "voiture de la lecon <br>";
        echo "id : " . $uneLecon->get_voiture()->get_id() . "<br>";
        echo "immatriculation : " . $uneLecon->get_voiture()->get_immatriculation() . "<br>";
        echo "marque : " . $uneLecon->get_voiture()->get_marque() . "<br>";
        echo "modele ; " . $uneLecon->get_voiture()->get_modele() . "<br>";
        echo "<br>";

// Moniteur qui encadre la lecon
        echo "moniteur qui encadre la lecon <br>";
        echo "id : " . $uneLecon->get_salarie()->get_id() . "<br>";
        echo "nom : " . $uneLecon->get_salarie()->get_nom() . "<br>";
        echo "prenom : " . $uneLecon->get_salarie()->get_prenom() . "<br>";
        echo "surnom : " . $uneLecon->get_salarie()->get_surnom() . "<br>";
        echo "<br>";

        /* Récupération de toutes les lecons pour un eleve */
        echo "récupération de toutes les lecons pour un eleve <br>";
        $leconsPourUnEleve = LeconConduiteProvider::get_lecons_pour_un_eleve(1);
        foreach ($leconsPourUnEleve as $lecon) {
            echo "id : " . $lecon->get_id() . "<br>";

            // Eleve qui participe a la lecon
            echo "eleve qui participe a la lecon <br>";
            echo "id : " . $lecon->get_eleve()->get_id() . "<br>";
            echo "nom : " . $lecon->get_eleve()->get_nom() . "<br>";
            echo "prenom :" . $lecon->get_eleve()->get_prenom() . "<br>";
            echo "<br>";

            // Voiture de la lecon
            echo "voiture de la lecon <br>";
            echo "id : " . $lecon->get_voiture()->get_id() . "<br>";
            echo "immatriculation : " . $lecon->get_voiture()->get_immatriculation() . "<br>";
            echo "marque : " . $lecon->get_voiture()->get_marque() . "<br>";
            echo "modele ; " . $lecon->get_voiture()->get_modele() . "<br>";
            echo "<br>";

            // Moniteur qui encadre la lecon
            echo "moniteur qui encadre la lecon <br>";
            echo "id : " . $lecon->get_salarie()->get_id() . "<br>";
            echo "nom : " . $lecon->get_salarie()->get_nom() . "<br>";
            echo "prenom : " . $lecon->get_salarie()->get_prenom() . "<br>";
            echo "surnom : " . $lecon->get_salarie()->get_surnom() . "<br>";
            echo "<br>";
            echo "<br>";
        }

        /* Récupération de toutes les lecons pour un salarié */
        echo "récupération de toutes les lecons pour un salarié <br>";
        $leconsPourUnSalarie = LeconConduiteProvider::get_lecons_pour_un_salarie(1);
        foreach ($leconsPourUnSalarie as $lecon) {
            echo "id : " . $lecon->get_id() . "<br>";

            // Eleve qui participe a la lecon
            echo "eleve qui participe a la lecon <br>";
            echo "id : " . $lecon->get_eleve()->get_id() . "<br>";
            echo "nom : " . $lecon->get_eleve()->get_nom() . "<br>";
            echo "prenom :" . $lecon->get_eleve()->get_prenom() . "<br>";
            echo "<br>";

            // Voiture de la lecon
            echo "voiture de la lecon <br>";
            echo "id : " . $lecon->get_voiture()->get_id() . "<br>";
            echo "immatriculation : " . $lecon->get_voiture()->get_immatriculation() . "<br>";
            echo "marque : " . $lecon->get_voiture()->get_marque() . "<br>";
            echo "modele ; " . $lecon->get_voiture()->get_modele() . "<br>";
            echo "<br>";

            // Moniteur qui encadre la lecon
            echo "moniteur qui encadre la lecon <br>";
            echo "id : " . $lecon->get_salarie()->get_id() . "<br>";
            echo "nom : " . $lecon->get_salarie()->get_nom() . "<br>";
            echo "prenom : " . $lecon->get_salarie()->get_prenom() . "<br>";
            echo "surnom : " . $lecon->get_salarie()->get_surnom() . "<br>";
            echo "<br>";
            echo "<br>";
        }

        /* Récupération de toutes les lecons pour une voiture */
        echo "récupération de toutes les lecons pour une voiture <br>";
        $leconsPourUnSalarie = LeconConduiteProvider::get_lecons_pour_une_voiture(1);
        foreach ($leconsPourUnSalarie as $lecon) {
            echo "id : " . $lecon->get_id() . "<br>";

            // Eleve qui participe a la lecon
            echo "eleve qui participe a la lecon <br>";
            echo "id : " . $lecon->get_eleve()->get_id() . "<br>";
            echo "nom : " . $lecon->get_eleve()->get_nom() . "<br>";
            echo "prenom :" . $lecon->get_eleve()->get_prenom() . "<br>";
            echo "<br>";

            // Voiture de la lecon
            echo "voiture de la lecon <br>";
            echo "id : " . $lecon->get_voiture()->get_id() . "<br>";
            echo "immatriculation : " . $lecon->get_voiture()->get_immatriculation() . "<br>";
            echo "marque : " . $lecon->get_voiture()->get_marque() . "<br>";
            echo "modele ; " . $lecon->get_voiture()->get_modele() . "<br>";
            echo "<br>";

            // Moniteur qui encadre la lecon
            echo "moniteur qui encadre la lecon <br>";
            echo "id : " . $lecon->get_salarie()->get_id() . "<br>";
            echo "nom : " . $lecon->get_salarie()->get_nom() . "<br>";
            echo "prenom : " . $lecon->get_salarie()->get_prenom() . "<br>";
            echo "surnom : " . $lecon->get_salarie()->get_surnom() . "<br>";
            echo "<br>";
            echo "<br>";
        }
    }

}
