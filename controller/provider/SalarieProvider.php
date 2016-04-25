<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of MoniteurProvider
 *
 * @author blanc
 */
class MoniteurProvider {
    
    /**
     * Récupère les informations du moniteur spécifié par son id
     * @param $id - l'identifiant du moniteur
     */
    public function get_nom_prenom_surnom_moniteur($id) {
        
        $conn = include_once('model/ConnectionManager.php');

        // Récupération du moniteur correspondant à l'identifiant
        $req = oci_parse($conn, 'SELECT * FROM VOITURE');
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
    }
}
