<?php
   require_once $_SERVER['DOCUMENT_ROOT'] . "/include/_init.php";
   $ROOT = $_SERVER['DOCUMENT_ROOT'];

   $profileID = -1;
   $isUser = FALSE;
   $rootPath = $_SERVER['DOCUMENT_ROOT'];
   
   if (isset($_SESSION[SESSION_PROFILE_ID])) {
       $profileID = $_SESSION[SESSION_PROFILE_ID];
       $isUser = TRUE;
   }

   
   ?>
<!DOCTYPE html>
<html data-ng-app="app" lang="en" style="width: 100%;height: 100%;margin: 0px;padding: 0px;overflow-x: hidden;">
   <head>
      <?php require $_SERVER['DOCUMENT_ROOT'] . "/include/layout/main.head.php" ?>
   </head>
    <body data-ng-controller="indexCtrl" data-ng-init="setProfileData(<?php echo($profileID) ?>)">        
       
       <div>AGG APP API</div>
        <!-- content ui-view -->
        <div style ="margin-top: 40px;" ui-view></div> <!--  autoscroll="true"  -->
       
        <hr>
        <!-- welcome -->
        <div><?php require $ROOT . "/flix/flix_main_welcome_message.html" ?></div>
   
        <!-- main logo -->
        <div><?php require $ROOT . "/flix/flix_main_logo.html" ?></div>
   
        <!-- footer -->
        <div><?php require $ROOT . "/flix/flix_main_footer.html" ?></div>

        <!-- static navbar - top -->
        <div style="position: fixed; top: 0px;width: 100%;margin: 0px;padding: 0px;">
        <?php require $_SERVER['DOCUMENT_ROOT'] . "/include/layout/main.body-navbar.php" ?>
        </div>

        <!-- load all scripts -->
        <?php require $_SERVER['DOCUMENT_ROOT'] . "/include/layout/main.body-scripts.php" ?>
        <script src="/flix/app.js"></script>

    </body>
</html>
