<?php

/**
 * Provider de la table Achat
 * @author Guillaume Blanc
 */
class AchatProvider {
   
    /**
     * Récupère le nombre d'heures achetées pour un élève
     * @param type $idEleve - l'identifiant de l'élève
     * @return le nombre d'heures achetées
     */
    public function get_nombre_lecons_achetees($idEleve) {
        
        $conn = include_once('model/ConnectionManager.php');

        // Récupération de la forumule
        $req = oci_parse($conn, 'SELECT COUNT(*) '
                              . 'FROM ACHAT WHERE id_eleve_achat = '. $idEleve);

        // Execution de la requête
        oci_execute($req);

        // Traitement du résultat : on 
        while ($resultats = oci_fetch_array($req)) {
            foreach ($resultats as $resultat) {
                // Une seule occurence
               $nombreLeconsAchetees = $resultat;
            }
        }
          
        return $nombreLeconsAchetees; 
    }   
}
