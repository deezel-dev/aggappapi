<?php 
    //$ROOT = "http://" . $_SERVER['HTTP_HOST'];
?>

<html>
   <body> 
        <!-- home -->
        <div id="home" class="container">
            
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <u><b><h3>Weather INfo</h3></b></u>
               </div>
            </div>
            
            <div class="row" align="left">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <input type="text" PLACEHOLDER='Enter Zip Code' ng-model="zip_code"/> &nbsp;&nbsp;
                    <button ng-click="btnSearchZip(zip_code)" class="btn btn-success btn-xs">Search</button>
               </div>                
           </div>
            
            <div class="row" align="center">
                <div class="col-xs-12" data-ng-show="weather_info!=null" align="left" id="weather_info">
                                    
                        <div>City ID:&nbsp;<&nbsp;{{weather_info.city.id}}</div>
                        <div>City name&nbsp;&nbsp;{{weather_info.city.name}}</div>
                        <div>City latitude&nbsp;&nbsp;{{weather_info.city.coord.lat}}</div>
                        <div>City longitude&nbsp;&nbsp;{{weather_info.city.coord.lon}}</div>

                        <div class="row" align="center"> <!-- start row -->
                            <div class="col-xs-12" data-ng-show="weather_info.list>0" ng-repeat="day in weather_info.list">                    
                                <div align="left" id="market_details">
                                        
                                        <div>Time of data forecasted:&nbsp;<&nbsp;{{day.dt}}</div>
                                        <div>Day temperature&nbsp;&nbsp;{{day.temp.day}}</div>
                                        <div>Min&nbsp;&nbsp;{{day.temp.min}}</div>
                                        <div>Max&nbsp;&nbsp;{{day.temp.max}}</div>
                                        
                                        <div>Night&nbsp;&nbsp;{{day.temp.night}}</div>
                                        <div>Evening&nbsp;&nbsp;{{day.temp.eve}}</div>
                                        <div>Morning&nbsp;&nbsp;{{day.temp.morn}}</div>
                                        
                                        <div>Atmospheric pressure&nbsp;&nbsp;{{day.pressure}}</div>
                                        <div>Humidity&nbsp;&nbsp;{{day.humidity}}</div>
                                        <div>Weather&nbsp;&nbsp;{{day.weather}}</div>
                                        
                                        <div>WeatherID&nbsp;&nbsp;{{day.weather.id}}</div>
                                        <div>Group&nbsp;&nbsp;{{day.weather.main}}</div>
                                        <div>Weather condition&nbsp;&nbsp;{{day.weather.description}}</div>
                                        
                                        <div>icon&nbsp;&nbsp;{{day.weather.icon}}</div>
                                        <div>speed&nbsp;&nbsp;{{day.speed}}</div>
                                        <div>deg&nbsp;&nbsp;{{day.deg}}</div>
                                        <div>clouds&nbsp;&nbsp;{{day.clouds}}</div>
            
                                </div>
                            </div>
                            <hr size="3" width="100%" style="border-color:#8fcb67; background:#8fcb67">
                        </div> <!-- end row -->
                    </div>
            </div>
        </div>
   </body>
</html>
