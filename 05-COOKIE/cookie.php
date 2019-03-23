<h1>Votre langue</h1>

<ul>
    <li><a href="?pays=fr">France</a></li>
    <li><a href="?pays=es">Espagne</a></li>
    <li><a href="?pays=en">Angleterre</a></li>
    <li><a href="?pays=it">Italie</a></li>
</ul>

<?php

if (isset($_GET['pays'])){
    $pays = $_GET['pays'];
}
elseif( isset($_COOKIE['pays'])){
    $pays = $_COOKIE['pays'];
}
else{
    $pays = 'fr';
}


$un_an = 365 * 24 * 3600;

setCookie('pays',$pays,time() + $un_an);
//* setCookie(nom,valeur, expiration(timestam))
//* time() renvoie le timestamp courant

switch($pays){
    case "fr" : echo "Bonjour vous visitez ce site en francais"; 
        break;
    case "es" : echo "Hola, En este memento, esta visitando el sitio en espanol"; 
        break;
    case "en" : echo "Hello, you're currently visiting the website in english"; 
        break;
    case "it" : echo "Ciao, si sta attualmente visitando il sito in italiano"; 
        break;
}