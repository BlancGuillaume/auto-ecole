<?php

/**
 * Une adresse est formée :
 * - d'un identifiant
 * - d'une rue : 10 rue des bucherons
 * - d'une ville : Flavin
 * - d'un code postal : 12450
 *
 * @author Guillaume Blanc
 */
class Adresse {
    
    /** identifiant de l'adresse */
    private $_id;
    
    /** rue de l'adresse */
    private $_rue;
    
    /** ville de l'adresse */
    private $_ville;
    
    /** code postal */
    private $_codePostal;
    
    /** Constructeur par paramètres */
    function __construct($idAdresse, $rue, $ville, $codePostal) {
        $this->_id = $idAdresse;
        $this->_rue = $rue;
        $this->_ville = $ville;
        $this->_codePostal = $codePostal;
    }

    function get_id() {
        return $this->_id;
    }

    function get_rue() {
        return $this->_rue;
    }

    function get_ville() {
        return $this->_ville;
    }

    function get_codePostal() {
        return $this->_codePostal;
    }

    function set_idAdresse($_idAdresse) {
        $this->_idAdresse = $_idAdresse;
    }

    function set_rue($_rue) {
        $this->_rue = $_rue;
    }

    function set_ville($_ville) {
        $this->_ville = $_ville;
    }

    function set_codePostal($_codePostal) {
        $this->_codePostal = $_codePostal;
    }



}
