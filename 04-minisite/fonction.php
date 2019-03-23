<?php

function calcul($fruits, $poids){
        switch($fruits){
            case 'cerise' : $pu = 5.76; break;
            case 'banane' : $pu = 1.09; break;
            case 'pomme' : $pu = 1.61; break;
            case 'peche' : $pu = 3.23; break;
        } 
        $montant = $poids * $pu;
        return number_format($poids,1,',',' ') . "KG de $fruits vous coûteront ".number_format($montant,2,',',' ') .' € <br>';
}