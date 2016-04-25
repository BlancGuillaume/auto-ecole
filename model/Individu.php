<?php

/**
 * Informations qui permettent de caractériser un individu
 * Un individu peut être un élève, un client ou bien un salarié 
 *
 * @author Guillaume Blanc
 */
abstract class Individu {
    
    /** identifiant de l'individu */
    private $_id;
    
    /** Prénom de l'individu */
    private $_prenom; 
    
    /** Nom de l'individu */
    private $_nom;
    
    /** Date de naissance de l'individu */
    private $_dateNaissance;
    
    /** Le numéro de telephone de domicile de l'individu */
    private $_telDomicile;
    
    /** Le numéro de telephone portable de l'individu */
    private $_telPortable;
    
    /** Adresse de la personne */
    private $_adresse;
    
    function __construct($_id, $_prenom, $_nom, $_dateNaissance, $_telDomicile, $_telPortable, $_adresse) {
        $this->_id = $_id;
        $this->_prenom = $_prenom;
        $this->_nom = $_nom;
        $this->_dateNaissance = $_dateNaissance;
        $this->_telDomicile = $_telDomicile;
        $this->_telPortable = $_telPortable;
        $this->_adresse = $_adresse;
    }
    
    function get_id() {
        return $this->_id;
    }

    function get_prenom() {
        return $this->_prenom;
    }

    function get_nom() {
        return $this->_nom;
    }

    function get_dateNaissance() {
        return $this->_dateNaissance;
    }

    function get_telDomicile() {
        return $this->_telDomicile;
    }

    function get_telPortable() {
        return $this->_telPortable;
    }

    function get_adresse() {
        return $this->_adresse;
    }

    function set_prenom($_prenom) {
        $this->_prenom = $_prenom;
    }

    function set_nom($_nom) {
        $this->_nom = $_nom;
    }

    function set_dateNaissance($_dateNaissance) {
        $this->_dateNaissance = $_dateNaissance;
    }

    function set_telDomicile($_telDomicile) {
        $this->_telDomicile = $_telDomicile;
    }

    function set_telPortable($_telPortable) {
        $this->_telPortable = $_telPortable;
    }

    function set_adresse($_adresse) {
        $this->_adresse = $_adresse;
    }
}
