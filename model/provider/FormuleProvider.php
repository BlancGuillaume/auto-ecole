<?php

/*
 * Requete permettant de récupérer les formules
 * => Construction des objets Formule
 * @author Guillaume Blanc
 */

include_once('../Formule.php');

/**
 * Décommenter pour tester les requetes
 */
// FormuleProvider::testMethodes();

class FormuleProvider {

    /**
     * Récupère toutes les formules proposées par l'auto-école
     * @return \Formule - la liste de toutes les formules
     */
    public static function get_formules() {
        
        // Connection à la bdd
        include_once('ConnectionManager.php');
        $connectionManager = new ConnectionManager();
        $conn = $connectionManager->connect();
        
        $req = oci_parse($conn, 'SELECT * FROM FORMULE');
        
        // Execution de la requête
	oci_execute($req);

        // Traitement du résultat : construction des formules
        $formules = array(); // tableau de formules 
        while (($formule = oci_fetch_array($req, OCI_BOTH)) != false) {
            
            array_push($formules,   new Formule($formule["ID_FORMULE"], 
                                                $formule["PRIX_FORMULE"], 
                                                $formule['NB_TICKETS_FORMULE'],
                                                $formule['PRIX_LECONS_FORMULE'],
                                                $formule['DETAILS_FORMULE']));
        }
        
        return $formules;
    }
    
    /**
     * Récupère la formule correspondant à l'id spécifié
     * @param type $id - l'id de la formule à récupérer
     */
    public static function get_formule($id) {
        
        // Connection à la bdd
        include_once('ConnectionManager.php');
        $connectionManager = new ConnectionManager();
        $conn = $connectionManager->connect();

        // Récupération de la forumule
        $req = oci_parse($conn, 'SELECT * FROM FORMULE WHERE id_formule = '. $id);

        // Execution de la requête
        oci_execute($req);

        // Traitement du résultat : construction de la formule
        while (($resultat = oci_fetch_array($req, OCI_BOTH)) != false) {
            // une seule occruence
            $formule  = new Formule($resultat["ID_FORMULE"], 
                                    $resultat["PRIX_FORMULE"], 
                                    $resultat['NB_TICKETS_FORMULE'],
                                    $resultat['PRIX_LECONS_FORMULE'],
                                    $resultat['DETAILS_FORMULE']);
        }
        
        return $formule;
    }
    
    /**
     * Test des méthodes ci dessus
     */
    public static function testMethodes() {
        
        $formules = FormuleProvider::get_formules();

        foreach ($formules as $formule) {
            // Récupération de toutes les formules
            echo "id :" . $formule->get_id() . "<br>";
            echo "prix : " . $formule->get_prix() . "<br>";
            echo "detail : " . $formule->getDetail() . "<br>";
            echo "prix lecon : " . $formule->getPrixLecon() . "<br>";
            echo "nombre tickets : " . $formule->get_nombreTickets() . "<br>";
            echo "<br>";
        }

        $UneFomule = FormuleProvider::get_formule(21);
        echo "recuperation de la formule 21" . "<br>";
        echo "id :" . $UneFomule->get_id() . "<br>";
        echo "prix : " . $UneFomule->get_prix() . "<br>";
        echo "detail : " . $UneFomule->getDetail() . "<br>";
        echo "prix lecon : " . $UneFomule->getPrixLecon() . "<br>";
        echo "nombre tickets : " . $UneFomule->get_nombreTickets() . "<br>";
        echo "<br>";
    }

}
