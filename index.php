<?php
session_start(); // Inizia una nuova sessione o riprende una sessione esistente
$_SESSION['user_name']=''; // Imposta la variabile di sessione 'user_name' a una stringa vuota
setcookie('user_name','',time()+3600); // Imposta un cookie 'user_name' vuoto con una durata di un'ora
$showCookieBanner = true; // Variabile per determinare se mostrare i cookie
// Verifica se il parametro 'cookie' è settato e ha il valore 'true'
if(isset($_GET['cookie']) && $_GET['cookie'] === 'true') {
    $_SESSION['cookie'] = 'true'; // Imposta la variabile di sessione 'cookie' a 'true'
    setcookie('cookie', 'true', time() + 3600); // Imposta un cookie 'cookie' a 'true' con una durata di un'ora
    $showCookieBanner = false; // Non mostrare il banner dei cookie
} elseif(isset($_COOKIE['cookie']) && $_COOKIE['cookie'] === 'true') {
    $showCookieBanner = false; // Non mostrare i cookie se il cookie esiste già ed è 'true'
}
// Gestione dello stile
include(__DIR__ . '/css/config.php');
// Gestione dei file di lingua
include(__DIR__ . '/languages/config.php');
include(__DIR__ . '/languages/' . $lang . '.php');
?>
<!DOCTYPE html>
<html lang="<?php echo $lang ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $chose_lang['title_page']; ?></title>
    <link rel="stylesheet" href="/css/<?php echo $style ?>/generic.css">
    <link rel="stylesheet" href="/css/<?php echo $style ?>/cookie.css">
    <link rel="stylesheet" href="/css/<?php echo $style ?>/login_signUp.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
<header>
    <div id="navbar">
        <h1 id="name_site">The Game</h1>
        <div class="navbar_swich" id="swich_style">
            <div class="navbar_swich_item" id="swich_style_darkMode">
                <a href='?style_mode=dark_mode' class="swich_style_a"><?php echo $chose_lang['dark_mode']; ?></a>
            </div>
            <div class="navbar_swich_item" id="swich_style_litekMode">
                <a href='?style_mode=lite_mode' class="swich_style_a"><?php echo $chose_lang['lite_mode']; ?></a>
            </div>
        </div>
    </div>
    <?php
    if ($showCookieBanner) { // Mostra il banner dei cookie se $showCookieBanner è true
    ?>                       
    <div id="cookie">
        <div id="cookie_header">
            <h1><?php echo $chose_lang['h1_cookie']; ?></h1>
        </div>
        <div id="cookie_main">
            <p><?php echo $chose_lang['p_cookie']; ?></p>
        </div>
        <div id="cookie_footer">
            
            <div id="cookie_footer_set_lang" class="cookie_footer_item">
                <a style="
                    <?php 
                    // creo una struttura if else per modificare lo stile (css) dello "swich" login/sign up 
                    if($lang==='it') {
                        if($style==='dark_mode'){
                            echo 'background-color:rgba(182, 179, 179, 1); color: black;';
                        }else{//lite_mode
                            echo 'background-color:rgba(241, 205, 153, 1); color: black;';
                        }
                    }else{
                        if($style==='dark_mode'){
                            echo 'color: white;';
                        }else{
                            echo 'color: black;';
                        }
                    }
                    ?>" class="cookie_buttom cookie_buttom_lang" id="cookie_buttom_lang_it" href='?lang=it'><?php echo $chose_lang['italian']; ?></a>
                <a style="<?php
                    if($lang==='en') {
                        if($style==='dark_mode'){
                            echo 'background-color:rgba(182, 179, 179, 1); color: black;';
                        }else{
                            echo 'background-color:rgba(241, 205, 153, 1); color: black;';
                        }
                    }else{
                        if($style==='dark_mode'){
                            echo 'color: white;';
                        }else{
                            echo 'color: black;';
                        }
                    }
                    ?>" class="cookie_buttom cookie_buttom_lang" id="cookie_buttom_lang_en" href='?lang=en'><?php echo $chose_lang['english']; ?></a>
            </div>
            <div id="cookie_footer_button" class="cookie_footer_item">
                <form method="get" action="" style="display: inline;">
                    <input type="hidden" name="cookie" value="true">
                    <button type="submit" class="cookie_buttom" id='cookie_button_accept'><?php echo $chose_lang['button_accept_cookie']; ?></button>
                </form>
            </div>
        </div>
    </div>
    <?php
    }//chiudo i'if che controlla se mostrare il banner dei cookie
    ?>
</header>
<main style='display: <?php echo $showCookieBanner ? "none" : "block"; ?>'> <!-- Nasconde il contenuto principale se il banner dei cookie è visibile -->
    <!-- Questo "swich" serve solo per carpire cosa vuole fare l'utente, se clicca su login verrà mostrato solo il form di login e viceversa se clicca su signUp -->
    <div id="container_swich_login_signUp">
        <label class="swich_login_signUp active" id="swich_login"><?php echo $chose_lang['login'];?></label>
        <label class="swich_login_signUp" id="swich_signUp"><?php echo $chose_lang['sign_Up'];?></label>
    </div>
    
    <!-- Sezione login -->
    <div id="login" class="login_signUp">
        <form method="post" action="login.php">
            <label><?php echo $chose_lang['login']; ?></label>
            <input type="text" name="user_name" placeholder="USERNAME" required>
            <input type="password" name="user_password" placeholder="PASSWORD" required>
            <input class="btn" type="submit" value="<?php echo $chose_lang['login']; ?>">
        </form>
        <?php
        if(isset($_COOKIE['error_login'])){ // Mostra eventuali errori di login
        ?>
        <div class="error_login_signUp">
            <p><?php echo $_COOKIE['error_login'] ?></p>
        </div>
        <?php
        }
        ?>
    </div>

    <!-- Sezione sign up -->
    <div id="signUp" class="login_signUp" style='display:none'>
        <form method="post" action="signUp.php">
            <label><?php echo $chose_lang['sign_Up']; ?></label>
            <input type="text" name="user_name" placeholder="<?php echo $chose_lang['username']; ?>" required>
            <input type="password" name="user_password" placeholder="<?php echo $chose_lang['password']; ?>" required>
            <input type="password" name="user_confirms_password" placeholder="<?php echo $chose_lang['confirms_password']; ?>" required>
            <input class="btn" type="submit" value="<?php echo $chose_lang['sign_Up']; ?>">
        </form>
        <?php
        if(isset($_COOKIE['error_signUp'])){ // Mostra eventuali errori di registrazione
        ?>
        <div class="error_login_signUp">
            <p><?php echo $_COOKIE['error_signUp'] ?></p>
        </div>
        <?php
        }
        ?>
    </div>
</main>
<script>
    // Script che si occupa di mostrare o nascondere la sezione login/signUp
    $(document).ready(function () {
        $('#swich_signUp').click(function () { // Mostra la sezione di registrazione e nasconde la sezione di login
            $('#login').hide();
            $('#signUp').show();
            $('#swich_signUp').addClass('active');
            $('#swich_login').removeClass('active');
        });
        $('#swich_login').click(function () { // Mostra la sezione di login e nasconde la sezione di registrazione
            $('#login').show();
            $('#signUp').hide();
            $('#swich_signUp').removeClass('active');
            $('#swich_login').addClass('active');
        });
    });
</script>
</body>
</html>
