<?php

/**
 * Requetes permettant de récupérer des adresses 
 * => Construction des objets Adresse
 * @author Guillaume Blanc
 */

include_once('C:\wamp\www\auto-ecole\model\Adresse.php');

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
        while (($resultat = oci_fetch_array($req, OCI_RETURN_NULLS)) != false) {
            // une seule occurence
            $adresse = new Adresse($resultat['ID_ADRESSE'],
                                   $resultat['LIBELLE_ADRESSE'], 
                                   $resultat['VILLE_ADRESSE'],
                                   $resultat['CP_ADRESSE']);
        }
        
        return $adresse;
    }
    
    
    
    /**
     * Récupère l'identifiant d'une adresse
     * @param type $adresse - l'adresse dont on souhaite connaitre l'identifiant
     */
    public static function get_id_adresse($adresse) {
         
        // Connection à la bdd
        include_once('ConnectionManager.php');
        $connectionManager = new ConnectionManager();
        $conn = $connectionManager->connect();

        // Récupération de l'adresse
        $laRequete = 'SELECT id_adresse '
                              . 'FROM ADRESSE '
                              . 'WHERE libelle_adresse = '."'".$adresse->get_rue()."'"
                              . ' AND ville_adresse = '."'".$adresse->get_ville()."'"
                              . ' AND cp_adresse = '."'".$adresse->get_codePostal()."'";
       
        $req = oci_parse($conn, $laRequete);
                
        // Execution de la requête
        oci_execute($req);
                
        // Traitement du résultat : construction de l'adresse
        $idAdresse = null;
        while (($resultat = oci_fetch_array($req, OCI_RETURN_NULLS)) != false) {
            // une seule occurence
            $idAdresse = $resultat['ID_ADRESSE'];              
        }
        
        return $idAdresse;
    }
    
    public static function ajout_adresse($adresse) {
        
        // Si l'adresse n'existe pas déja on l'ajoute
        if (is_null(AdresseProvider::get_id_adresse($adresse))) {
            
            // Connection à la bdd
            include_once('ConnectionManager.php');
            $connectionManager = new ConnectionManager();
            $conn = $connectionManager->connect();
        
            $req = "INSERT INTO ADRESSE VALUES (adresse_seq.nextVal, '"
                                            .$adresse->get_rue()."' , '"
                                            .$adresse->get_ville()."' , '"
                                            .$adresse->get_codePostal()."')";        
            // Execution de la requete
            $aExecuter = oci_parse($conn, $req);
            $resultat = oci_execute($aExecuter);

        }
        // else : existe déja
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

        // test récupération de l'id d'une adresse
        $uneAdresse = new Adresse(null, '22 rue de la pipelette', 'FLAVIN', '12450');
        $idAdresse = AdresseProvider::get_id_adresse($uneAdresse);
        echo "id de l'adresse rue de la pipelette flavin : " . $idAdresse;

        // test ajout adresse
        echo "test ajout adresse";
        $adresseAAjouter = new Adresse(null, "8 rue courbet", "CARMAUX", '12450');
        AdresseProvider::ajout_adresse($adresseAAjouter);
    }

}
