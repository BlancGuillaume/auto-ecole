<?php

/**
 * Requetes permettant de récupérer des adresses 
 * => Construction des objets Adresse
 * @author Guillaume Blanc
 */

include_once('../Adresse.php');

/**
 * Décommenter pour tester les requetes
 */
// AdresseProvider::testMethodes();

class AdresseProvider {

    /**
     * Récupération d'une adresse à partir de son identifiant
     * @param type $id - l'id de l'adresse a récupérer
     * @return adresse - l'adresse récupérée
     */
    public static function get_adresse($id) {

        // Connection à la bdd
        include_once('ConnectionManager.php');
        $connectionManager = new ConnectionManager();
        $conn = $connectionManager->connect();

        // Récupération de l'adresse
        $req = oci_parse($conn, 'SELECT * FROM ADRESSE WHERE id_adresse = '. $id);

        // Execution de la requête
        oci_execute($req);

        // Traitement du résultat : construction de l'adresse
        while (($resultat = oci_fetch_array($req, OCI_BOTH)) != false) {
            // une seule occurence
            $adresse = new Adresse($resultat['ID_ADRESSE'],
                                   $resultat['LIBELLE_ADRESSE'], 
                                   $resultat['VILLE_ADRESSE'],
                                   $resultat['CP_ADRESSE']);
        }
        
        return $adresse;
    }
    
     /**
     * Test des méthodes ci dessus
     */
    public static function testMethodes() {
        $uneAdresse = AdresseProvider::get_adresse(21);

        echo "recuperation de l'adresse 21" . "<br>";
        echo "id : " . $uneAdresse->get_id() . "<br>";
        echo "rue : " . $uneAdresse->get_rue() . "<br>";
        echo "ville : " . $uneAdresse->get_ville() . "<br>";
        echo "code postal : " . $uneAdresse->get_codePostal() . "<br>";
        echo "<br>";
    }

}
