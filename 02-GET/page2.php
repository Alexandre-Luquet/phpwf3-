<h1>Page 2</h1>
<?php

var_dump($_GET);

echo $_GET['couleur'];

/*  $_GET est une superglobale sous forme de tableau
    Elle récupère index et valeurs via l'URL
    /!\ On ne fait pas transiter des informations sensibles (mot de passe, CB etc...)
    par $_GET
*/