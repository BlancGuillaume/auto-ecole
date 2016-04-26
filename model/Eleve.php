<?php

/**
 * L'élève est l'individu qui va suivre les cours.
 * L'élève et le client peuvent être la même personne 
 * mais ce n'est pas necessairement le cas
 * Ex : un père (client) qui inscrit son enfant Guillaume (l'élève)
 * 
 * @author Guillaume Blanc
 */
class Eleve extends Individu {
    
    /** Le numéro du lieu de travail ou d'étude de l'élève */
    private $_telTravail;
    
    /** Le moniteur référent de l'élève */
    private $_moniteur;
   
    /** Le nombre de lecons dispos (1ticket = 1 heure) */
    private $_nombreLeconsDisponibles;
    
    /** Le nombre de leçons effectuées */
    private $_nombreLeconsEffectuees;
    
    /** Le client de l'élève */
    private $_client;
    
    /** La formule de l'éleve */
    private $_formule;
    
    /** True si il a eu son permis, sinon false */
    private $_examenPermis;
    
    /** True si il a eu son code sinon false */
    private $_examenCode;
    
    /** Date d'inscription de l'élève */
    private $_dateInscription;
    
    /** Constructeur par paramètres */
    function __construct($id, $prenom, $nom, $dateNaissance, $telDomicile,
                         $telPortable, $adresse,$telTravail, $moniteur, $nombreLeconsDisponibles, 
                         $nombreLeconsEffectuees, $client, $formule, $examenPermis, $examenCode, $dateInscription) {
        
        parent::__construct($id, $prenom, $nom, $dateNaissance, $telDomicile, $telPortable, $adresse);
        
        $this->_telTravail = $telTravail;
        $this->_moniteur = $moniteur;
        $this->_nombreLeconsDisponibles = $nombreLeconsDisponibles;
        $this->_nombreLeconsEffectuees = $nombreLeconsEffectuees;
        $this->_client = $client;
        $this->_formule = $formule;
        $this->_examenPermis = $examenPermis;
        $this->_examenCode = $examenCode;
        $this->_dateInscription = $dateInscription;
    }

    
    function get_telTravail() {
        return $this->_telTravail;
    }

    function get_moniteur() {
        return $this->_moniteur;
    }

    function set_telTravail($_telTravail) {
        $this->_telTravail = $_telTravail;
    }

    function set_moniteur($_moniteur) {
        $this->_moniteur = $_moniteur;
    }
    
    function get_nombreLeconsDisponibles() {
        return $this->_nombreLeconsDisponibles;
    }

    function get_nombreLeconsEffectuees() {
        return $this->_nombreLeconsEffectuees;
    }

    function get_client() {
        return $this->_client;
    }

    function get_formule() {
        return $this->_formule;
    }

    function get_examenPermis() {
        return $this->_examenPermis;
    }

    function get_examenCode() {
        return $this->_examenCode;
    }

    function set_nombreLeconsDisponibles($_nombreLeconsDisponibles) {
        $this->_nombreLeconsDisponibles = $_nombreLeconsDisponibles;
    }

    function set_nombreLeconsEffectuees($_nombreLeconsEffectuees) {
        $this->_nombreLeconsEffectuees = $_nombreLeconsEffectuees;
    }

    function set_client($_client) {
        $this->_client = $_client;
    }

    function set_formule($_formule) {
        $this->_formule = $_formule;
    }

    function set_examenPermis($_examenPermis) {
        $this->_examenPermis = $_examenPermis;
    }

    function set_examenCode($_examenCode) {
        $this->_examenCode = $_examenCode;
    }

    function getDateInscription() {
        return $this->_dateInscription;
    }

    function setDateInscription($dateInscription) {
        $this->_dateInscription = $dateInscription;
    }
}
