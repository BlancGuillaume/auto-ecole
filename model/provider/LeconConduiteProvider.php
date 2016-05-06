<?php

/**
 * Description of LeconConduiteProvider
 *
 * @author Guillaume Blanc
 */
class LeconConduiteProvider {
    
    /**
     * Récupère le nombre de lecons de conduite effectués par un élève
     * @param type $id - l'identifiant de l'élève
     * @return type le nombre de lecons effectuées par l'élève
     */
    public function get_nombre_lecons_effectuees($id) {
        
        $conn = include_once('model/ConnectionManager.php');

        // Récupération de la forumule
        $req = oci_parse($conn, 'SELECT COUNT(*) '
                              . 'FROM LECON WHERE id_eleve_lecon = '. $id);

        // Execution de la requête
        oci_execute($req);

        // Traitement du résultat : on 
        while ($resultats = oci_fetch_array($req)) {
            foreach ($resultats as $resultat) {
                // Une seule occurence
               $nombreLecons = $resultat;
            }
        }
          
        return $nombreLecons; 
    }
    
    /**
     * Détermine le nombres de lecons de conduites disponibles pour un élève
     * @param type $idEleve - l'identifiant de l'élève
     * @param type $idFormule - l'identifiant de la formule souscrite par l'élève
     * @return type le nombre de lecons disponibles
     */
    public function get_nombre_lecons_disponibles($idEleve, $idFormule) {
        
        $nbreHeuresFormule = FormuleProvider::get_formule($idFormule).get_nombreTickets();
        $nbreHeuresAchetees = AchatProvider::get_nombre_lecons_achetees($idEleve);
        $nbreHeuresConsommees = LeconConduiteProvider::get_nombre_lecons_effectuees($idEleve);
                
        return $nbreHeuresFormule + $nbreHeuresAchetees - $nbreHeuresConsommees;  
    }
    
    
    public function ajout_lecon(LeconConduite $leconConduite) {
        
        $req = "INSERT INTO LECON VALUES ('".$leconConduite->get_id()."', '"
                                            .date("Y-m-d H:i:s")
                                            .$leconConduite->get_eleve()->get_id()."', '"
                                            .$leconConduite->get_salarie()->get_id()."', '"
                                            .$leconConduite->get_voiture()->get_id()."')"; 
    }
}
