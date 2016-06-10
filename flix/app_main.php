<?php 
    //$ROOT = "http://" . $_SERVER['HTTP_HOST'];
?>

<html>
   <body> 

        <div data-ng-init="init()"></div>

        <!-- home -->
        <div id="home"><?php require ("/flix/landing_page/01_home.html") ?></div>

        <!-- how  -->
        <div id="how"><?php require ("/flix/landing_page/02_how.html") ?></div>

        <div class="row">
            <!-- about  -->
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <div id="about"><?php require ("/flix/landing_page/03_about.html") ?></div>
            </div>
            <!-- news  -->
            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <div id="updates"><?php require ("/flix/landing_page/04_updates.html") ?></div>
            </div>
        </div>

        <!-- screenshots -->
        <div id="screenshots"><?php require ("/flix/landing_page/05_screenshots.html") ?></div>
            

        <!-- contact -->
        <div id="contact"><?php require ("/flix/flix_main_contact_form.html") ?></div>

   </body>
</html>