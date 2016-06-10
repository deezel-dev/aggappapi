<?php 
    //$ROOT = "http://" . $_SERVER['HTTP_HOST']; 
?>

<header class="navbar navbar-default navbar-static-top" style="color: #73be41; background-color: #262626">
   
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
               <div style="margin:5px;">DEEZEL DATA</div>
          </div>

      </div>

      <div id="navbar" class="navbar-collapse collapse">
         <ul class="nav navbar-nav navbar-left">

            <li class="dropdown" style="color: #73be41;">
               <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Navigation<span class="caret"></span></a>
               <ul class="dropdown-menu" role="menu">
                  
               </ul>
            </li>
         </ul>
      </div>
   </div>
</header>