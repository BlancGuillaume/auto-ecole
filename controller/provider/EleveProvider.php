<?php

/**
 * Requete permettant de récupérer touts les élèves
 * => Création des objets élèves
 * 
 * @author Guillaume Blanc
 */
include_once('model/Voiture.php');

class EleveProvider {
    
    function get_eleves() {
        
        $conn = include_once('model/ConnectionManager.php');

        // Récupération de toutes les voitures
        $reqStructure = 'SELECT *'
                      . 'FROM ELEVE e, ADRESSE a, CLIENT c, SALARIE s, FORMULE f'
                      . 'WHERE e.adresse ';
                      // TODO : TEMRINER
        
        $req = oci_parse($conn, $reqStructure);
        // Execution de la requête
        oci_execute($req);

        // Traitement du résultat : construction des formules
        while ($resultat = oci_fetch_array($req)) {
            foreach ($resultat as $eleve) {
                
            }
        }
        
    }
}
