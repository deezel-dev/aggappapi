<?php 
    $ROOT = $_SERVER['DOCUMENT_ROOT']; 
?>
<div class="container visible-lg visible-md visible-sm visible-xs" style="margin-top: 10px;" align="center">
    
    <div style="margin: 2px;">&nbsp;</div>

    <div class="row">
       
      <div class="col-lg-3 col-md-3 col-sm-3 col-xs-0">&nbsp;</div>

      <div id="cover_art" class="col-lg-1 col-md-1 col-sm-2 col-xs-4">
            <img ng-show="movie.product_image != null && movie.product_image.length > 0" style="width: 95%; -webkit-box-shadow: 0px 0px 12px 0px rgba(100, 100, 100, 0.45); -moz-box-shadow: 0px 0px 12px 0px rgba(100, 100, 100, 0.45); box-shadow: 0px 0px 12px 0px rgba(100, 100, 100, 0.45);" src="{{movie.product_image}}" />
            <div ng-show="movie.product_image == null || movie.product_image.length == 0" style="width: 95%; -webkit-box-shadow: 0px 0px 12px 0px rgba(100, 100, 100, 0.45); -moz-box-shadow: 0px 0px 12px 0px rgba(100, 100, 100, 0.45); box-shadow: 0px 0px 12px 0px rgba(100, 100, 100, 0.45);">
                <img src="/public/images/FlixAcademyCoverArt.png" style="width: 95%;" />
            </div>
      </div>

      <div id="lesson_info" class="col-lg-5 col-md-5 col-sm-4 col-xs-8" align="left">
        <div class="row"><font color="#AA4444" size="+2"><b>{{movie.title}}</b></font></div>
        <div class="row">{{remix.lesson_name}}</div>
        <div class="row">{{view.name}}</div>
      </div>
      
      <div class="col-lg-3 col-md-3 col-sm-3 col-xs-0">&nbsp;</div>

   </div>

    <div id="layout_content" style="margin-left: 10px; margin-right: 10px;">
        <div id="handout_view" data-ng-show ="{{view.id}}==1"><?php require $ROOT . "/flix/remix_view_handout.html" ?></div>
        <div id="quiz_view"    data-ng-show ="{{view.id}}==2"><?php require $ROOT . "/flix/remix_view_handout.html" ?></div>
        <div id="answer_key"   data-ng-show ="{{view.id}}==3"><?php require $ROOT . "/flix/remix_view_handout.html" ?></div>
    </div>

</div>