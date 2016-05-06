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
    public function get_voitures() {

        $conn = include_once('model/ConnectionManager.php');

        // Récupération de toutes les voitures
        $req = oci_parse($conn, 'SELECT * FROM VOITURE');
        // Execution de la requête
        oci_execute($req);

        // Traitement du résultat : construction des voitures
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
                                          SalarieProvider::get_nom_prenom_surnom_moniteur($voiture['id_salarie_voiture']));
            }
        }
        
        return $voitures;
    }
    
    /**
     * Récupère les informations d'une voiture
     * @param idVoiture - l'identifiant de la voiture à récupérer
     * @return La voiture
     */
    public function get_voiture($idVoiture) {
        
        $conn = include_once('model/ConnectionManager.php');

        // Récupération de la voiture 
        $req = oci_parse($conn, 'SELECT * FROM VOITURE WHERE id_voiture = '.$idVoiture);
        
        // Execution de la requête
        oci_execute($req);

        // Traitement du résultat : construction de la voiture
        while ($resultats = oci_fetch_array($req)) {
            foreach ($resultats as $resultat) {
                $voiture = new Voiture($resultat['id_voiture'], 
                                          $resultat['immatriculation_voiture'], 
                                          $resultat['date_achat_voiture'],
                                          $resultat['prix_voiture'],
                                          $resultat['etat_voiture'],
                                          $resultat['marque_voiture'],
                                          $resultat['modele_voiture'],
                                          $resultat['kilometrage_voiture'],
                                          SalarieProvider::get_nom_prenom_surnom_moniteur($resultat['id_salarie_voiture']));
            }
        }
        
        return $voiture;
    } 
    
    
    /**
     * Ajoute une voiture dans la bdd
     * @param Voiture $voiture - la voiture a ajouter
     */
    public function ajout_voiture(Voiture $voiture) {
      
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
