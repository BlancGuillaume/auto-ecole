<?php

/**
 * Un salarié est un Individu qui est employée par l'auto-ecole
 *
 * @author Guillaume Blanc
 */

include_once('Individu.php');

class Salarie extends Individu {
    
    /** Surnom du salarié : utilisé par certains clients */
    private $_surnom;
    
    /** Date de recrutement du salarié */
    private $_dateRecrutement;
    
    /** Catégorie a laquelle appartient le salarié */
    private $_categorie;
   
    /** Voiture dont le salarié est responsable */
    private $_voiture;
    
    /** Eleves du salarié */
    private $_eleves;
    
    function __construct($id, $prenom, $nom, $dateNaissance, $telDomicile, 
            $telPortable, $adresse, $surnom, $dateRecrutement, $categories, $voiture, $eleves) {
        
        parent::__construct($id, $prenom, $nom, $dateNaissance, $telDomicile, $telPortable, $adresse);
        
        $this->_surnom = $surnom;
        $this->_dateRecrutement = $dateRecrutement;
        $this->_categorie = $categories;
        $this->_voiture = $voiture;
        $this->_eleves = $eleves;
    }

    

    function get_surnom() {
        return $this->_surnom;
    }

    function get_dateRecrutement() {
        return $this->_dateRecrutement;
    }

    function get_categorie() {
        return $this->_categorie;
    }

    public function get_voiture() {
        return $this->_voiture;
    }

    function set_surnom($_surnom) {
        $this->_surnom = $_surnom;
    }

    function set_dateRecrutement($_dateRecrutement) {
        $this->_dateRecrutement = $_dateRecrutement;
    }

    function set_categorie($_categories) {
        $this->_categorie = $_categories;
    }

    function set_voiture($_voiture) {
        $this->_voiture = $_voiture;
    }
}
