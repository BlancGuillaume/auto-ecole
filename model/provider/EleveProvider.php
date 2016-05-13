<?php

/**
 * Requete permettant de récupérer touts les élèves
 * => Création des objets élèves
 * 
 * @author Guillaume Blanc
 */

include_once('C:\wamp\www\auto-ecole\model\Eleve.php');
include_once('C:\wamp\www\auto-ecole\model\provider\AdresseProvider.php');
include_once('C:\wamp\www\auto-ecole\model\provider\SalarieProvider.php');
include_once('C:\wamp\www\auto-ecole\model\provider\LeconConduiteProvider.php');
include_once('C:\wamp\www\auto-ecole\model\provider\ClientProvider.php');

/**
 * Décommenter pour tester les requetes
 */
//EleveProvider::testMethodes();

class EleveProvider {
    
    /**
     * Récupère la liste des élèves de l'auto-école
     * @return \Eleve - la liste des élèves
     */
    public static function get_eleves() {
        
        // Connection à la bdd
        include_once('ConnectionManager.php');
        $connectionManager = new ConnectionManager();
        $conn = $connectionManager->connect();

        // Récupération de tous les élèves de l'auto-ecole
        $reqStructure = 'SELECT * '
                      . 'FROM ELEVE e, ADRESSE a, CLIENT c, SALARIE s, FORMULE f '
                      . 'WHERE e.id_adresse_eleve = a.id_adresse '
                      . 'AND e.id_client_eleve = c.id_client '
                      . 'AND e.id_formule_eleve = f.id_formule '
                      . 'AND e.id_salarie_eleve = s.id_salarie ';
                     
        $req = oci_parse($conn, $reqStructure);
        
        // Execution de la requête
        oci_execute($req);
        
         // Traitement du résultat : construction des élèves
        $eleves = array(); // tableau de formules 
        while (($eleve = oci_fetch_array($req, OCI_RETURN_NULLS)) != false) {
            
            array_push($eleves,   new Eleve($eleve['ID_ELEVE'],
                                      $eleve['PRENOM_ELEVE'],
                                      $eleve['NOM_ELEVE'],
                                      $eleve['NAISSANCE_ELEVE'],
                                      $eleve['NUM_DOMICILE_ELEVE'],
                                      $eleve['NUM_TRAVAIL_ELEVE'],
                                      AdresseProvider::get_adresse($eleve['ID_ADRESSE_ELEVE']),
                                      SalarieProvider::get_nom_prenom_surnom_moniteur($eleve['ID_SALARIE_ELEVE']),
                                      LeconConduiteProvider::get_nombre_lecons_disponibles($eleve['ID_ELEVE'], $eleve['ID_FORMULE_ELEVE']),
                                      LeconConduiteProvider::get_nombre_lecons_effectuees($eleve['ID_ELEVE']),
                                      ClientProvider::get_nom_prenom_client($eleve['ID_CLIENT_ELEVE']),        
                                      FormuleProvider::get_formule($eleve['ID_FORMULE_ELEVE']),
                                      $eleve['RESULTAT_CONDUITE_ELEVE'],
                                      $eleve['RESULTAT_CODE_ELEVE'],
                                      $eleve['DATE_INSCRIPTION_ELEVE']));
        }
        
        return $eleves;
    }
    
    /**
     * Récupère les informations d'un élève
     * @param $idEleve - l'identifiant de l'élève
     * @return l'élève
     */
    public static function get_eleve($idEleve) {
        
        // Connection à la bdd
        include_once('ConnectionManager.php');
        $connectionManager = new ConnectionManager();
        $conn = $connectionManager->connect();

        // Récupération des informations de l'élève
        $reqStructure = 'SELECT * '
                      . 'FROM ELEVE e, ADRESSE a, CLIENT c, SALARIE s, FORMULE f '
                      . 'WHERE e.id_adresse_eleve  = a.id_adresse '
                      . 'AND e.id_client_eleve = c.id_client '
                      . 'AND e.id_formule_eleve = f.id_formule '
                      . 'AND e.id_salarie_eleve = s.id_salarie '
                      . 'AND e.id_eleve = '.$idEleve;
                     
        $req = oci_parse($conn, $reqStructure);
        
        // Execution de la requête
        oci_execute($req);
        
        // Traitement du résultat : construction de l'élève
        while (($resultat = oci_fetch_array($req, OCI_RETURN_NULLS)) != false) {
            // une seule occruence
            $eleve  = new Eleve($resultat['ID_ELEVE'],
                                      $resultat['PRENOM_ELEVE'],
                                      $resultat['NOM_ELEVE'],
                                      $resultat['NAISSANCE_ELEVE'],
                                      $resultat['NUM_DOMICILE_ELEVE'],
                                      $resultat['NUM_TRAVAIL_ELEVE'],
                                      AdresseProvider::get_adresse($resultat['ID_ADRESSE_ELEVE']),
                                      SalarieProvider::get_nom_prenom_surnom_moniteur($resultat['ID_SALARIE_ELEVE']),
                                      LeconConduiteProvider::get_nombre_lecons_disponibles($resultat['ID_ELEVE'], $resultat['ID_FORMULE_ELEVE']),
                                      LeconConduiteProvider::get_nombre_lecons_effectuees($resultat['ID_ELEVE']),
                                      ClientProvider::get_nom_prenom_client($resultat['ID_CLIENT_ELEVE']),        
                                      FormuleProvider::get_formule($resultat['ID_FORMULE_ELEVE']),
                                      $resultat['RESULTAT_CONDUITE_ELEVE'],
                                      $resultat['RESULTAT_CODE_ELEVE'],
                                      $resultat['DATE_INSCRIPTION_ELEVE']);
        }
        
        return $eleve;
    }
    
