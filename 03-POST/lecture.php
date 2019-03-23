<?php

$fichier = file('infos.txt');
//* recupére les lignes d'un fichier dans un tableau

var_dump($fichier);

echo implode('<br>', $fichier);