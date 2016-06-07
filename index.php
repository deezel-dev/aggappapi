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
       
       <div><font color="#000">AGG APP API   <?php echo $_SERVER['DOCUMENT_ROOT'] ?> </font></div>
        

    </body>
</html>
