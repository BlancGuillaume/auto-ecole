<?php

/**
 * Provider de la table client
 * @author Guillaume Blanc
 */

include_once('../Client.php');
include_once('../Formule.php');
include_once('../Adresse.php');
include_once('AdresseProvider.php');
include_once('EleveProvider.php');


/**
 * Décommenter pour tester les requetes
 */
//ClientProvider::testMethodes();


$clients = ClientProvider::get_clients();

foreach ($clients as $client) {
    // Récupération de toutes les formules
    echo "recuperation du client : " . "<br>";
    echo "id : ".$client->get_id(). "<br>";
    echo "nom :".$client->get_nom(). "<br>";
    echo "prenom : ".$client->get_prenom(). "<br>";
    echo "tel : ".$client->get_telDomicile(). "<br>";
    echo "portable : ".$client->get_telPortable(). "<br>";
   
    echo "recuperation de la rue du lient : " . "<br>";
    echo "id : " . $client->get_adresse()->get_id() . "<br>";
    echo "rue : " . $client->get_adresse()->get_rue() . "<br>";
    echo "ville : " . $client->get_adresse()->get_ville() . "<br>";
    echo "code postal : " . $client->get_adresse()->get_codePostal() . "<br>";
    
    // Récupération des élèves d'un client
    echo "recuperation des eleves du client : " . "<br>";
    foreach ($client->get_listeEleves() as $eleveClient) {
        echo "id : " . $eleveClient->get_id() . "<br>";
        echo "nom : " . $eleveClient->get_nom() . "<br>";
        echo "prenom :" . $eleveClient->get_prenom() . "<br>";
        echo "<br>";
    }
    
    // Récupération des achats dun client
     echo "Recuperation de touts les achats<br>";
    foreach ($client->get_listeAchats() as $achat) {
        // Récupération de toutes les achats
        echo "id : " . $achat->get_id() . "<br>";
        echo "nbre lecons : " . $achat->get_nbreLecons() . "<br>";
        echo "montant : " . $achat->get_montant() . "<br>";
        echo "date achat : " . $achat->get_dateAchat() . "<br>";
        echo "id eleve : " . $achat->getEleveBeneficiaire()->get_id() . "<br>";
        echo "prenom eleve : " . $achat->getEleveBeneficiaire()->get_prenom() . "<br>";
        echo "nom eleve : " . $achat->getEleveBeneficiaire()->get_nom() . "<br>";
        echo "<br>";
    }
    
    echo "<br>";echo "<br>";echo "<br>-----------------------------";
    
} 

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
        while (($resultat = oci_fetch_array($req, OCI_RETURN_NULLS)) != false) {
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
        $clients = array(); // tableau de clients 
        while (($client = oci_fetch_array($req, OCI_RETURN_NULLS)) != false) {
            
            array_push($clients, new Client($client['ID_CLIENT'],
                                        $client['PRENOM_CLIENT'],
                                        $client['NOM_CLIENT'], 
                                        null, // naissance ? 
                                        $client['NUM_DOMICILE_CLIENT'],
                                        $client['NUM_TRAVAIL_CLIENT'],
                                        AdresseProvider::get_adresse($client['ID_ADRESSE_CLIENT']),
                                        EleveProvider::get_eleves_dun_client($client['ID_CLIENT']),
                                        AchatProvider::get_achats_dun_client($client['ID_CLIENT'])));
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
