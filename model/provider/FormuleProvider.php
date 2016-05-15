<?php
include_once('C:\wamp\www\auto-ecole\model\Formule.php');
/*
 * Requete permettant de récupérer les formules
 * => Construction des objets Formule
 * @author Guillaume Blanc
 */

/**
 * Décommenter pour tester les requetes
 */
// FormuleProvider::testMethodes();

class FormuleProvider {

    /**
     * Récupère toutes les formules proposées par l'auto-école
     * @return \Formule - la liste de toutes les formules
     */
    public static function get_formules() {
        
        // Connection à la bdd
        include_once('ConnectionManager.php');
        $connectionManager = new ConnectionManager();
        $conn = $connectionManager->connect();
        
        $req = oci_parse($conn, 'SELECT * FROM FORMULE');
        
        // Execution de la requête
	oci_execute($req);

        // Traitement du résultat : construction des formules
        $formules = array(); // tableau de formules 
        while (($formule = oci_fetch_array($req, OCI_RETURN_NULLS)) != false) {
            
            array_push($formules,   new Formule($formule["ID_FORMULE"], 
                                                $formule["PRIX_FORMULE"], 
                                                $formule['NB_TICKETS_FORMULE'],
                                                $formule['PRIX_LECONS_FORMULE'],
                                                $formule['DETAILS_FORMULE']));
        }
        
        return $formules;
    }
    
    /**
     * Récupère la formule correspondant à l'id spécifié
     * @param type $id - l'id de la formule à récupérer
     */
    public static function get_formule($id) {
        
        // Connection à la bdd
        include_once('ConnectionManager.php');
        $connectionManager = new ConnectionManager();
        $conn = $connectionManager->connect();

        // Récupération de la forumule
        $req = oci_parse($conn, 'SELECT * FROM FORMULE WHERE id_formule = '. $id);

        // Execution de la requête
        oci_execute($req);

        // Traitement du résultat : construction de la formule
        while (($resultat = oci_fetch_array($req, OCI_RETURN_NULLS)) != false) {
            // une seule occruence
            $formule  = new Formule($resultat["ID_FORMULE"], 
                                    $resultat["PRIX_FORMULE"], 
                                    $resultat['NB_TICKETS_FORMULE'],
                                    $resultat['PRIX_LECONS_FORMULE'],
                                    $resultat['DETAILS_FORMULE']);
        }
        
        return $formule;
    }
    
    /**
     * Ajoute une formule à la base de donnée
     * @param type $formule - la formule a ajouter
     */
    public static function ajout_formule($formule) {
               // Connection à la bdd
        include_once('ConnectionManager.php');
        $connectionManager = new ConnectionManager();
        $conn = $connectionManager->connect();
        
        $req = "INSERT INTO FORMULE VALUES (formule_seq.nextVal, "
                                            .$formule->get_prix().", "
                                            .$formule->get_nombreTickets()." , "
                                            .$formule->getPrixLecon().", '"
                                            .$formule->getDetail()."')";        
    
        var_dump($req);
        
        // Execution de la requete
        $aExecuter = oci_parse($conn, $req);
        $resultat = oci_execute($aExecuter);
        var_dump($resultat);
    }
    
    /**
     * Test des méthodes ci dessus
     */
    public static function testMethodes() {

        // Ajout d'une formule
        $formuleAAjouter = new Formule(null, 1600, 69, 100, "cest pas fut ce que je dis");
        FormuleProvider::ajout_formule($formuleAAjouter);

        $formules = FormuleProvider::get_formules();

        foreach ($formules as $formule) {
            // Récupération de toutes les formules
            echo "id :" . $formule->get_id() . "<br>";
            echo "prix : " . $formule->get_prix() . "<br>";
            echo "detail : " . $formule->getDetail() . "<br>";
            echo "prix lecon : " . $formule->getPrixLecon() . "<br>";
            echo "nombre tickets : " . $formule->get_nombreTickets() . "<br>";
            echo "<br>";
        }

        $UneFomule = FormuleProvider::get_formule(21);
        echo "recuperation de la formule 21" . "<br>";
        echo "id :" . $UneFomule->get_id() . "<br>";
        echo "prix : " . $UneFomule->get_prix() . "<br>";
        echo "detail : " . $UneFomule->getDetail() . "<br>";
        echo "prix lecon : " . $UneFomule->getPrixLecon() . "<br>";
        echo "nombre tickets : " . $UneFomule->get_nombreTickets() . "<br>";
        echo "<br>";
    }

}
