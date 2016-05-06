<?php
 
/**
 * Description of MoniteurProvider
 *
 * @author blanc
 */
class SalarieProvider {
    
    /**
     * Récupère les informations du moniteur spécifié par son id
     * @param $id - l'identifiant du moniteur
     */
    public function get_nom_prenom_surnom_moniteur($id) {
        
        $conn = include_once('model/ConnectionManager.php');

        // Récupération du moniteur correspondant à l'identifiant
        $req = oci_parse($conn, 'SELECT id_salarie, prenom_salarie, nom_salarie, surnom_salarie'
                              . 'FROM SALARIE WHERE id_salarie = '.$id);
        
        // Execution de la requête
        oci_execute($req);

        // Traitement du résultat : construction des formules
        while ($resultat = oci_fetch_array($req)) {
            foreach ($resultat as $salarie) {
                // Une seule occurence
                $moniteur = new Salarie($salarie['id_salarie'],
                                        $salarie['prenom_salarie'],
                                        $salarie['nom_salarie'],
                                        NULL, NULL, NULL, NULL,
                                        $salarie['surnom_salarie'],
                                        NULL, NULL, NULL, NULL);
            }
        }
        
        return $moniteur;
    }
    
    /**
     * Récupère tous les salariés de l'auto-école
     */
    function get_salaries() {
        
        $conn = include_once('model/ConnectionManager.php');

        // Récupération du moniteur correspondant à l'identifiant
        $req = oci_parse($conn, 'SELECT * FROM SALARIE');
        
        // Execution de la requête
        oci_execute($req);
        
        // Traitement du résultat : construction des formules
        while ($resultat = oci_fetch_array($req)) {
            foreach ($resultat as $salarie) {
                // Une seule occurence
                $salaries[] = new Salarie($salarie['id_salarie'],
                        $salarie['prenom_salarie'],
                        $salarie['nom_salarie'],
                        NULL, NULL, $salarie['num_salarie'], 
                        AdresseProvider::get_adresse($salarie['id_adresse_salarie']),
                        $salarie['surnom_salarie'],
                        $salarie['recrutement_salaire'],
                        $salarie['categorie_salarie'],
                        $salarie['id_voiture_salarie'],
                        NULL);       
            }
        }
        
        return $salaries;
    }
        
    /** 
     * Ajoute un salarié à la bdd
     * @param $salarie - la salarié à ajouter
     */
    function ajout_voiture(Salarie $salarie) {
         
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
}
