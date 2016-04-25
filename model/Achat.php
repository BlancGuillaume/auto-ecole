<?php

/**
 * Achat effectué par un client pour un élève
 * L'achat corrspond a un nombre d'heures achetées
 * @author Guillaume Blanc
 */
class Achat {
   
    /** Identifiant de l'achat */
    private $_id;
    
    /** Nombre de leçons (d'heures) achetées */
    private $_nbreLecons;
    
    /** Montant de l'achat */
    private $_montant;
    
    /** Date de l'achat */
    private $_dateAchat;
    
    /** L'élève qui bénéficie de l'achat */
    private $_eleveBeneficiaire;
    
     /** Constructeur par défaut */
     function __construct() {
        parent::construct();
    }
    
    function get_id() {
        return $this->_id;
    }

    function get_nbreLecons() {
        return $this->_nbreLecons;
    }

    function get_montant() {
        return $this->_montant;
    }

    function set_id($_id) {
        $this->_id = $_id;
    }

    function set_nbreLecons($_nbreLecons) {
        $this->_nbreLecons = $_nbreLecons;
    }

    function set_montant($_montant) {
        $this->_montant = $_montant;
    }

    function get_dateAchat() {
        return $this->_dateAchat;
    }

    function set_dateAchat($_dateAchat) {
        $this->_dateAchat = $_dateAchat;
    }
}
