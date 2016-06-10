<?php 
    //$ROOT = "http://" . $_SERVER['HTTP_HOST'];
?>

<html>
   <body> 
        <!-- home -->
        <div id="home" class="container">
            <div  align="center">
                <font color="#000" size ="+3">AGRICULTURE APIS</font>
           </div>
            <div style="padding-left:20px;">
                <u><b><h3>Farmers Market Directory API</h3></b></u>
                <input type="text" PLACEHOLDER='Enter Zip Code' ng-model="zip_code"/>
                <button ng-click="btnSearchZip(zip_code)" class="btn btn-primary btn-xs">Search</button>

                <div id="market_list" ng-repeat="market in markets">
                    <font color="#000">{{market.id}}: &nbsp;&nbsp; {{market.marketname}} </font> 
                </div>
            </div>
        </div>
   </body>
</html>