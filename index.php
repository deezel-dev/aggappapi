<?php


   $ROOT = "http://" . $_SERVER['HTTP_HOST'];
   echo $ROOT;

   require_once $ROOT . "/include/_init.php";

   $profileID = -1;
   $isUser = FALSE;
   $rootPath = $ROOT;
   
   if (isset($_SESSION[SESSION_PROFILE_ID])) {
       $profileID = $_SESSION[SESSION_PROFILE_ID];
       $isUser = TRUE;
   }

   
   ?>
<!DOCTYPE html>
<html data-ng-app="app" lang="en" style="width: 100%;height: 100%;margin: 0px;padding: 0px;overflow-x: hidden;">
   <head>
      <?php require $ROOT . "/include/layout/main.head.php" ?>
   </head>
    <body data-ng-controller="indexCtrl" data-ng-init="setProfileData(<?php echo($profileID) ?>)">        
       
       <div><font color="#000"></font>AGG APP API   <?php echo $ROOT ?></div>
        <!-- content ui-view -->
        <div style ="margin-top: 40px;" ui-view></div> <!--  autoscroll="true"  -->

        <!-- static navbar - top -->
        <div style="position: fixed; top: 0px;width: 100%;margin: 0px;padding: 0px;">
        <?php require $ROOT . "/include/layout/main.body-navbar.php" ?>
        </div>

        <!-- load all scripts -->
        <?php require $ROOT . "/include/layout/main.body-scripts.php" ?>
        <script src="/flix/app.js"></script>

    </body>
</html>
