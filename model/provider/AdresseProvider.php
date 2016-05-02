<?php

/**
 * Requetes permettant de récupérer des adresses 
 * => Construction des objets Adresse
 * @author Guillaume Blanc
 */
class AdresseProvider {

    /**
     * Récupération d'une adresse à partir de son identifiant
     * @param type $id - l'id de l'adresse a récupérer
     * @return adresse - l'adresse récupérée
     */
    public function get_adresse($id) {

        $conn = include_once('model/ConnectionManager.php');

        // Récupération de l'adresse
        $req = oci_parse($conn, 'SELECT * FROM ADRESSE WHERE id_adresse = '. $id);

        // Execution de la requête
        oci_execute($req);

        // Traitement du résultat : construction de l'adresse
        while ($resultats = oci_fetch_array($req)) {
            foreach ($resultats as $resultat) {
                // Une seule occurence
                $adresse = new Adresse($resultat['id_adresse'],
                                       $resultat['libelle_adresse'], 
                                       $resultat['ville_adresse'],
                                       $resultat['cp_adresse']);
            }
        }
        
        return $adresse;
    }
}
