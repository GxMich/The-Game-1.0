<?php 
session_start();
session_regenerate_id();
// Verifica se l'utente ha effettuato l'accesso correttamente
if (!isset($_SESSION["login_user"]) || !$_SESSION["login_user"]) {
    // Se l'utente non ha effettuato l'accesso, reindirizza alla pagina principale
    header("Location: ../index.php");
    exit();
}
/*
unset($_SESSION['answers_correct_current_game']);
unset($_SESSION['score_current_game']);
*/
// Elimina eventuali messaggi di errore precedenti impostando i cookie a una data passata
setcookie('error_signUp', '', time() - 3600);
setcookie('error_login', '', time() - 3600);
setcookie('error_score', '', time() - 3600);
// Recupero i punteggio salvati sul file
// Apri il file 'users.txt' in modalità lettura
$file_open = fopen(__DIR__ . '/users.txt', 'r');
if ($file_open) {
    $user_found = false;
    // Leggi il file riga per riga
    while (($line = fgets($file_open)) !== false) {
        $date_user = explode(' ', trim($line)); // Divide la riga in un array
        // Se il nome utente corrisponde a quello nel cookie
        if ($date_user[0] === $_COOKIE['user_name']) {
            // Imposta un cookie con il punteggio dell'utente
            $_SESSION['user_score']=intval($date_user[2]);
            $user_found = true;
            break;
        }
    }
    fclose($file_open); // Chiudi il file
    if (!$user_found) {
        // Se l'utente non è trovato, imposta un cookie di errore
        setcookie('error_score', $chose_lang['error_score'], time() + 3600);
    }
} else {
    // Se il file non può essere aperto, imposta un cookie di errore
    setcookie('error_score', $chose_lang['error_score'], time() + 3600);
}

// Gestione dei file di lingua
include(__DIR__ . '/languages/config.php');
// Imposta il tema dello stile
include(__DIR__ . '/css/config.php');

?>
<!DOCTYPE html>
<html lang="<?php echo $_COOKIE['lang'] ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/<?php echo $style ?>/home.css">
    <link rel="stylesheet" href="/css/<?php echo $style ?>/header.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <title>The Game - HomePage</title>
</head>
<body>
<?php
    // Includi l'header (navbar)
    include(__DIR__ . '/header.php');
    
    // Includi il punteggio 
    include(__DIR__ . '/score.php');
?>  
    <div id="our_games">
        <h1 id="h1_our_games"><?php echo $chose_lang['our_games'] ?></h1>
        <div class="game" id="game_ten">
            <div class="game_content">
                <h1><?php echo $chose_lang['the_ten_questions'] ;?></h1>
                <p><?php echo $chose_lang['the_ten_questions_description'];?></p>
            </div>
            
            <form action="game/the_ten_questions/game.php">
                <input id="game_button" type="submit" value="<?php echo $chose_lang['game'];?>">
            </form>
        </div>
        <div class="game" >
            <div class="game_content">
                <h1><?php echo $chose_lang['paper_scissors_rock'];?></h1>
                <p><?php echo $chose_lang['paper_scissors_rock_description'];?></p>
            </div>

            <form action="game/rock_paper_scissors/game.php">
                <input id="game_button" type="submit" value="<?php echo $chose_lang['game'];?>">
            </form>
        </div>
    </div>  
    
    
</body>
</html>