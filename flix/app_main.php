<?php 
    //$ROOT = "http://" . $_SERVER['HTTP_HOST'];
?>

<html>
   <body> 

        <!-- home -->
        <div id="home">
            <div class="container" align="center"><font color="#000" size ="+6">HOME PAGE</font></div>
        </div>
        
       <div id="market_list" ng-repeat="market in markets">
            <div class="container" align="center">
                <font color="#000">market.id &nbsp;marketname </font>
            </div>                
      </div>

   </body>
</html>