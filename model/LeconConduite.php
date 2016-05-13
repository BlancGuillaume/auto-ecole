<?php

/**
 * Une leçon de conduite est effectuée par un élève
 * en présence d'un moniteur dans une voiture
 *
 * @author Guillaume Blanc
 */
class LeconConduite {
    
    /** identifiant de la leçon de conduite */
    private $_id;
    
    /** l'élève qui effectue la leçon de conduite */
    private $_eleve;
    
    /** le salarié qui encadre la leçon de conduite */
    private $_salarie;
    
    /** la voiture utilisée pour la leçon de conduite */
    private $_voiture;
    
    /** La date de la lecon de conduite */
    private $_date; 
    
    
    /** Constructeur par parametres */
    function __construct($id, $eleve, $salarie, $voiture, $date) {
        $this->_id = $id;
        $this->_eleve = $eleve;
        $this->_salarie = $salarie;
        $this->_voiture = $voiture;
        $this->_date = $date;
    }
    
    function getDate() {
        return $this->_date;
    }

    function setDate($date) {
        $this->_date = $date;
    }

    function get_id() {
        return $this->_id;
    }

    function get_eleve() {
        return $this->_eleve;
    }

    function get_salarie() {
        return $this->_salarie;
    }

    function get_voiture() {
        return $this->_voiture;
    }

    function set_id($_id) {
        $this->_id = $_id;
    }

    function set_eleve($_eleve) {
        $this->_eleve = $_eleve;
    }

    function set_salarie($_salarie) {
        $this->_salarie = $_salarie;
    }

    function set_voiture($_voiture) {
        $this->_voiture = $_voiture;
    }


}
