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
        
        // Connection à la bdd
        include_once('ConnectionManager.php');
        $connectionManager = new ConnectionManager();
        $conn = $connectionManager->connect();

        // Récupération du nombres de lecons achetées 
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
    
    /**
     * Récupère les achats d'un client
     * @param type $idClient - le client qui a effectué des achats
     * @return les achats du client
     */
    public function get_achats_dun_client($idClient) {
        
        // Connection à la bdd
        include_once('ConnectionManager.php');
        $connectionManager = new ConnectionManager();
        $conn = $connectionManager->connect();

        // Récupération des achats d'un client
        $req = oci_parse($conn, 'SELECT * '
                              . 'FROM ACHAT, ELEVE '
                              . 'WHERE id_eleve_achat = id_eleve'
                              . 'AND id_client_achat = '. $idClient);

        // Execution de la requête
        oci_execute($req);
        
        // Traitement du résultat
        while ($resultats = oci_fetch_array($req)) {
            foreach ($resultats as $achat) {
                $achats[] = new Achat($achat['id_client_achat'].$achat['id_eleve_achat'],
                                      $achat['nb_tickets_achat'],
                                      $montant, // TODO
                                      $achat['date_achat'], 
                                      new Eleve($achat['id_eleve'], $achat['prenom_eleve'], $achat['nom_eleve'],
                                      NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL));  
            }
        }
        
        return $achats;
    }
}
