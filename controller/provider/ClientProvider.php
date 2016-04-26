<?php

/**
 * Provider de la table
 * @author Guillaume Blanc
 */
class ClientProvider {
    
   /**
    * Récupère le nom et le prénom du client qui parraine l'élève
    * @param type $id - l'id du client à récupérer
    * @return string - le client
    */
    public function get_nom_prenom_client($id) {
       
        $conn = include_once('model/ConnectionManager.php');

        // Récupération de la forumule
        $req = oci_parse($conn, 'SELECT id_client, nom_client, prenom_client'
                              . 'FROM CLIENT WHERE id_client = '. $id);

        // Execution de la requête
        oci_execute($req);

        // Traitement du résultat : construction de la formule
        while ($resultats = oci_fetch_array($req)) {
            foreach ($resultats as $resultat) {
                // Une seule occurence
                $client = new Client($resultat['id_client'], 
                                     $resultat['prenom_client'], 
                                     $resultat['nom_client'], 
                                     null, null, null, null, null, null);
            }
        }
        
        return $client;
    }
}
