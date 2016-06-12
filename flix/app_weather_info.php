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
                        
                        <hr size="3" width="100%" style="border-color:#8fcb67; background:#8fcb67">

                        <div class="row" align="center"> <!-- start row -->
                            <div class="col-xs-12" data-ng-show="1" ng-repeat="day in weather_info.list">                    
                                <div align="left" id="market_details">
                                        
                                        {{day.dt_txt}}                                        
                                        <br>
                                        <div>&nbsp;&nbsp;<b><u>Temperature</u></b></div> 
                                        <div>&nbsp;&nbsp;&nbsp;&nbsp;Temp:&nbsp;&nbsp;{{day.main.temp}}</div>
                                        <div>&nbsp;&nbsp;&nbsp;&nbsp;Min:&nbsp;&nbsp;{{day.main.temp_min}}</div>
                                        <div>&nbsp;&nbsp;&nbsp;&nbsp;Max:&nbsp;&nbsp;{{day.main.temp_max}}</div>
                                        <div>&nbsp;&nbsp;&nbsp;&nbsp;Pressure:&nbsp;&nbsp;{{day.main.pressure}}</div>
                                        <div>&nbsp;&nbsp;&nbsp;&nbsp;Sea Level:&nbsp;&nbsp;{{day.main.sea_level}}</div>
                                        <div>&nbsp;&nbsp;&nbsp;&nbsp;Ground Level:&nbsp;&nbsp;{{day.main.grnd_level}}</div>
                                        <div>&nbsp;&nbsp;&nbsp;&nbsp;Humidity:&nbsp;&nbsp;{{day.main.humidity}}</div>
                                        <div>&nbsp;&nbsp;&nbsp;&nbsp;temp_kf:&nbsp;&nbsp;{{day.main.temp_kf}}</div>                                        
                                        
                                        <br><br>
                                        <div>&nbsp;&nbsp;<b><u>Weather</u></b></div>                                    
                                        <div>&nbsp;&nbsp;&nbsp;&nbsp;main:&nbsp;&nbsp;{{day.weather.main}}</div>
                                        <div>&nbsp;&nbsp;&nbsp;&nbsp;description:&nbsp;&nbsp;{{day.weather.description}}</div>                                          
                                                                                
                                        <br><br>
                                        <div>&nbsp;&nbsp;<b><u>Wind</u></b></div>                                   
                                        <div>&nbsp;&nbsp;&nbsp;&nbsp;Speed:&nbsp;&nbsp;{{day.wind.speed}}</div>                                    
                                        <div>&nbsp;&nbsp;&nbsp;&nbsp;Deg:&nbsp;&nbsp;{{day.wind.deg}}</div>
                                                                                
                                        <br><br>
                                        <div>&nbsp;&nbsp;<b><u>Rain</u></b></div>                             
                                        <div>&nbsp;&nbsp;&nbsp;&nbsp;Speed:&nbsp;&nbsp;{{day.rain}}</div>
                                        
                                        <br>                                        
                                        <hr size="3" width="100%" style="border-color:#8fcb67; background:#8fcb67">
                                        
                                        <!-- 
                                            
                                        <div>&nbsp;&nbsp;Time:&nbsp;&nbsp;{{day.dt}}</div>
                                        <div>&nbsp;&nbsp;Date:&nbsp;&nbsp;{{day.dt_txt}}</div>
                                        
                                            <div>Night&nbsp;&nbsp;{{day.temp.night}}</div>
                                            <div>Evening&nbsp;&nbsp;{{day.temp.eve}}</div>
                                            <div>Morning&nbsp;&nbsp;{{day.temp.morn}}</div>
                                        -->
            
                                </div>
                            </div>
                        </div> <!-- end row -->
                    </div>
            </div>
        </div>
   </body>
</html>
