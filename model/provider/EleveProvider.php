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
    
    /**
     * Récupères les élèves d'un client
     * @param type $idClient - l'identifiant du client
     * @return la liste des élèves du client
     */
    public function get_eleves_dun_client($idClient) {
        
        $conn = include_once('model/ConnectionManager.php');

        // Récupération des élèves du client
        $req = oci_parse($conn, 'SELECT id_eleve, nom_eleve, prenom_eleve'
                              . 'FROM ELEVE WHERE id_client_eleve = '. $idClient);

        // Execution de la requête
        oci_execute($req);
        
         // Traitement du résultat : construction des élèves
        while ($resultat = oci_fetch_array($req)) {
            foreach ($resultat as $eleve) {
                              
                $eleves[] = new Eleve($eleve['id_eleve'],
                                      $eleve['prenom_eleve'],
                                      $eleve['nom_eleve'],
                                      NULL, NULL, NULL, NULL,
                                      NULL, NULL, NULL, NULL,
                                      NULL, NULL, NULL, NULL);
            }
        }
        
        return $eleves;  
    }
    
 /*
    CREATE TABLE ELEVE (
	id_eleve INTEGER NOT NULL, 
	nom_eleve VARCHAR(50), 
	prenom_eleve VARCHAR(50), 
	date_inscription_eleve VARCHAR(10), 
	naissance_eleve VARCHAR(10), 
	resultat_conduite_eleve BOOLEAN, 
	resultat_code_eleve BOOLEAN, 
	id_adresse_eleve INTEGER,
	id_client_eleve INTEGER, 
	id_formule_eleve INTEGER, 
	id_salarie_eleve INTEGER, 
	PRIMARY KEY (id_eleve),
	FOREIGN KEY (id_adresse_eleve) REFERENCES ADRESSE(id_adresse),
	FOREIGN KEY (id_client_eleve) REFERENCES CLIENT(id_client),
	FOREIGN KEY (id_formule_eleve) REFERENCES FORMULE(id_formule),
	FOREIGN KEY (id_salarie_eleve) REFERENCES SALARIE(id_salarie),
); */
    
    /** 
     * Ajoute un élève à la bdd
     * @param $eleve - l'élève à ajouter à la bdd
     */
    function ajout_eleve(Eleve $eleve) {
        
        $req = "INSERT INTO ELEVE VALUES ('".$eleve->get_id()."', '"
                                            .$eleve->get_nom()."', '"
                                            .$eleve->get_prenom()."', '"
                                            .date("Y-m-d H:i:s")."', '"
                                            .$eleve->get_dateNaissance()."', '"
                                            .false."', '"
                                            .false."', '"
                                            .$eleve->get_adresse()->get_id()."', '"
                                            .$eleve->get_client()->get_id()."', '"
                                            .$eleve->get_formule()->get_id()."', '"
                                            .$eleve->get_salarie()->get_id()."')"; 
        
        // TODO continuer
    }
}