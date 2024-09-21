<?php
session_start(); // Continua la sessione
include(__DIR__ . '/languages/config.php'); // Includi il file di configurazione della lingua
// Verifica se sono stati inviati i dati del modulo di registrazione
if(isset($_POST['user_name']) && isset($_POST['user_password']) && isset($_POST['user_confirms_password'])) {
    // Apre il file in modalità lettura/scrittura
    $file_open = fopen('users.txt', 'a+');
    if($file_open) {
        // Controlla se l'username è già presente nel file
        while(($line = fgets($file_open)) !== false) {
            $date_user = explode(' ', $line);
            if($date_user[0] === $_POST['user_name']) {
                // Se l'username è già presente, imposta un cookie di errore e reindirizza alla pagina di registrazione
                setcookie('error_signUp', $chose_lang['username_used'], time() + 3600);
                fclose($file_open);
                header('Location: index.php');
                exit();
            }
        }
        // Verifica se le due password inserite corrispondono
        if($_POST['user_password'] === $_POST['user_confirms_password']) {
            // Imposta i cookie per l'utente e il punteggio
            setcookie('user_name', $_POST['user_name'], time() + 3600);
            setcookie('user_score', 0, time() + 3600);
            // Cifra la password con password_hash()
            $crypt_password = password_hash($_POST['user_password'], PASSWORD_DEFAULT);
            // Crea una stringa con le credenziali da scrivere nel file
            $credentials = $_POST['user_name'] . " " . $crypt_password . " 0\n";
            // Scrive le credenziali nel file
            $write = fwrite($file_open, $credentials);
            // Chiude il file
            fclose($file_open);
            $_SESSION['login_user'] = true;
            // Reindirizza alla pagina home.php dopo la registrazione
            header('Location: home.php');
            exit();
        } else {
            // Se le password non corrispondono, imposta un cookie di errore e reindirizza alla pagina di registrazione
            setcookie('error_signUp', $chose_lang['incorrect_password'], time() + 3600);
            fclose($file_open);
            header('Location: index.php');
            exit();
        }
    } else {
        // Se non è possibile aprire il file, imposta un cookie di errore e reindirizza alla pagina di registrazione
        setcookie('error_signUp
        ', $chose_lang['error_file'], time() + 3600);
        header('Location: index.php');
        exit();
    }
} else {
    // Se non sono stati forniti tutti i dati necessari, imposta un cookie di errore e reindirizza alla pagina di registrazione
    setcookie('error_signUp', $chose_lang['credentials_empty'], time() + 3600);
    header('Location: index.php');
    exit();
}
?>