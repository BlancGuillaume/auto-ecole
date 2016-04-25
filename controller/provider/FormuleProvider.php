<?php

/*
 * Requete permettant de récupérer les formules
 * => Construction des objets Formule
 * @author Guillaume Blanc
 */

include_once('model/Formule.php');

$test = include_once('model/Formule.php');

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

}
