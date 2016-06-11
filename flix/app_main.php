<?php 
    //$ROOT = "http://" . $_SERVER['HTTP_HOST'];
?>

<html>
   <body> 
        <!-- home -->
        <div id="home" class="container">
            
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <u><b><h3>Farmers Market Directory</h3></b></u>
               </div>
            </div>
            
            <div class="row" align="left">
                <input type="text" PLACEHOLDER='Enter Zip Code' ng-model="zip_code"/> &nbsp;&nbsp;
                <button ng-click="btnSearchZip(zip_code)" class="btn btn-success btn-xs">Search</button>
           </div>
            
           <div class="row" align="center">
             <div class="col-xs-12" data-ng-show="markets.length>0" ng-repeat="market in markets">                    
                        <div align="left">
                            <div id="market_details">
                                <h3><b>{{market.marketname}}</b></h3>
                                <u><b>Address:</b></u>&nbsp;&nbsp;{{market.marketdetails.Address}}
                                <br><br><u><b>GoogleLink:</b></u>&nbsp;&nbsp;<a href="{{market.marketdetails.GoogleLink}}" target="_blank">GOOGLE</a>
                                <br><br><u><b>Products:</b></u>&nbsp;&nbsp;{{market.marketdetails.Products}}
                                <br><br><u><b>Schedule:</b></u>&nbsp;&nbsp;{{market.marketdetails.Schedule}}
                                <br>
                            </div>
                        </div>
                        <hr size="3" width="100%" style="border-color: #8fcb67; background:#8fcb67">
                    </div>
                
           </div>
            
            <!-- 
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
                    <div style="padding-left:20px;margin-top:10px;">
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
            -->
        </div>
   </body>
</html>
