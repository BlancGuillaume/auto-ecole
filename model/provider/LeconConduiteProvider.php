<?php

/**
 * Description of LeconConduiteProvider
 *
 * @author Guillaume Blanc
 */

include_once('../LeconConduite.php');
include_once('FormuleProvider.php');
include_once('AchatProvider.php');

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
     * Ajoute une leçon dans la base de donnée
     * @param LeconConduite $leconConduite la leçon a ajouter
     */
    public static function ajout_lecon(LeconConduite $leconConduite) {
        
        // Connection à la bdd
        include_once('ConnectionManager.php');
        $connectionManager = new ConnectionManager();
        $conn = $connectionManager->connect();
         
        $req = "INSERT INTO LECON VALUES (examen_conduite_seq.nextVal, '"
                                            .$leconConduite->getDate()."', '"
                                            .$leconConduite->get_eleve()->get_id()."', '"
                                            .$leconConduite->get_salarie()->get_id()."', '"
                                            .get_voiture()->get_id()."')"; 
                                            
        
        // Execution de la requete
        $aExecuter = oci_parse($conn, $req);
        oci_execute($aExecuter); 
       
    }
    
     /**
     * Test des méthodes ci dessus
     */
    public static function testMethodes() {

        $nbreLeconsEffectuees = LeconConduiteProvider::get_nombre_lecons_effectuees(3);
        echo "nbre lecons effectues : " . $nbreLeconsEffectuees . "<br>";

        $nbreLeconsDisponibles = LeconConduiteProvider::get_nombre_lecons_disponibles(3, 2);
        echo "nbre lecons disponibles : " . $nbreLeconsDisponibles . "<br>";
    }

}
