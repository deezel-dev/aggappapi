<?php 
    //$ROOT = "http://" . $_SERVER['HTTP_HOST'];
?>

<html>
   <body> 
        <!-- home -->
        <div id="home" class="container">
            
            <div style="display:inline;">
                <u><b><h3>Farmers Market Directory API</h3></b></u>
                        <input type="text" PLACEHOLDER='Enter Zip Code' ng-model="zip_code"/>
                        <button ng-click="btnSearchZip(zip_code)" class="btn btn-primary btn-xs">Search</button>
                        <br><br>
            </div>
            
            
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">                    
                    <div style="padding-left:20px;">
                        <div id="market_list" ng-repeat="farm_market in markets">
                            <font color="#000">
                                <a data-ng-click="search_market(farm_market)">{{farm_market.id}}</a>: &nbsp;&nbsp; {{farm_market.marketname}} </font> 
                        </div>
                    </div>
                </div>
                
                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6" data-ng-show="market.id>0">                    
                    <div style="padding-left:20px;margin-top:20px;">
                        <div id="market_details">
                            <b><h3>{{market.marketname}}</h3></b>
                            <u><b>Address:</b></u>&nbsp;&nbsp;{{marketdetails.Address}}
                            <br><br><u><b>GoogleLink:</b></u>&nbsp;&nbsp;<a href="{{marketdetails.GoogleLink}}" target="_blank">{{marketdetails.GoogleLink}}</a>
                            <br><br><u><b>Products:</b></u>&nbsp;&nbsp;{{marketdetails.Products}}
                            <br><br><u><b>Schedule:</b></u>&nbsp;&nbsp;{{marketdetails.Schedule}}
                            <br>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
   </body>
</html>