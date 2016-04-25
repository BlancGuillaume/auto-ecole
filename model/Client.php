<?php

/**
 * Description of Client
 *
 * @author blanc
 */
class Client extends Individu {
    
    /** Liste d'élève associés au client */
    private $_listeEleves;
    
    /** Liste d'achats effectués par le client */
    private $_listeAchats;
    
     /** Constructeur par défaut */
     function __construct() {
        parent::construct();
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
