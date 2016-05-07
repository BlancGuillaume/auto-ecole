<?php

/*
 * Requete permettant de récupérer les formules
 * => Construction des objets Formule
 * @author Guillaume Blanc
 */

// include_once('model/Formule.php');

echo "test formule";

$formules = FormuleProvider::get_formules();

foreach($formules as $formule) {
    // Récupération de toutes les formules
    echo "id :".$formule->get_id();
    echo "prix : ".$formule->get_prix();
    echo "detail : ".$formule->getDetail();
    echo "prix lecon : ".$formule->getPrixLecon();
    echo "nombre tickets : ".$formule->get_nombreTickets();
    echo "";
}

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
        
        // Récupération de toutes les formules
        $req = oci_parse($conn, 'SELECT * FROM FORMULE');
        
        // Execution de la requête
        oci_execute($req);

        // Traitement du résultat : construction des formules
        $formules = array();
        while ($resultat = oci_fetch_array($req)) {
            foreach ($resultat as $formule) {
                $formules = new Formule($formule['id_formule'], 
                                          $formule['prix_formule'], 
                                          $formule['nb_tickets_formule'],
                                          $formule['prix_lecons_formule'],
                                          $formule['nb_tickets_formule']);
            }
        }

        return $formules;
    }
    
    /**
     * Récupère la formule correspondant à l'id spécifié
     * @param type $id - l'id de la formule à récupérer
     */
    public function get_formule($id) {
        
        // Connection à la bdd
        include_once('ConnectionManager.php');
        $connectionManager = new ConnectionManager();
        $conn = $connectionManager->connect();

        // Récupération de la forumule
        $req = oci_parse($conn, 'SELECT * FROM FORMULE WHERE id_formule = '. $id);

        // Execution de la requête
        oci_execute($req);

        // Traitement du résultat : construction de la formule
        while ($resultats = oci_fetch_array($req)) {
            foreach ($resultats as $resultat) {
                // Une seule occurence
                $formule = new Formule($resultat['id_formule'], 
                                       $resultat['prix_formule'], 
                                       $resultat['nb_tickets_formule']);
            }
        }
        
        return $formule;
    }
}
