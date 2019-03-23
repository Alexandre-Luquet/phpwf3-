<?php

$dir = 'img';
$fichiers = scandir($dir);

var_dump($fichiers);

$ext_auto = array('jpg', 'png', 'jpeg', 'gif');

foreach($fichiers as $fichier){
    if( is_file($dir . '/' . $fichier) 
    && in_array(pathinfo($fichier,PATHINFO_EXTENSION),$ext_auto ) )
    {
        //* echo "$fichier est un fichier image !<br>";
        ?>
        <img src="<?= $dir . '/' . $fichier ?>" alt="yessir">
        <?php
    }
}