<?php

/**
 * Un client inscrit un ou plusieurs élèves dans l'auto-ecole
 * Il peut s'inscrire lui même
 * 
 * @author Guillaume Blanc
 */

include_once('C:\wamp\www\auto-ecole\model\Individu.php');

class Client extends Individu {
    
    /** Liste d'élève associés au client */
    private $_listeEleves;
    
    /** Liste d'achats effectués par le client */
    private $_listeAchats;
    
    function __construct($id, $prenom, $nom, $dateNaissance, $telDomicile, 
            $telPortable, $adresse, $listeEleves, $listeAchats) {
        
        parent::__construct($id, $prenom, $nom, $dateNaissance, $telDomicile, 
                $telPortable, $adresse);

        $this->_listeEleves = $listeEleves;
        $this->_listeAchats = $listeAchats;
    }
    
    function get_listeEleves() {
        return $this->_listeEleves;
    }

    function get_listeAchats() {
        return $this->_listeAchats;
    }

    function set_listeEleves($_listeEleves) {
        $this->_listeEleves = $_listeEleves;
    }

    function set_listeAchats($_listeAchats) {
        $this->_listeAchats = $_listeAchats;
    }
}
