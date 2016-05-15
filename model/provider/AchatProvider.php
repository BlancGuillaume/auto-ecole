<?php

/**
 * Provider de la table Achat
 * @author Guillaume Blanc
 */

include_once('C:\wamp\www\auto-ecole\model\Achat.php');
include_once('C:\wamp\www\auto-ecole\model\Eleve.php');
include_once('C:\wamp\www\auto-ecole\model\Client.php');
include_once('C:\wamp\www\auto-ecole\model\LeconConduite.php');

/**
 * Décommenter pour tester les requetes
 */
 //AchatProvider::testMethodes();

class AchatProvider {
   
    /**
     * Récupère le nombre d'heures achetées pour un élève
     * @param type $idEleve - l'identifiant de l'élève
     * @return le nombre d'heures achetées
     */
    public static function get_nombre_lecons_achetees($idEleve) {
        
        // Connection à la bdd
        include_once('ConnectionManager.php');
        $connectionManager = new ConnectionManager();
        $conn = $connectionManager->connect();

        // Récupération du nombres de lecons achetées 
        $req = oci_parse($conn, 'SELECT SUM(nb_tickets_achat) '
                              . 'FROM ACHAT WHERE id_eleve_achat = '. $idEleve);

        // Execution de la requête
        oci_execute($req);
        
        // Traitement du résultat : récupération du nombre de lecons achetées 
        $nombreLeconsAchetees = 0; // par défaut aucune
        while (($resultat = oci_fetch_array($req, OCI_RETURN_NULLS)) != false) {
            // une seule occruence
            $nombreLeconsAchetees = $resultat[0]; // Car un seul résultat
        }
        
        return $nombreLeconsAchetees;
    }   
    
    /**
     * Récupère les achats d'un client
     * @param type $idClient - le client qui a effectué des achats
     * @return les achats du client
     */
    public static function get_achats_dun_client($idClient) {
        
        // Connection à la bdd
        include_once('ConnectionManager.php');
        $connectionManager = new ConnectionManager();
        $conn = $connectionManager->connect();

        // Récupération des achats d'un client
        $req = oci_parse($conn, 'SELECT * '
                              . 'FROM ACHAT, ELEVE '
                              . 'WHERE ACHAT.id_eleve_achat = ELEVE.id_eleve '
                              . 'AND ACHAT.id_client_achat = '. $idClient);

        // Execution de la requête
        oci_execute($req);
        
         // Traitement du résultat : construction des achats 
        $achats = array(); // tableau d'achats 
        while (($achat = oci_fetch_array($req, OCI_RETURN_NULLS)) != false) {
            
            array_push($achats,   new Achat($achat['ID_ACHAT'],
                                      $achat['NB_TICKETS_ACHAT'],
                                      $achat['MONTANT_ACHAT'],
                                      $achat['DATE_ACHAT'], 
                                      new Eleve($achat['ID_ELEVE'], $achat['PRENOM_ELEVE'], $achat['NOM_ELEVE'],
                                      NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL), NULL));  
        }
        
        return $achats;
    }
    
    /**
     * Ajout d'un achat dans la bdd
     * @param type $achat
     */
    public static function ajout_achat($achat) {
                     
        // Connection à la bdd
        include_once('ConnectionManager.php');
        $connectionManager = new ConnectionManager();
        $conn = $connectionManager->connect();
         
        $req = "INSERT INTO ACHAT VALUES (achat_seq.nextVal,"
                                            .$achat->getClientFacture()->get_id()." , "
                                            .$achat->getEleveBeneficiaire()->get_id()." , "
                                            .$achat->get_nbreLecons() . " , "
                                            ."TO_DATE('" . date("Y/m/d") ."', 'yyyy/mm/dd'), '"
                                            .$achat->get_montant()."')"; 
                      
        // Execution de la requete
        $aExecuter = oci_parse($conn, $req);
        $resultat = oci_execute($aExecuter);
    }

    /**
     * Test des méthodes ci dessus
     */
    public static function testMethodes() {

        $eleveBeneficiaire = new Eleve(2, null, null, null, null, null, null, null, null, null, null, null, null, null, null);
        $clientFacture = new Client(1, null, null, null, null, null, null, null, null);

        $unAchat = new Achat(null, 33, 800, date("Y/m/d"), $eleveBeneficiaire, $clientFacture);
        AchatProvider::ajout_achat($unAchat);

        $nbreLeconsAchetees = AchatProvider::get_nombre_lecons_achetees(2);
        echo "nombre de lecons achetées : " . $nbreLeconsAchetees;
        
        $achats = AchatProvider::get_achats_dun_client(1);

        foreach ($achats as $achat) {
            // Récupération de toutes les achats d'un client
            echo "Récupération de toutes les achats<br>";
            echo "id : " . $achat->get_id() . "<br>";
            echo "nbre lecons : " . $achat->get_nbreLecons() . "<br>";
            echo "montant : " . $achat->get_montant() . "<br>";
            echo "date achat : " . $achat->get_dateAchat() . "<br>";
            echo "id eleve : " . $achat->getEleveBeneficiaire()->get_id() . "<br>";
            echo "prenom eleve : " . $achat->getEleveBeneficiaire()->get_prenom() . "<br>";
            echo "nom eleve : " . $achat->getEleveBeneficiaire()->get_nom() . "<br>";
            echo "<br>" . "<br>";
        }
    }
}
