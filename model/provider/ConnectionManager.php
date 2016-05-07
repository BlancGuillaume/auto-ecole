<?php

/*
 * Connection à la base de données
 * Si impossible une exeption est lancée
 * 
 * @author Guillaume Blanc
 */
class ConnectionManager {


public function connect() {
    $conn = oci_connect('SYSTEM', 'root', 'localhost/XE');

    if (!$conn) {
        $e = oci_error();
        exit("ERREUR DE CONNEXION : " . $e['message']);
    } else {
        echo "connexion à la bdd : ok";
    }
    // else : connection ok

    return $conn;
}

}