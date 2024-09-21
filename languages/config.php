<?php
$lang = 'en'; // Imposta la lingua predefinita a inglese
// Verifica se la lingua è stata passata tramite GET
if (isset($_GET['lang'])) {
    $lang = $_GET['lang']; // Imposta la lingua dalla variabile GET
    $_SESSION['lang'] = $lang; // Salva la lingua nella variabile di sessione
} elseif (isset($_SESSION['lang'])) {
    $lang = $_SESSION['lang']; // Recupera la lingua dalla variabile di sessione se esiste
} elseif (isset($_COOKIE['lang'])) {
    $lang = $_COOKIE['lang']; // Recupera la lingua dal cookie se esiste
}
setcookie('lang', $lang, time() + 3600);
include(__DIR__ . '/' . $lang . '.php');
?>