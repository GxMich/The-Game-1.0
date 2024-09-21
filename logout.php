<?php 
session_start();
$cookies = $_COOKIE;
// Uso foreach per scorrere tutti i cookie e cancellarli
foreach ($cookies as $key => $value) {
    setcookie($key, '', time() - 3600, '/');
}
$_COOKIE = array();
$_GET = array();
$_POST = array();
// Rimuove tutte le variabili di sessione
session_unset();
// Distrugge la sessione
session_destroy();
// Rindirizzo l'utente alla pagina principale
header('location: index.php');
exit();
?>