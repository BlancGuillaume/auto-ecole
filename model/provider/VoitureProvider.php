<?php

/**
 * Requete permettant de récupérer toutes les voitures
 * => Création des objets voitures
 * 
 * @author Guillaume Blanc
 */
include_once('model/Voiture.php');

class VoitureProvider {

    /**
     * Récupère la liste de toutes les voitures de l'auto-ecole
     * @return $voitures - la liste de toutes les voitures 
     */
    function get_voitures() {

        $conn = include_once('model/ConnectionManager.php');

        // Récupération de toutes les voitures
        $req = oci_parse($conn, 'SELECT * FROM VOITURE');
        // Execution de la requête
        oci_execute($req);

        // Traitement du résultat : construction des formules
        while ($resultat = oci_fetch_array($req)) {
            foreach ($resultat as $voiture) {
                $voitures[] = new Voiture($voiture['id_voiture'], 
                                          $voiture['immatriculation_voiture'], 
                                          $voiture['date_achat_voiture'],
                                          $voiture['prix_voiture'],
                                          $voiture['etat_voiture'],
                                          $voiture['marque_voiture'],
                                          $voiture['modele_voiture'],
                                          $voiture['kilometrage_voiture'],
                                          MoniteurProvider::get_nom_prenom_surnom_moniteur($voiture['id_salarie_voiture']));
            }
        }
        
        return $voitures;
    }
    
    
    /**
     * Ajoute une voiture dans la bdd
     * @param Voiture $voiture - la voiture a ajouter
     */
    function ajout_voiture(Voiture $voiture) {
      
        $req = "INSERT INTO VOITURE VALUES ('".$voiture->get_id()."', '"
                                            .$voiture->get_prixAchat()."', '"
                                            .$voiture->get_kilometrage()."', '"
                                            .$voiture->get_dateAchat()."', '"
                                            .$voiture->get_marque()."', '"
                                            .$voiture->get_modele()."', '"
                                            .$voiture->get_responsable().get_id()."')";
        // TODO : continuer
    }

}
