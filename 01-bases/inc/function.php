<?php 
    function pre($var, $type = true){
        if($type == true) {
            echo '<pre>'; print_r($var); echo '</pre>';
        } else {
            echo '<pre>'; var_dump($var); echo '</pre>';
        }
    }