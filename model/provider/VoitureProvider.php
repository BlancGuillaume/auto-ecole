<?php

/**
 * Requete permettant de récupérer toutes les voitures
 * => Création des objets voitures
 * 
 * @author Guillaume Blanc
 */
include_once('../Voiture.php');
include_once('SalarieProvider.php');

/**
 * Décommenter pour tester les requetes
 */
// VoitureProvider::testMethodes();

class VoitureProvider {

    /**
     * Récupère la liste de toutes les voitures de l'auto-ecole
     * @return $voitures - la liste de toutes les voitures 
     */
    public static function get_voitures() {

        // Connection à la bdd
        include_once('ConnectionManager.php');
        $connectionManager = new ConnectionManager();
        $conn = $connectionManager->connect();

        // Récupération de toutes les voitures
        $req = oci_parse($conn, 'SELECT * FROM VOITURE');
        // Execution de la requête
        oci_execute($req);
    
        // Traitement du résultat : construction des voitures
        $voitures = array(); // tableau de voitures 
        while (($voiture = oci_fetch_array($req, OCI_BOTH)) != false) {
            
            array_push($voitures,   new Voiture($voiture['ID_VOITURE'], 
                                          $voiture['IMMATRICULATION_VOITURE'], 
                                          $voiture['DATE_ACHAT_VOITURE'],
                                          $voiture['PRIX_VOITURE'],
                                          NULL, // etat voiture
                                          $voiture['MARQUE_VOITURE'],
                                          $voiture['MODELE_VOITURE'],
                                          $voiture['KILOMETRAGE_VOITURE'],
                                          SalarieProvider::get_nom_prenom_surnom_moniteur($voiture['ID_SALARIE_VOITURE'])));
        }
        
        return $voitures;
    }
    
    /**
     * Récupère les informations d'une voiture
     * @param idVoiture - l'identifiant de la voiture à récupérer
     * @return La voiture
     */
    public static function get_voiture($idVoiture) {
        
        // Connection à la bdd
        include_once('ConnectionManager.php');
        $connectionManager = new ConnectionManager();
        $conn = $connectionManager->connect();

        // Récupération de la voiture 
        $req = oci_parse($conn, 'SELECT * FROM VOITURE WHERE id_voiture = '.$idVoiture);
        
        // Execution de la requête
        oci_execute($req);
        
        // Traitement du résultat : construction de la voiture
        while (($resultat = oci_fetch_array($req, OCI_BOTH)) != false) {
            // une seule occruence
            $voiture = new Voiture($resultat['ID_VOITURE'], 
                                          $resultat['IMMATRICULATION_VOITURE'], 
                                          $resultat['DATE_ACHAT_VOITURE'],
                                          $resultat['PRIX_VOITURE'],
                                          NULL, // etat voiture
                                          $resultat['MARQUE_VOITURE'],
                                          $resultat['MODELE_VOITURE'],
                                          $resultat['KILOMETRAGE_VOITURE'],
                                          SalarieProvider::get_nom_prenom_surnom_moniteur($resultat['ID_SALARIE_VOITURE']));
        }
        
        return $voiture;
    } 
    
    
    /**
     * Ajoute une voiture dans la bdd
     * @param Voiture $voiture - la voiture a ajouter
     */
    public static function ajout_voiture(Voiture $voiture) {
      
        // Connection à la bdd
        include_once('ConnectionManager.php');
        $connectionManager = new ConnectionManager();
        $conn = $connectionManager->connect();
        
        $req = "INSERT INTO VOITURE VALUES ('".$voiture->get_id()."', '"
                                            .$voiture->get_prixAchat()."', '"
                                            .$voiture->get_kilometrage()."', '"
                                            .$voiture->get_dateAchat()."', '"
                                            .$voiture->get_marque()."', '"
                                            .$voiture->get_modele()."', '"
                                            .$voiture->get_responsable().get_id()."')";
        // TODO : continuer
    }
    
     /**
     * Test des méthodes ci dessus
     */
     public static function testMethodes() {
        $voiture = VoitureProvider::get_voiture(1);
        echo "récupération d'une voiture<br>";
        echo "id : " . $voiture->get_id() . "<br>";
        echo "immatriculation : " . $voiture->get_immatriculation() . "<br>";
        echo "date achat : " . $voiture->get_dateAchat() . "<br>";
        echo "prix achat : " . $voiture->get_prixAchat() . "<br>";
        echo "marque : " . $voiture->get_marque() . "<br>";
        echo "modele ; " . $voiture->get_modele() . "<br>";
        echo "kiloemtrage : " . $voiture->get_kilometrage() . "<br>";
        echo "reponsable id : " . $voiture->get_responsable()->get_id() . "<br>";
        echo "responsable nom : " . $voiture->get_responsable()->get_nom() . "<br>";
        echo "responsable prenom : " . $voiture->get_responsable()->get_prenom() . "<br>";

        $voitures = VoitureProvider::get_voitures();
        echo "récupération de toutes les voitures de l'auto ecole";
        foreach ($voitures as $voiture) {
            // Récupération de toutes les voitures
            echo "id : " . $voiture->get_id() . "<br>";
            echo "immatriculation : " . $voiture->get_immatriculation() . "<br>";
            echo "date achat : " . $voiture->get_dateAchat() . "<br>";
            echo "prix achat : " . $voiture->get_prixAchat() . "<br>";
            echo "marque : " . $voiture->get_marque() . "<br>";
            echo "modele ; " . $voiture->get_modele() . "<br>";
            echo "kiloemtrage : " . $voiture->get_kilometrage() . "<br>";
            echo "reponsable id : " . $voiture->get_responsable()->get_id() . "<br>";
            echo "responsable nom : " . $voiture->get_responsable()->get_nom() . "<br>";
            echo "responsable prenom : " . $voiture->get_responsable()->get_prenom() . "<br>";
            echo "<br>";
        }
    }

}
