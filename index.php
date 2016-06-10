<?php
   $ROOT = "http://" . $_SERVER['HTTP_HOST'];
   require_once ("/include/_init.php");
   
?>
<!DOCTYPE html>
<html data-ng-app="app" lang="en" style="width: 100%;height: 100%;margin: 0px;padding: 0px;overflow-x: hidden;">

       <head>
      <?php require ("/include/layout/main.head.php") ?>
   </head>
    <body data-ng-controller="indexCtrl">        
        <div>INDEX</div>
        <!-- content ui-view -->
        <div style ="margin-top: 40px;" ui-view></div> <!--  autoscroll="true"  -->

        <!-- static navbar - top -->
        <div style="position: fixed; top: 0px;width: 100%;margin: 0px;padding: 0px;">
        <?php require ("/include/layout/main.body-navbar.php") ?>
        </div>

        <!-- load all scripts -->
        <?php require ("/include/layout/main.body-scripts.php") ?>
        <script src="/flix/app.js"></script>

    </body>
</html>