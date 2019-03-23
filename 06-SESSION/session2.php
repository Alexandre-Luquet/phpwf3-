<?php

session_start(); //* démarre une nouvelle session ou bien récupère une session en cours

echo "Bonjour " . $_SESSION['pseudo'] . '<br>';

//* sesion_destroy();
//* detruit la session, mais c'est effectif à la fin du script

unset($_SESSION['email']); // * détruit $_SESSION['email']

var_dump($_SESSION);