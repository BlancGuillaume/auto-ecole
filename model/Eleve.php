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
    
    /** Constructeur par défaut */
    function __construct() {
        parent::construct();
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
    
    /**
     * Récupération de la liste des élèves
     */
    function get_eleves() {
        // TODO : c'est ici qu'il faut accéder à la bdd
        // Pour chaque ligne on va créer un eleve
        // et on renverra une liste d'élèves
    }
}
