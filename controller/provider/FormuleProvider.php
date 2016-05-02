<?php

/*
 * Requete permettant de récupérer les formules
 * => Construction des objets Formule
 * @author Guillaume Blanc
 */

include_once('model/Formule.php');

class FormuleProvider {

    /**
     * Récupère toutes les formules proposées par l'auto-école
     * @return \Formule - la liste de toutes les formules
     */
    function get_formules() {

        $conn = include_once('model/ConnectionManager.php');
        
        // Récupération de toutes les formules
        $req = oci_parse($conn, 'SELECT * FROM FORMULE');
        // Execution de la requête
        oci_execute($req);

        // Traitement du résultat : construction des formules
        while ($resultat = oci_fetch_array($req)) {
            foreach ($resultat as $formule) {
                $formules[] = new Formule($formule['id_formule'], 
                                          $formule['prix_formule'], 
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
        
        $conn = include_once('model/ConnectionManager.php');

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