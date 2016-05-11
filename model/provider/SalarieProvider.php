<?php
 
/**
 * Requetes liées aux salariés de l'auto-école
 * @author blanc
 */

include_once('C:\wamp\www\auto-ecole\model\Salarie.php');
include_once('AdresseProvider.php');

/**
 * Décommenter pour tester les requetes
 */
// SalarieProvider::testMethodes();
   
class SalarieProvider {
    
    /**
     * Récupère les informations du moniteur spécifié par son id
     * @param $id - l'identifiant du moniteur
     */
    public static function get_nom_prenom_surnom_moniteur($id) {
        
        // Connection à la bdd
        include_once('ConnectionManager.php');
        $connectionManager = new ConnectionManager();
        $conn = $connectionManager->connect();

        // Récupération du moniteur correspondant à l'identifiant
        $req = oci_parse($conn, 'SELECT id_salarie, prenom_salarie, nom_salarie, surnom_salarie '
                              . 'FROM SALARIE WHERE id_salarie = '.$id);
        
        // Execution de la requête
        oci_execute($req);

        // Traitement du résultat : construction du moniteur 
        while (($salarie = oci_fetch_array($req, OCI_BOTH)) != false) {
            // Une seule occurence
                $moniteur = new Salarie($salarie['ID_SALARIE'],
                                        $salarie['PRENOM_SALARIE'],
                                        $salarie['NOM_SALARIE'],
                                        NULL, NULL, NULL, NULL,
                                        $salarie['SURNOM_SALARIE'],
                                        NULL, NULL, NULL, NULL);
        }
        
        return $moniteur;
    }
    
    /**
     * Récupère tous les salariés de l'auto-école
     */
    public static function get_salaries() {
        
        // Connection à la bdd
        include_once('ConnectionManager.php');
        $connectionManager = new ConnectionManager();
        $conn = $connectionManager->connect();

        // Récupération des salariés
        $req = oci_parse($conn, 'SELECT * FROM SALARIE');
        
        // Execution de la requête
        oci_execute($req);
   
        // Traitement du résultat : construction des salariés
        $salaries = array(); // tableau de formules 
        while (($salarie = oci_fetch_array($req, OCI_BOTH)) != false) {
            
            array_push($salaries, new Salarie($salarie['ID_SALARIE'],
                        $salarie['PRENOM_SALARIE'],
                        $salarie['NOM_SALARIE'],
                        NULL, NULL, $salarie['NUM_SALARIE'], 
                        AdresseProvider::get_adresse($salarie['ID_ADRESSE_SALARIE']),
                        $salarie['SURNOM_SALARIE'],
                        $salarie['DATE_RECRUTEMENT'],
                        $salarie['CATEGORIE_SALARIE'],
                        $salarie['ID_VOITURE_SALARIE'],
                        NULL));     
        }
        
        return $salaries;
      
    }
    
    /**
     * Récupère les informations d'un salarié
     * @param type $idSalarie - le salarié a récuperer
     * @return le salarié
     */
    public static function get_salarie($idSalarie) {
        
        // Connection à la bdd
        include_once('ConnectionManager.php');
        $connectionManager = new ConnectionManager();
        $conn = $connectionManager->connect();

        // Récupération du salarié correspondant à l'identifiant
        $req = oci_parse($conn, 'SELECT * FROM SALARIE WHERE id_salarie = '.$idSalarie);
        
        // Execution de la requête
        oci_execute($req);
        
        // Traitement du résultat : construction du salarié 
        while (($resultat = oci_fetch_array($req, OCI_BOTH)) != false) {
            // Une seule occurence
                $salarie = new Salarie($resultat['ID_SALARIE'],
                        $resultat['PRENOM_SALARIE'],
                        $resultat['NOM_SALARIE'],
                        NULL, NULL, $resultat['NUM_SALARIE'], 
                        AdresseProvider::get_adresse($resultat['ID_ADRESSE_SALARIE']),
                        $resultat['SURNOM_SALARIE'],
                        $resultat['DATE_RECRUTEMENT'],
                        $resultat['CATEGORIE_SALARIE'],
                        $resultat['ID_VOITURE_SALARIE'],
                        NULL);       
        }
        
        return $salarie;
    }

    /** 
     * Ajoute un salarié à la bdd
     * @param $salarie - la salarié à ajouter
     */
    public static function ajout_salarie(Salarie $salarie) {
         
        // Connection à la bdd
        include_once('ConnectionManager.php');
        $connectionManager = new ConnectionManager();
        $conn = $connectionManager->connect();
        
        $req = "INSERT INTO SALARIE VALUES ('".$salarie->get_id()."', '"
                                            .$salarie->get_nom()."', '"
                                            .$salarie->get_prenom()."', '"
                                            .$salarie->get_telPortable()."', '"
                                            .$salarie->get_categorie()."', '"
                                            .$salarie->get_surnom()."', '"
                                            .$salarie->get_dateRecrutement()."', '"
                                            .$salarie->get_adresse()->get_id()."', '"
                                            .$salarie->get_voiture()->get_id()."')"; 
        
        // TODO continuer
    }


    /**
     * Test des méthodes ci dessus
     */
    public static function testMethodes() {
        // nps => nom, prenom, surnom 
        $npsMoniteur = SalarieProvider::get_nom_prenom_surnom_moniteur(1);
        echo "recuperation du nps du salarie 1" . "<br>";
        echo "id : " . $npsMoniteur->get_id() . "<br>";
        echo "nom : " . $npsMoniteur->get_nom() . "<br>";
        echo "prenom : " . $npsMoniteur->get_prenom() . "<br>";
        echo "surnom : " . $npsMoniteur->get_surnom() . "<br>";
        echo "<br>";

        // Récupération d'un salarié    
        $moniteur = SalarieProvider::get_salarie(1);
        echo "recuperation du salarie 1" . "<br>";
        echo "id : " . $moniteur->get_id() . "<br>";
        echo "nom : " . $moniteur->get_nom() . "<br>";
        echo "prenom : " . $moniteur->get_prenom() . "<br>";
        echo "num : " . $moniteur->get_telPortable() . "<br>";
        echo "date recrutement : " . $moniteur->get_dateRecrutement() . "<br>";
        echo "categorie : " . $moniteur->get_categorie() . "<br>";
        echo "surnom : " . $moniteur->get_surnom() . "<br>";
        echo "adresse rue : " . $moniteur->get_adresse()->get_rue() . "<br>"; // Adresse OK !!
        echo "<br>";

        // récupération de tous les salariés
        $salaries = SalarieProvider::get_salaries();
        echo "recuperation des salariés <br>";
        foreach ($salaries as $moniteur) {
            // Récupération de toutes les salariés
            echo "id : " . $moniteur->get_id() . "<br>";
            echo "nom : " . $moniteur->get_nom() . "<br>";
            echo "prenom : " . $moniteur->get_prenom() . "<br>";
            echo "num : " . $moniteur->get_telPortable() . "<br>";
            echo "date recrutement : " . $moniteur->get_dateRecrutement() . "<br>";
            echo "categorie : " . $moniteur->get_categorie() . "<br>";
            echo "surnom : " . $moniteur->get_surnom() . "<br>";
            echo "adresse rue : " . $moniteur->get_adresse()->get_rue() . "<br>"; // Adresse OK !!
            echo "<br>";
        }
    }

}