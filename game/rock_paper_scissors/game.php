<?php
session_start();
session_regenerate_id();
// Valida e imposta la modalità stile
include(__DIR__ . '/../../css/config.php');
// Valida e imposta la lingua
include(__DIR__ . '/../../languages/config.php');
// includo il file con le funzioni
include(__DIR__ . '/../the_ten_questions/function.php');
?>
<!DOCTYPE html>
<!-- uso php per recuperarela lingua -->
<html lang="<?php echo $lang ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/<?php echo $style ?>/header.css">
    <link rel="stylesheet" href="/css/<?php echo $style ?>/game2.css">
    <title>The Game - <?php echo $chose_lang['paper_scissors_rock'] ?></title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <?php
    // Includi l'header (navbar)
    include(__DIR__ . '/../../header.php');
    ?>
    <!-- struttura html principale del gioco: -->
    <div id="game_container">
        <form method="get">
            <h1><?php echo $chose_lang['paper_scissors_rock'] ?></h1>
            <label for="choice"><?php echo $chose_lang['choose option'] ?></label>
            <select name="choice" required>
                <option value="paper"><?php echo $chose_lang['paper'] ?></option>
                <option value="scissors"><?php echo $chose_lang['scissors'] ?></option>
                <option value="rock"><?php echo $chose_lang['rock'] ?></option>
            </select>
            <button id="btn" type="submit"><?php echo $chose_lang['game'] ?></button>
        </form>
        <?php
        // Logica di gioco
        if (isset($_GET['choice'])) {    // Verifica se è stato scelto un valore
            $choices = ['rock', 'paper', 'scissors'];
            $userChoice = strtolower($_GET['choice']);
            $computerChoice = $choices[array_rand($choices)];
        ?>
        <h1><?php echo $chose_lang['result'] ?></h1>
        <div class='result' id="container_result">
            <div id="chose">
                <div>
                    <!-- mostro cosa ha scelto l'utente scrivendolo ed aggiungo un img della scelta -->
                    <p><?php echo $chose_lang['user_choice'].'<br>'.$chose_lang[$userChoice];?></p>
                    <img src='img/<?php echo $userChoice;?>.png'>
                </div>
                <div>
                    <!-- mostro cosa ha scelto l'utente scrivendolo ed aggiungo un img della scelta -->
                    <p><?php echo $chose_lang['computer_choice'].'<br>'.$chose_lang[$computerChoice];?></p>
                    <img src='img/<?php echo $computerChoice;?>.png'>
                </div>
            </div>
            <?php
            // Logica risultato e gestione del puunteggio
            if ($userChoice == $computerChoice) { // Se "pareggio" assegna 5 punti e usa la funzione save_score per salvarli su file
                $score=5;
                save_score($score);
                echo "<p>".$chose_lang['tie']."</p>";
            } elseif (
                ($userChoice == 'paper' && $computerChoice == 'rock') ||
                ($userChoice == 'scissors' && $computerChoice == 'paper') ||
                ($userChoice == 'rock' && $computerChoice == 'scissors')
            ) {
                // Se l'utente "vince" assegna 10 punti e usa la funzione save_score per salvarli su file
                $score=10;
                save_score($score);
                echo "<p>".$chose_lang['won']."</p>";
            } else {
                // Se l'utente "perde" non aggiunge punti
                 echo "<p>".$chose_lang['lose']."</p>";
            }
        echo "</div>";
        }?>
    </div>
</body>
</html>