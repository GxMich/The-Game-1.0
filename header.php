<header>
  <div id="navbar">
    <div id="navbar_left">
      <h1 id="name_site">The Game</h1>
    </div>
    <div id="navbar_right">
      <div id="navbar_swich">
        <div class="navbar_swich" id="swich_style">
          <div class="navbar_swich_item" id="swich_style_darkMode" <?php 
            if($style==='dark_mode'){
              echo 'style="background-color: rgba(182, 179, 179, 1);"';
            }
            ?>
            >
            <a href='?style_mode=dark_mode' class="swich_style_a" <?php 
              if($style==='dark_mode'){
                echo 'style="color: black;"';
              }?> ><?php echo $chose_lang['dark_mode']; ?></a>
          </div>
          <div class="navbar_swich_item" id="swich_style_litekMode"  <?php 
            if($style==='lite_mode'){
              echo 'style="background-color: rgba(240, 168, 59, 1);"';
            }?>
            >
            <a href='?style_mode=lite_mode' class="swich_style_a"  ><?php echo $chose_lang['lite_mode']; ?></a>
          </div>
        </div>
      
        <div class="navbar_swich" id="swich_lang">
          <div class="navbar_swich_item" id="swich_lang_it"  <?php 
            if($lang==='it'){
              if($style==='dark_mode'){
                echo 'style="background-color:  rgba(182, 179, 179, 1);"';
              }else{
                echo 'style="background-color:  rgba(240, 168, 59, 1);"';
              }
            }
            ?> >
            <a class="cookie_buttom" href='?lang=it' <?php 
              if($lang==='it'){
                if($style==='dark_mode'){
                  echo 'style="color:  black;"';
                }
              }
              ?> >IT</a>
          </div>
          <div class="navbar_swich_item" id="wich_lang_en"  <?php 
            if($lang==='en'){
              if($style==='dark_mode'){
                echo 'style="background-color:  rgba(182, 179, 179, 1);"';
              }else{
                echo 'style="background-color:  rgba(240, 168, 59, 1);"';
              }
            }
            ?> >
            <a class="cookie_buttom" href='?lang=en' <?php 
              if($lang==='en'){
                if($style==='dark_mode'){
                  echo 'style="color:  black;"';
                }
              }
              ?> >EN</a>
          </div>
        </div>
      </div>
      <div id="navbar_item_menu">
        <ul id="nav_menu">
          <div class="nav_item">
            <li>
              <a href="/../../home.php"><?php echo $chose_lang['home'];?></a>
            </li>
          </div>
          <div class="nav_item">
            <li>
              <a href="/../../logout.php"><?php echo $chose_lang['logout'];?></a>
            </li>
          </div>
        </ul>
      </div>
    </div>
  </div>
</header>