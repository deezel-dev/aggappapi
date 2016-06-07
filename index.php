<?php
   $ROOT = "http://" . $_SERVER['HTTP_HOST'];
   require_once $ROOT . "/include/_init.php";
   
?>

<!DOCTYPE html>
<html data-ng-app="app" lang="en" style="width: 100%;height: 100%;margin: 0px;padding: 0px;overflow-x: hidden;">
   <head>
      <?php //require $ROOT . "/include/layout/main.head.php" ?>
   </head>
    <body data-ng-controller="indexCtrl">        
       
       <div><font color="#000"></font>AGG APP API   <?php echo $ROOT ?></div>
        
        <!-- 
        <div style ="margin-top: 40px;" ui-view></div> 

        
        <div style="position: fixed; top: 0px;width: 100%;margin: 0px;padding: 0px;">
        <?php require $//ROOT . "/include/layout/main.body-navbar.php" ?>
        </div>

        
        <?php require //$ROOT . "/include/layout/main.body-scripts.php" ?>
        -->
        <script src="/flix/app.js"></script>

    </body>
</html>
