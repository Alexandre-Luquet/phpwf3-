<?php

session_start();

echo "Temps actuel : " . time() . "<br>";

if ( isset($_SESSION['temps']) ) 
{
    if ( time() > $_SESSION['temps'] + $_SESSION['limite'])
    {
        session_destroy();
        echo "déconnexion, session expirée<br>";
    }
    else{
        $_SESSION['temps'] = time();
        echo "connexion mise à jour<br>";
    }
}
else
{
    echo "connexion<br>";
    $_SESSION['limite'] = 15;
    $_SESSION['temps'] = time();
}

var_dump($_SESSION);