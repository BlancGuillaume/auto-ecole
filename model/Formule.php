<?php

/**
 * Les formules proposés par l'auto école
 *
 * @author Guillaume Blanc
 */
class Formule {
   
    /** L'identifiant de la formule */
    private $_id;
    
    /** Le prix de la formule */
    private $_prix;
    
    /** Le nombre de tickets de la formule */
    private $_nombreTickets;
    
    /** Constructeur par paramètres */
    public function __construct($id, $prix, $nombreTickets) {
        $this->_id = $id;
        $this->_prix = $prix;
        $this->_nombreTickets = $nombreTickets;
    }
    
    function get_id() {
        return $this->_id;
    }

    function get_prix() {
        return $this->_prix;
    }

    function get_nombreTickets() {
        return $this->_nombreTickets;
    }

    function set_id($_id) {
        $this->_id = $_id;
    }

    function set_prix($_prix) {
        $this->_prix = $_prix;
    }

    function set_nombreTickets($_nombreTickets) {
        $this->_nombreTickets = $_nombreTickets;
    }
}
