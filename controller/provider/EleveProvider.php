<?php

/**
 * Requete permettant de récupérer touts les élèves
 * => Création des objets élèves
 * 
 * @author Guillaume Blanc
 */
include_once('model/Voiture.php');

class EleveProvider {
    
    /**
     * Récupère la liste des élèves de l'auto-école
     * @return \Eleve - la liste des élèves
     */
    public function get_eleves() {
        
        $conn = include_once('model/ConnectionManager.php');

        // Récupération de tous les élèves de l'auto-ecole
        $reqStructure = 'SELECT *'
                      . 'FROM ELEVE e, ADRESSE a, CLIENT c, SALARIE s, FORMULE f'
                      . 'WHERE e.id_adresse_eleve  = a.id_adresse '
                      . 'AND e.id_client_eleve = c.id_client'
                      . 'AND e.id_formule_eleve = f.id_formule'
                      . 'AND e.id_salarie_eleve = s.id_eleve';
                     
        $req = oci_parse($conn, $reqStructure);
        
        // Execution de la requête
        oci_execute($req);

        // Traitement du résultat : construction des élèves
        while ($resultat = oci_fetch_array($req)) {
            foreach ($resultat as $eleve) {
                              
                $eleves[] = new Eleve($eleve['id_eleve'],
                                      $eleve['prenom_eleve'],
                                      $eleve['nom_eleve'],
                                      $eleve['naissance_eleve'],
                                      $eleve['tel_domicile_eleve'],
                                      $eleve['tel_portable_eleve'],
                                      AdresseProvider::get_adresse($eleve['id_adresse_eleve']),
                                      SalarieProvider::get_nom_prenom_surnom_moniteur($eleve['id_salarie_eleve']),
                                      LeconConduiteProvider::get_nombre_lecons_disponibles($eleve['id_eleve'], $eleve['id_formule_eleve']),
                                      LeconConduiteProvider::get_nombre_lecons_effectuees($eleve['id_eleve']),
                                      ClientProvider::get_nom_prenom_client($eleve['id_client_eleve']),        
                                      FormuleProvider::get_formule($eleve['id_formule_eleve']),
                                      $eleve['resultat_conduite_eleve'],
                                      $eleve['resultat_code_eleve'],
                                      $eleve['date_inscription_eleve']);
            }
        }
        
        return $eleves;
    }
}
