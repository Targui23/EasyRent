<?php

session_start();

// Svuota tutte le variabili di sessione
$_SESSION = array();

// Distrugge la sessione
session_destroy();

setcookie(session_name(), '', time() - 3600, '/');

// Verifica se $_SESSION è vuota
if (empty($_SESSION)) {
    echo "La sessione è stata distrutta correttamente.";
    header("Location:/../public/index.php");
} else {
    echo "La sessione non è stata distrutta correttamente.";
}

?>
