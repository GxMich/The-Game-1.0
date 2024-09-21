<?php
session_start();
session_regenerate_id();
// Verifica se l'utente ha effettuato l'accesso correttamente
if (!isset($_SESSION["login_user"]) || !$_SESSION["login_user"]) {
    // Se l'utente non ha effettuato l'accesso, reindirizza alla pagina principale
    header("Location: ../index.php");
    exit();
}
unset($_SESSION['answers_correct_current_game']);
unset($_SESSION['score_current_game']);
// Valida e imposta la modalità stile
include(__DIR__ . '/../../css/config.php');

// Valida e imposta la lingua

include(__DIR__ . '/../../languages/config.php');
?>
<!DOCTYPE html>
<html lang="<?php echo $lang ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/<?php echo $style ?>/header.css">
  <link rel="stylesheet" href="/css/<?php echo $style ?>/game.css">
    <title>The Game - <?php echo $chose_lang['the_ten_questions'] ?></title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
  <?php

  // Includi l'header (navbar)
  include(__DIR__ . '/../../header.php');
?>
  <div id="game_container">
    <!-- Mostra il titolo della sezione delle domande -->
    <h1 id="name_game"><?php echo $chose_lang['the_ten_questions'] ?></h1>
    
    <!-- Form per inviare le risposte alle domande -->
    <form action="end_game.php" method="get">
    <?php
      // Cicla attraverso le domande e le visualizza nel form
      foreach($questions as $key=>$value){
      ?>
      <div class='question_answers'>
        <label class='questions'><?php echo $value ?></label>
        <br>
        <input class='answers' type="text" name="<?php echo $key.'_answers_choice'?>" placeholder="<?php echo $chose_lang['write_answer']; ?>">
      </div>
      <?php
    }
    ?>
        <!-- Pulsante per inviare le risposte -->
        <input id="btn_sub" type="submit" value="<?php echo $chose_lang['send'] ?>">
    </form>
</div>
</body>
</html>
