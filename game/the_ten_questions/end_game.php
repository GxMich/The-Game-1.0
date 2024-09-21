<?php 
session_start();
session_regenerate_id();
// Verifica se l'utente ha effettuato l'accesso correttamente
if (!isset($_SESSION["login_user"]) || !$_SESSION["login_user"]) {
    // Se l'utente non ha effettuato l'accesso, reindirizza alla pagina principale
    header("Location: ../index.php");
    exit();
}
// Elimina eventuali messaggi di errore precedenti impostando i cookie a una data passata
setcookie('error_signIn', '', time() - 3600);
setcookie('error_login', '', time() - 3600);

// Gestione dei file di lingua
include(__DIR__ . '/../../languages/config.php');

// Imposta il tema dello stile
include(__DIR__ . '/../../css/config.php');
// Includo le funzioni per vedere il punteggio e salvarlo
include(__DIR__ . '/function.php');
if(!isset($_SESSION['answers_correct_current_game']) || !isset($_SESSION['score_current_game'])){
    // Verifica le risposte dell'utente e calcola il punteggio
    $answers_correct = check_answers();
    $_SESSION['answers_correct_current_game']= $answers_correct;
    // Salva il punteggio dell'utente
    $score = count_score($answers_correct);
    $_SESSION['score_current_game'] = $score;
    save_score($score);
}
?>
<!DOCTYPE html>
<html lang="<?php echo $_COOKIE['lang'] ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/../../css/<?php echo $style ?>/header.css">
    <link rel="stylesheet" href="/../../css/<?php echo $style ?>/end_game.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <title>Document</title>
</head>
<body>
    <!-- Include l'header -->
    <?php include(__DIR__ . '/../../header.php'); ?>
    <div id="container_end_game">
        <!-- Mostra il risultato del quiz -->
        <h1><?php echo $chose_lang['result']; ?></h1>
        <div id="result">
            <p><?php echo $chose_lang['main_prt1'].$_SESSION['answers_correct_current_game'].$chose_lang['main_prt2']; ?></p>
            <p><?php echo $chose_lang['main_prt3'].$_SESSION['score_current_game'].$chose_lang['main_prt4']; ?> </p>
        </div>
        <!-- Form per giocare di nuovo -->
        <div id="container_brn_replay">
            <form action="game.php">
                <input type="submit" value="<?php echo $chose_lang['play_again']; ?>" id="brn_replay">
            </form>
        </div>
    </div>
</body>
</html>