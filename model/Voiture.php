<?php

/**
 * Voiture de l'auto-ecole
 *
 * @author Guillaume Blanc
 */
class Voiture {
    
    /** L'identifiant de la voiture */
    private $_id;
    
    /** Plaque d'immatriculation de la voiture */
    private $_immatriculation;
    
    /** Date d'achat de la voiture */
    private $_dateAchat;
    
    /** Prix d'achat de la voiture : en euros */
    private $_prixAchat;
    
    /** Etat de la voiture. Fonctionne : true, sinon false */
    private $_etat;
    
    /** Marque de la voiture */
    private $_marque;
    
    /** Modele de la voiture */
    private $_modele;
    
    /** Nombre de kilomètres effectués par la voiture */
    private $_kilometrage;
    
    /** Moniteur responsable */
    private $_responsable;
    
    /** Constructeur par paramètres */
    function __construct($id, $immatriculation, $dateAchat, 
            $prixAchat, $etat, $marque, $modele, $kilometrage, $responsable) {
        $this->_id = $id;
        $this->_immatriculation = $immatriculation;
        $this->_dateAchat = $dateAchat;
        $this->_prixAchat = $prixAchat;
        $this->_etat = $etat;
        $this->_marque = $marque;
        $this->_modele = $modele;
        $this->_kilometrage = $kilometrage;
        $this->_responsable = $responsable;
    }
    
    public function get_id() {
        return $this->_idVoiture;
    }

    function get_immatriculation() {
        return $this->_immatriculation;
    }

    function get_dateAchat() {
        return $this->_dateAchat;
    }

    function get_prixAchat() {
        return $this->_prixAchat;
    }

    function get_etat() {
        return $this->_etat;
    }

    function get_marque() {
        return $this->_marque;
    }

    function get_modele() {
        return $this->_modele;
    }

    function get_kilometrage() {
        return $this->_kilometrage;
    }

    function get_responsable() {
        return $this->_responsable;
    }

    function set_idVoiture($_idVoiture) {
        $this->_idVoiture = $_idVoiture;
    }

    function set_immatriculation($_immatriculation) {
        $this->_immatriculation = $_immatriculation;
    }

    function set_dateAchat($_dateAchat) {
        $this->_dateAchat = $_dateAchat;
    }

    function set_prixAchat($_prixAchat) {
        $this->_prixAchat = $_prixAchat;
    }

    function set_etat($_etat) {
        $this->_etat = $_etat;
    }

    function set_marque($_marque) {
        $this->_marque = $_marque;
    }

    function set_modele($_modele) {
        $this->_modele = $_modele;
    }

    function set_kilometrage($_kilometrage) {
        $this->_kilometrage = $_kilometrage;
    }

    function set_responsable($_responsable) {
        $this->_responsable = $_responsable;
    }


    
}
