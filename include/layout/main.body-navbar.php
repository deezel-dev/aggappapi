<?php 
    $ROOT = "http://" . $_SERVER['HTTP_HOST']; 
?>

<header class="navbar navbar-default navbar-static-top" id="top">
   
   <div class="container-fluid">
      <div class="navbar-header">

         <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" 
             data-target="#navbar" aria-expanded="false" aria-controls="navbar">
             <span class="icon-bar"></span>
             <span class="icon-bar"></span>
             <span class="icon-bar"></span>
         </button>

         <a class="navbar-brand" ui-sref="flix_main({mode: 1})"><img style="height: 100%;" src="/public/images/logo.jpg" alt="deezel" /></a>

          <!-- nav search_bar -->
          <div style="display: inline-block">
            <div class="visible-xs"><?php require $ROOT . "/flix/mobile/flix_nav_search.html" ?></div>
            <div class="visible-sm visible-md visible-lg"><?php require $ROOT . "/flix/desktop/flix_nav_search.html" ?></div>
          </div>

      </div>

      <div id="navbar" class="navbar-collapse collapse">
         <ul class="nav navbar-nav navbar-left">

            <?php if (isset($_SESSION[SESSION_PROFILE_ID])) { ?>                
                <li><a ui-sref="flix_main({mode: 2})" data-toggle="collapse" data-target=".navbar-collapse.in">My Playlist</a></li>
            <?php } ?>

            <li class="dropdown">
               <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Navigation<span class="caret"></span></a>
               <ul class="dropdown-menu" role="menu">
                  <li><a href="#flix_main?scrollTo=#how" data-toggle="collapse" data-target=".navbar-collapse.in">How it Works</a></li>
                  <li><a href="#flix_main?scrollTo=#about" data-toggle="collapse" data-target=".navbar-collapse.in">About</a></li>
                  <li><a href="#flix_main?scrollTo=#updates" data-toggle="collapse" data-target=".navbar-collapse.in">News</a></li>
                  <li><a href="#flix_main?scrollTo=#screenshots" data-toggle="collapse" data-target=".navbar-collapse.in">Screenshots</a></li>
                  <li><a href="#flix_main?scrollTo=#contact" data-toggle="collapse" data-target=".navbar-collapse.in">Contact</a></li>
                  
                  <hr>
                  <div style="padding-left: 10px;"><font color="white">Follow Us</font></div>
                  <li><a href="http://twitter.com/FlixAcademy" target="_blank" data-toggle="collapse" data-target=".navbar-collapse.in">Twitter</a></li>
                  <li><a href="http://facebook.com/FlixAcademy" target="_blank" data-toggle="collapse" data-target=".navbar-collapse.in">Facebook</a></li>

               </ul>
            </li>
         </ul>
      </div>
   </div>
</header>