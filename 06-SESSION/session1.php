<?php

session_start();

$_SESSION['pseudo'] = 'Fredo';
$_SESSION['email'] = 'toto@free.Fr';

var_dump($_SESSION);