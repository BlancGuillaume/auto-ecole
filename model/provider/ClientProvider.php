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
    
    /**
     * Récupère la liste de tous les clients
     * @return type les clients de l'auto-école
     */
    public function get_clients() {

        $conn = include_once('model/ConnectionManager.php');

        // Récupération de tous les élèves de l'auto-ecole
        $reqStructure = 'SELECT *'
                      . 'FROM ADRESSE a, CLIENT c'
                      . 'WHERE c.id_adresse_client = a.id_adresse';

        $req = oci_parse($conn, $reqStructure);

        // Execution de la requête
        oci_execute($req);
        
        // Traitement du résultat : construction des élèves
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
     * Ajoute un client à la bdd
     * @param $client - le client à ajouter à la bdd
     */
    function ajout_client(Client $client) {
        
        $req = "INSERT INTO CLIENT VALUES ('".$client->get_id()."', '"
                                            .$client->get_nom()."', '"
                                            .$client->get_prenom()."', '"
                                            .$client->get_telPortable()."', '"
                                            .$client->get_adresse()->get_idAdresse()."')"; 
        
        // TODO continuer
    }
}
