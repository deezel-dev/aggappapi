<?php 
    //$ROOT = "http://" . $_SERVER['HTTP_HOST']; 
?>

<header class="navbar navbar-default navbar-static-top" style="color: #8fcb67; background-color: #262626">
   
   <div class="container-fluid">
      <div class="navbar-header">

         <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" 
             data-target="#navbar" aria-expanded="false" aria-controls="navbar">
             <span class="icon-bar"></span>
             <span class="icon-bar"></span>
             <span class="icon-bar"></span>
         </button>

         <a class="navbar-brand" ui-sref="flix_main({mode: 1})"><img style="height: 200%;" src="/public/images/logo.png" alt="deezel" /></a>

          <!-- nav search_bar -->
          <div style="display: inline-block">
               <div style="margin-top:15px;"><font style="color: #8fcb67;" size="+2">AGG DATA</font></div>
          </div>

      </div>

      <div id="navbar" class="navbar-collapse collapse">
         <ul class="nav navbar-nav navbar-left">
                  
            <li><a ui-sref="farmers_market()" style="color: #fff;">Farmers Markets</a></li>
            <li><a ui-sref="weather_info()" style="color: #fff;">Weather</a></li>
            
         </ul>
      </div>
   </div>
</header>
