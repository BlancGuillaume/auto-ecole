<?php
 
/**
 * Description of MoniteurProvider
 *
 * @author blanc
 */
class SalarieProvider {
    
    /**
     * Récupère les informations du moniteur spécifié par son id
     * @param $id - l'identifiant du moniteur
     */
    public function get_nom_prenom_surnom_moniteur($id) {
        
        $conn = include_once('model/ConnectionManager.php');

        // Récupération du moniteur correspondant à l'identifiant
        $req = oci_parse($conn, 'SELECT id_salarie, prenom_salarie, nom_salarie, surnom_salarie'
                              . 'FROM SALARIE WHERE id_salarie = '.$id);
        
        // Execution de la requête
        oci_execute($req);

        // Traitement du résultat : construction des formules
        while ($resultat = oci_fetch_array($req)) {
            foreach ($resultat as $salarie) {
                // Une seule occurence
                $moniteur = new Salarie($salarie['id_salarie'],
                                        $salarie['prenom_salarie'],
                                        $salarie['nom_salarie'],
                                        NULL, NULL, NULL, NULL,
                                        $salarie['surnom_salarie'],
                                        NULL, NULL, NULL, NULL);
            }
        }
        
        return $moniteur;
    }
    
    
    /**
     * Toutes les informations du salarié
     * @param type $id
     */
    function get_salarie_detail($id) {
       // Tout : sauf pour la voiture on choppe pas le gars (pour éviter de boucler) 
    }
    
    function get_salaries() {
        
    }
}