    /**
     * Récupères les élèves d'un client
     * @param type $idClient - l'identifiant du client
     * @return la liste des élèves du client
     */
    public static function get_eleves_dun_client($idClient) {
        
        // Connection à la bdd
        include_once('ConnectionManager.php');
        $connectionManager = new ConnectionManager();
        $conn = $connectionManager->connect();

        // Récupération des élèves du client
        $req = oci_parse($conn, 'SELECT id_eleve, nom_eleve, prenom_eleve '
                              . 'FROM ELEVE WHERE id_client_eleve = '. $idClient);

        // Execution de la requête
        oci_execute($req);
                
        // Traitement du résultat : construction des élèves
        $eleves = array(); // tableau de formules 
        while (($eleve = oci_fetch_array($req, OCI_RETURN_NULLS)) != false) {
            
            array_push($eleves,   new Eleve($eleve['ID_ELEVE'],
                                      $eleve['PRENOM_ELEVE'],
                                      $eleve['NOM_ELEVE'],
                                      NULL, NULL, NULL, NULL,
                                      NULL, NULL, NULL, NULL,
                                      NULL, NULL, NULL, NULL));
        }
        
        return $eleves;
    }
           
    /** 
     * Ajoute un élève à la bdd
     * @param $eleve - l'élève à ajouter à la bdd
     */
    public static function ajout_eleve(Eleve $eleve) {
        
        // Connection à la bdd
        include_once('ConnectionManager.php');
        $connectionManager = new ConnectionManager();
        $conn = $connectionManager->connect();
        
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
    
    /**
     * Test des méthodes ci dessus
     */
    public static function testMethodes() {
        
        /* Récupération de tous les élèves */
        $eleves = EleveProvider::get_eleves();
        foreach ($eleves as $eleve) {

            // Récupération de toutes les formules
            echo "informations de l eleve" . "<br>";
            echo "id : " . $eleve->get_id() . "<br>";
            echo "nom : " . $eleve->get_nom() . "<br>";
            echo "prenom :" . $eleve->get_prenom() . "<br>";
            echo "date naissance : " . $eleve->get_dateNaissance() . "<br>";

            echo "date inscription : " . $eleve->getDateInscription() . "<br>";
            echo "tel domicile : " . $eleve->get_telDomicile() . "<br>";
            echo "tel portable : " . $eleve->get_telPortable() . "<br>";
            echo "examen code : " . $eleve->get_examenCode() . "<br>";
            echo "examen permis : " . $eleve->get_examenPermis() . "<br>";

            // Récupération de l'adresse de l'élève
            $eleve->get_adresse();
            echo "recuperation de l'adresse de l eleve" . "<br>";
            echo "id : " . $eleve->get_adresse()->get_id() . "<br>";
            echo "rue : " . $eleve->get_adresse()->get_rue() . "<br>";
            echo "ville : " . $eleve->get_adresse()->get_ville() . "<br>";
            echo "code postal : " . $eleve->get_adresse()->get_codePostal() . "<br>";

            // Formule de l'élève
            echo "recuperation de la formule de l eleve" . "<br>";
            echo "id :" . $eleve->get_formule()->get_id() . "<br>";
            echo "prix : " . $eleve->get_formule()->get_prix() . "<br>";
            echo "detail : " . $eleve->get_formule()->getDetail() . "<br>";
            echo "prix lecon : " . $eleve->get_formule()->getPrixLecon() . "<br>";
            echo "nombre tickets : " . $eleve->get_formule()->get_nombreTickets() . "<br>";
            echo "<br>";

            echo "nombre lecons effectuees : " . $eleve->get_nombreLeconsEffectuees();
            echo "nombre lecons disponibles : " . $eleve->get_nombreLeconsDisponibles();

            // Client de l'élève
            echo "recuperation du client de l eleve" . "<br>";
            echo"id : " . $eleve->get_client()->get_id() . "<br>";
            echo"nom : " . $eleve->get_client()->get_nom() . "<br>";
            echo"prenom : " . $eleve->get_client()->get_prenom() . "<br>";
            echo "<br>";

            // Moniteur de l'élève
            echo "recuperation du moniteur référent de l eleve" . "<br>";
            echo "id : " . $eleve->get_moniteur()->get_id() . "<br>";
            echo "nom : " . $eleve->get_moniteur()->get_nom() . "<br>";
            echo "prenom : " . $eleve->get_moniteur()->get_prenom() . "<br>";
            echo "surnom : " . $eleve->get_moniteur()->get_surnom() . "<br>";
            echo "<br>";

            echo "<br>";
            echo "<br>";
            echo "<br>";
            echo "<br>";
            echo "<br>";
        }


        /* Récupération d'un élève */
        $unEleve = EleveProvider::get_eleve(1);

        // Récupération de toutes les formules
        echo "informations de l eleve" . "<br>";
        echo "id : " . $unEleve->get_id() . "<br>";
        echo "nom : " . $unEleve->get_nom() . "<br>";
        echo "prenom :" . $unEleve->get_prenom() . "<br>";
        echo "date naissance : " . $unEleve->get_dateNaissance() . "<br>";

        echo "date inscription : " . $unEleve->getDateInscription() . "<br>";
        echo "tel domicile : " . $unEleve->get_telDomicile() . "<br>";
        echo "tel portable : " . $unEleve->get_telPortable() . "<br>";
        echo "examen code : " . $unEleve->get_examenCode() . "<br>";
        echo "examen permis : " . $unEleve->get_examenPermis() . "<br>";

        // Récupération de l'adresse de l'élève
        $eleve->get_adresse();
        echo "recuperation de l'adresse de l eleve" . "<br>";
        echo "id : " . $unEleve->get_adresse()->get_id() . "<br>";
        echo "rue : " . $unEleve->get_adresse()->get_rue() . "<br>";
        echo "ville : " . $unEleve->get_adresse()->get_ville() . "<br>";
        echo "code postal : " . $unEleve->get_adresse()->get_codePostal() . "<br>";

        // Formule de l'élève
        echo "recuperation de la formule de l eleve" . "<br>";
        echo "id :" . $unEleve->get_formule()->get_id() . "<br>";
        echo "prix : " . $unEleve->get_formule()->get_prix() . "<br>";
        echo "detail : " . $unEleve->get_formule()->getDetail() . "<br>";
        echo "prix lecon : " . $unEleve->get_formule()->getPrixLecon() . "<br>";
        echo "nombre tickets : " . $unEleve->get_formule()->get_nombreTickets() . "<br>";
        echo "<br>";

        echo "nombre lecons effectuees : " . $unEleve->get_nombreLeconsEffectuees();
        echo "nombre lecons disponibles : " . $unEleve->get_nombreLeconsDisponibles();

        // Client de l'élève
        echo "recuperation du client de l eleve" . "<br>";
        echo"id : " . $unEleve->get_client()->get_id() . "<br>";
        echo"nom : " . $unEleve->get_client()->get_nom() . "<br>";
        echo"prenom : " . $unEleve->get_client()->get_prenom() . "<br>";
        echo "<br>";

        // Moniteur de l'élève
        echo "recuperation du moniteur référent de l eleve" . "<br>";
        echo "id : " . $unEleve->get_moniteur()->get_id() . "<br>";
        echo "nom : " . $unEleve->get_moniteur()->get_nom() . "<br>";
        echo "prenom : " . $unEleve->get_moniteur()->get_prenom() . "<br>";
        echo "surnom : " . $unEleve->get_moniteur()->get_surnom() . "<br>";
        echo "<br>";
        
        
        // Récupération des élèves d'un client
        echo "recuperation des eleves d'un client" . "<br>";
        $elevesClient = EleveProvider::get_eleves_dun_client(1);
        foreach ($elevesClient as $eleveClient) {
            echo "id : " . $eleveClient->get_id() . "<br>";
            echo "nom : " . $eleveClient->get_nom() . "<br>";
            echo "prenom :" . $eleveClient->get_prenom() . "<br>";
            echo "<br>";
        }
    }
}
