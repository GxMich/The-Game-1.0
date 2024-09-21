<?php
session_start();//continua la sessione gia aperta nell'index
// Includi il file di configurazione per le lingue
include(__DIR__ . '/languages/config.php');
// Verifica se sono stati inviati i dati di login tramite il metodo POST
if(isset($_POST['user_name']) && isset($_POST['user_password'])) {
    // Apre il file degli utenti in modalità lettura
    $file_open = fopen('users.txt', 'r');
    if($file_open) {
        $user_found = false;
        // Ciclo per leggere ogni riga del file degli utenti
        while(($line = fgets($file_open)) !== false) {
            // Divide la riga in un array di dati (username, password, punteggio)
            $data_user = explode(' ', $line);
            // Verifica se il nome utente e la password sono corretti
            if(($data_user[0] === $_POST['user_name']) && (password_verify($_POST['user_password'], $data_user[1]))) {
                // Imposta i cookie con il nome utente e il punteggio dell'utente
                setcookie('user_name', $_POST['user_name'], time() + 3600);
                setcookie('user_score', intval($data_user[2]), time() + 3600);                
                // Imposta le variabili di sessione con il nome utente e il punteggio dell'utente
                $_SESSION['user_name'] = $_POST['user_name'];
                $_SESSION['user_score'] = $data_user[2];
                $_SESSION['login_user'] = true;
                // Chiude il file e reindirizza alla pagina home
                fclose($file_open);
                header('Location: home.php');
                exit();
            } else {
                // Se le credenziali sono errate, imposta un cookie con il messaggio di errore
                setcookie('error_login', $chose_lang['incorrect_credentials'], time() + 3600);
                // Simula credenziali non valide per evitare loop di reindirizzamento
                $_GET['user_name'] = 'not user';
                $_GET['user_password'] = 'not user';
                // Chiude il file e reindirizza alla pagina di login
                fclose($file_open);
                header('Location: index.php');
                exit();
            }
        }
    } else {
        // Se non è possibile aprire il file, imposta un cookie con il messaggio di errore
        setcookie('error_login', $chose_lang['error_file'], time() + 3600);
        // Reindirizza alla pagina di login
        header('Location: index.php');
        exit();
    }
} else {
    // Se i dati di login non sono stati inviati correttamente, imposta un cookie con il messaggio di errore
    setcookie('error_login', $chose_lang['credentials_empty'], time() + 3600);
    // Reindirizza alla pagina di login
    header('Location: index.php');
    exit();
}
?>