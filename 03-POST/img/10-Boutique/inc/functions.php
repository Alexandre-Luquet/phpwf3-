<?php

// tester si un membre est connecté
function isConnected(){
    if( isset($_SESSION['membre']) ){
        return true;
    }
    else{
        return false;
    }
}

// tester si un membre est Admin
function isAdmin(){
    if( isConnected() && $_SESSION['membre']['statut'] == 1 ){
        return true;
    }
    else{
        return false;
    }
}

// Fonction de requete SQL 
function execQuery($req,$params = array()){

    // Sanitize
    if ( !empty($params)){
        foreach($params as $key => $value){
            $params[$key] = strip_tags($value);
        }
    }
    global $pdo; // Globalisation de $pdo

    $r = $pdo->prepare($req);
    $r->execute($params);
    if( !empty($r->errorInfo()[2]) ){
        die('Erreur rencontrée lors de la reqûete : ' . $r->errorInfo()[2]);
    }

    return $r;
}

// Fonctions liées au Panier
