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
                                    
                        <div><b><u>City ID:</u></b>&nbsp;&nbsp;{{weather_info.city.id}}</div>
                        <div><b><u>City name:</u></b>&nbsp;&nbsp;{{weather_info.city.name}}</div>
                        <div><b><u>City latitude:</u></b>&nbsp;&nbsp;{{weather_info.city.coord.lat}}</div>
                        <div><b><u>City longitude:</u></b>&nbsp;&nbsp;{{weather_info.city.coord.lon}}</div>

                        <div class="row" align="center"> <!-- start row -->
                            <div class="col-xs-12" data-ng-show="1" ng-repeat="day in weather_info.list">                    
                                <div align="left" id="market_details">
                                        
                                        <div>Time:&nbsp;&nbsp;{{day.dt}}</div>
                                        <div>Date:&nbsp;&nbsp;{{day.dt_txt}}</div>
                                        <div>Temp:&nbsp;&nbsp;{{day.main.temp}}</div>
                                        <div>Min:&nbsp;&nbsp;{{day.main.temp_min}}</div>
                                        <div>Max:&nbsp;&nbsp;{{day.main.temp_max}}</div>
                                        
                                        
                                        <div>Pressure:&nbsp;&nbsp;{{day.main.pressure}}</div>
                                        <div>Sea Level&nbsp;&nbsp;{{day.main.sea_level}}</div>
                                        <div>Ground Level&nbsp;&nbsp;{{day.main.grnd_level}}</div>
                                        <div>Humidity&nbsp;&nbsp;{{day.main.humidity}}</div>
                                        <div>temp_kf&nbsp;&nbsp;{{day.main.temp_kf}}</div>
                                        
                                        <!-- 
                                            <div>Night&nbsp;&nbsp;{{day.temp.night}}</div>
                                            <div>Evening&nbsp;&nbsp;{{day.temp.eve}}</div>
                                            <div>Morning&nbsp;&nbsp;{{day.temp.morn}}</div>
                                        -->
                                        
                                                                                
                                        "rain":{},
                                        
                                        <div>&nbsp;&nbsp;Weather</div>                                    
                                        <div>{{day.weather.main}}</div>
                                        <div>{{day.weather.description}}</div>                                        
                                        <div>icon&nbsp;&nbsp;{{day.weather.icon}}</div>
                                        
                                        
                                        <div>&nbsp;&nbsp;Wind</div>                                    
                                        <div>Speed:&nbsp;&nbsp;{{day.wind.speed}}</div>                                    
                                        <div>deg:&nbsp;&nbsp;{{day.wind.deg}}</div>
                                        
                                        
                                        <div>&nbsp;&nbsp;Rain</div>                                    
                                        <div>Speed:&nbsp;&nbsp;{{day.rain}}</div>
            
                                </div>
                            </div>
                            <hr size="3" width="100%" style="border-color:#8fcb67; background:#8fcb67">
                        </div> <!-- end row -->
                    </div>
            </div>
        </div>
   </body>
</html>
