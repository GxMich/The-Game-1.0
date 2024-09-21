<?php
// Imposta lo stile predefinito su 'dark_mode'
$style = 'dark_mode';
// Controlla se lo stile è stato impostato tramite query string, sessione o cookie
if (isset($_GET['style_mode'])) {
    $style = $_GET['style_mode'];
    $_SESSION['style_mode'] = $style;
} elseif (isset($_SESSION['style_mode'])) {
    $style = $_SESSION['style_mode'];
} elseif (isset($_COOKIE['style_mode'])) {
    $style = $_COOKIE['style_mode'];
}
    setcookie('style_mode', $style, time() + 3600);
?>