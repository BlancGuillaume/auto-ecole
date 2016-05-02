<?php

/*
 * Connection à la base de données
 * Si impossible une exeption est lancée
 * 
 * @author Guillaume Blanc
 */

/* identifiant et login de la bdd */
$conn = oci_connect('admin', 'admin');

if (!$conn) {
    $e = oci_error();
    exit("ERREUR DE CONNEXION : " . $e['message']);
}
// else : connection ok

return $conn;