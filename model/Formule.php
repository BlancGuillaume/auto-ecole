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
    
    /** Le prix d'une lecon pour la formume */
    private $_prixLecon;
    
    /** detail explicatif de la formule */
    private $_detail;


    /** Constructeur par paramètres */
    public function __construct($id, $prix, $nombreTickets, $prixLecon, $detail) {
        $this->_id = $id;
        $this->_prix = $prix;
        $this->_nombreTickets = $nombreTickets;
        $this->_prixLecon = $prixLecon;
        $this->_detail = $detail;
    }
    
    public function get_id() {
        return $this->_id;
    }

    public function get_prix() {
        return $this->_prix;
    }

    public function get_nombreTickets() {
        return $this->_nombreTickets;
    }

    public function set_id($_id) {
        $this->_id = $_id;
    }

    public function set_prix($_prix) {
        $this->_prix = $_prix;
    }

    public function set_nombreTickets($_nombreTickets) {
        $this->_nombreTickets = $_nombreTickets;
    }
    
    public function getPrixLecon() {
        return $this->_prixLecon;
    }

    public function getDetail() {
        return $this->_detail;
    }

    public function setPrixLecon($prixLecon) {
        $this->_prixLecon = $prixLecon;
    }

    public function setDetail($detail) {
        $this->_detail = $detail;
    }


}
