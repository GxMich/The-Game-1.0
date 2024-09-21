<?php
// Funzione che controlla quante risposte sono corrette
function check_answers(){
  // Array delle risposte corrette in base alla lingua impostata nel cookie 'lang'
  if($_COOKIE['lang']==='it'){
    $answers=[
      1=>'roma',
      2=>'7',
      3=>'balenottera blu',
      4=>'leonardo da vinci',
      5=>'au',
      6=>'mercurio',
      7=>'11',
      8=>'portoghese',
      9=>'4',
      10=>'pipistrello'
    ];
  }elseif($_COOKIE['lang']==='en'){
    $answers=[
      1=>'Rome',
      2=>'Seven',
      3=>'The blue whale',
      4=>'Leonardo da Vinci',
      5=>'Au',
      6=>'Mercury',
      7=>'Eleven',
      8=>'Portuguese',
      9=>'Four',
      10=>'The bat'
    ];
  }
  $answers_correct=0; // Inizializza il contatore delle risposte corrette
  // Cicla attraverso le risposte per controllare quelle fornite dall'utente
  foreach($answers as $key => $value){
    if(isset($_GET[$key . '_answers_choice']) && strtolower($_GET[$key . '_answers_choice']) === strtolower($value)){
      $answers_correct+=1; // Incrementa il contatore se la risposta è corretta
    }
  }
  return $answers_correct; // Restituisce il numero di risposte corrette
}

// Funzione che assegna quanti punti ha ottenuto il giocatore
function count_score($correct_answers){
  $score=$correct_answers*10; // Calcola il punteggio moltiplicando le risposte corrette per 10
  return $score; // Restituisce il punteggio calcolato
}

// Funzione che salva il punteggio sul file
function save_score($score) {
  $file_path = __DIR__ . '/../../users.txt'; // Percorso del file utenti
  $temp_file_path = __DIR__ . '/../../users_temp.txt'; // Percorso del file temporaneo
  // Apre il file originale in lettura e il file temporaneo in scrittura
  $file_open = fopen($file_path, 'r');
  $temp_file_open = fopen($temp_file_path, 'w');
  $user_found = false; // Flag per indicare se l'utente è stato trovato nel file
  // Verifica se è possibile aprire entrambi i file
  if ($file_open && $temp_file_open) {
    while (($line = fgets($file_open)) !== false) {
      $date_user = explode(' ', trim($line)); // Legge e divide la riga del file in un array
      if ($date_user[0] === $_COOKIE['user_name']) {
        // Se l'utente è trovato, aggiorna il punteggio
        $new_score = $date_user[2] + $score; // Calcola il nuovo punteggio
        $date_user[2] = $new_score; // Aggiorna il punteggio nell'array della riga utente
        $user_found = true; // Imposta il flag utente trovato a true
      }
      fwrite($temp_file_open, implode(' ', $date_user) . PHP_EOL); // Scrive la riga aggiornata nel file temporaneo
    }
    fclose($file_open); // Chiude il file originale
    fclose($temp_file_open); // Chiude il file temporaneo
    if ($user_found) {
      unlink($file_path); // Elimina il file originale
      rename($temp_file_path, $file_path); // Rinomina il file temporaneo con il nome del file originale
      return true; // Restituisce true se l'utente è stato trovato e aggiornato
    } else {
      unlink($temp_file_path); // Elimina il file temporaneo se l'utente non è stato trovato
      return false; // Restituisce false se l'utente non è stato trovato
    }
  } else {
    if ($file_open) fclose($file_open); // Chiude il file originale se è aperto
    if ($temp_file_open) fclose($temp_file_open); // Chiude il file temporaneo se è aperto
    return false; // Restituisce false se non è possibile aprire entrambi i file
  }
}
?>