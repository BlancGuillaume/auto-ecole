<?php

/**
 * Provider de la table client
 * @author Guillaume Blanc
 */

include_once('../Client.php');
include_once('../Adresse.php');

/**
 * Décommenter pour tester les requetes
 */
// ClientProvider::testMethodes();



class ClientProvider {
    
   /**
    * Récupère le nom et le prénom du client qui parraine l'élève
    * @param type $id - l'id du client à récupérer
    * @return string - le client
    */
    public static function get_nom_prenom_client($id) {
       
        // Connection à la bdd
        include_once('ConnectionManager.php');
        $connectionManager = new ConnectionManager();
        $conn = $connectionManager->connect();

        // Récupération du client
        $req = oci_parse($conn, 'SELECT id_client, nom_client, prenom_client '
                              . 'FROM CLIENT WHERE id_client = '. $id);

        // Execution de la requête
        oci_execute($req);
        
        // Traitement du résultat : construction du client
        while (($resultat = oci_fetch_array($req, OCI_BOTH)) != false) {
            // une seule occruence
            $client = new Client($resultat['ID_CLIENT'], 
                                 $resultat['PRENOM_CLIENT'], 
                                 $resultat['NOM_CLIENT'], 
                                 null, null, null, null, null, null);
        }
        
        return $client;
        
        
    }
    
    /**
     * Récupère la liste de tous les clients
     * @return type les clients de l'auto-école
     */
    public static function get_clients() {

        // Connection à la bdd
        include_once('ConnectionManager.php');
        $connectionManager = new ConnectionManager();
        $conn = $connectionManager->connect();

        // Récupération de tous les clients de l'auto-ecole
        $reqStructure = 'SELECT * '
                      . 'FROM ADRESSE a, CLIENT c '
                      . 'WHERE c.id_adresse_client = a.id_adresse';

        $req = oci_parse($conn, $reqStructure);

        // Execution de la requête
        oci_execute($req);
        
        // Traitement du résultat : construction des clients
        while ($resultat = oci_fetch_array($req)) {
            foreach ($resultat as $client) {

                $clients[] = new Client($client['id_client'],
                                        $client['prenom_client'],
                                        $client['nom_client'], 
                                        $client['naissance_client'],
                                        $client['tel_domicile'],
                                        $client['tel_portable'],
                                        AdresseProvider::get_adresse($client['id_adresse_client']),
                                        EleveProvider::get_eleves_dun_client($client['id_client']),
                                        AchatProvider::get_achats_dun_client($client['id_client']));
            }
        }
        return $clients;
    }
    
    /**
     * Récupère les informations d'un client
     * @param $idClient - l'identifiant du client
     * @return le client qui correspond à l'identifiant
     */
    public static function get_client($idClient) {
        
        // Connection à la bdd
        include_once('ConnectionManager.php');
        $connectionManager = new ConnectionManager();
        $conn = $connectionManager->connect();

        // Récupération du client
        $reqStructure = 'SELECT * '
                      . 'FROM ADRESSE a, CLIENT c '
                      . 'WHERE c.id_adresse_client = a.id_adresse'
                      . 'AND c.id_client = '.$idClient;

        $req = oci_parse($conn, $reqStructure);

        // Execution de la requête
        oci_execute($req);
        
        // Traitement du résultat : construction du client
        while ($resultats = oci_fetch_array($req)) {
            foreach ($resultats as $resultat) {

                $client = new Client($resultat['id_client'],
                                        $resultat['prenom_client'],
                                        $resultat['nom_client'], 
                                        $resultat['naissance_client'],
                                        $resultat['tel_domicile'],
                                        $resultat['tel_portable'],
                                        AdresseProvider::get_adresse($resultat['id_adresse_client']),
                                        EleveProvider::get_eleves_dun_client($resultat['id_client']),
                                        AchatProvider::get_achats_dun_client($resultat['id_client']));
            }
        }
        return $client;
    }
    
    
    
    
    /** 
     * Ajoute un client à la bdd
     * @param $client - le client à ajouter à la bdd
     */
    public static function ajout_client(Client $client) {
        
        // Connection à la bdd
        include_once('ConnectionManager.php');
        $connectionManager = new ConnectionManager();
        $conn = $connectionManager->connect();
        
        $req = "INSERT INTO CLIENT VALUES (client_seq.nextVal, '"
                                            .$client->get_nom()."', '"
                                            .$client->get_prenom()."', '"
                                            .$client->get_telDomicile()."', '"
                                            .$client->get_telPortable()."', '"
                                            .$client->get_adresse()->get_id()."')"; 
        
        
        // Execution de la requete
        $aExecuter = oci_parse($conn, $req);
        oci_execute($aExecuter); 
        
    }
    
    /**
     * Test des méthodes ci dessus
     */
    public static function testMethodes() {

        $npClient = ClientProvider::get_nom_prenom_client(1); // np pour nom prenom
        echo "recuperation d'un client" . "<br>";
        echo"id : " . $npClient->get_id() . "<br>";
        echo"nom : " . $npClient->get_nom() . "<br>";
        echo"prenom : " . $npClient->get_prenom() . "<br>";
        echo "<br>";

        // Test ajout d'un client
        $adresse = new Adresse(24, "10 rue des ", "flavin", "looool");
        $client = new Client(null, "Ramon", "Lilou", null, "0758798536", "0658682513", $adresse, null, null);
        ClientProvider::ajout_client($client);
    }

}
