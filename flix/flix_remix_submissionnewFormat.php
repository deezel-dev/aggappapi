<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/include/_init.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/include/account/requiresession.php";

$product_id = -1;
$topic_id = -1;

if (isset($_GET["product_id"])) {
    $product_id = $_GET["product_id"];
}

if (isset($_GET["topic_id"])) {
    $topic_id = $_GET["topic_id"];
}

$profileID = -1;
$isUser    = FALSE;

if (isset($_SESSION[SESSION_PROFILE_ID])) {
    $profileID = $_SESSION[SESSION_PROFILE_ID];
    $isUser    = TRUE;
}

$remixID = -1;
$isRemix = FALSE;

if (isset($_GET["remix_id"])) {
    $remixID = $_GET["remix_id"];
    $isRemix = TRUE;
}


?>

<!DOCTYPE html>

<html data-ng-app="app">
    <!-- <html data-ng-app="/public/js/app"> -->
    <head>
        <?php
require $_SERVER['DOCUMENT_ROOT'] . "/include/layout/main.head.php";
?>
        
        <script src="//ajax.googleapis.com/ajax/libs/angularjs/1.4.3/angular.js"></script>
        <script src="//ajax.googleapis.com/ajax/libs/angularjs/1.4.3/angular-animate.js"></script>
        <script src="//angular-ui.github.io/bootstrap/ui-bootstrap-tpls-0.13.3.js"></script>
        <!-- Angular -->  
        <script src="//ajax.googleapis.com/ajax/libs/angularjs/1.2.4/angular.min.js"></script>  
        <!-- UI-Router -->  
        <script src="//angular-ui.github.io/ui-router/release/angular-ui-router.js"></script>  
        <script src="app.js"></script>  
    </head>
    <body> <!--  ng-app="flixAcademy"  -->
        <?php
require $_SERVER['DOCUMENT_ROOT'] . "/include/layout/main.body-navbar.php";
?>
        
        <div data-ng-controller="flixRemixCtrl" ng-init="init(<?php echo $product_id;?>, <?php echo $profileID;?>, <?php echo $remixID;?>)">

               <div ng-hide="true" ng-model="flix_remix_id"><b><u>FLIX REMIX ID: </u></b>{{flix_remix_id}}</div>
               <div ng-hide="true" ng-model="profile_id"><b><u>PROFILE ID: </u></b>{{profile_id}}</div>

            <div class="container-fluid" style="margin-top: -12px;">

                <!--
        <div class="panel-heading">
            <div>
                  <img style="width:100px;height:125px;padding:5px;" data-ng-src="{{coverArt}}" style="background-color:gray;">
                    <h2 style="margin-top: 0; padding-top: 0; line-height: 1.0em; color: #AA4444; font-weight: bold;">
                     {{movieTitle}}
                  </h3>
                  <div ng-model="movieRuntime">
                     {{movieRuntime}}&nbsp;minutes&nbsp;&nbsp;|&nbsp;&nbsp;Rating:&nbsp;{{movieRated}}</span>
                    </div>
                </div>
        </div>-->
        <div class="row">
            <div class="col-lg-3 col-md-3 col-sm-3" style="padding-left:8px;padding-top: 8px;">
                <div class="row row-table" style="padding: 20px;background-image: url({{coverArt}});background-size:cover;background-repeat: no-repeat;margin-top: -21px;">
                 <!--background-image: url({{coverArt}});-->
             <div style="margin: -5px;background-color: rgba(0, 0, 0, 0.67);margin: -21px;">
                <div class="row" style="padding:21px">
                  <div align="center" class="col-sm-12" style="margin-top: -8px;">
                  <!--<img style="width:100px;height:125px;padding:5px;" data-ng-src="{{coverArt}}" style="background-color:gray;">
                    -->
                      <h3 style="margin-top: 0; padding-top: 0; line-height: 1.0em; color: #AA4444; font-weight: bold;">
                     {{movieTitle}}
                  </h3>
                  <div ng-model="movieRuntime">
                     <font color="#fff">{{movieRuntime}}&nbsp;minutes&nbsp;&nbsp;|&nbsp;&nbsp;Rating:&nbsp;{{movieRated}}</font>
                    </div>
                </div>
                </div>
                    <HR COLOR="lightgray">
                <div class="row" style="padding-left:18px;padding-right:18px">
                  <div class="col-sm-12">
                        <label><font color="#fff">Lesson Name</font></label><br />
                        <input class="form-control" type="text" PLACEHOLDER='Enter a name for your lesson' ng-model="lessonName">
                    </div>
                </div>
                <div class="row" style="padding-left:18px;padding-right:18px">                  
                    <div class="col-sm-12" ng-init="loadSubjects()">
                        <label><font color="#fff">Topic</font></label><br />                               
                        <select class="form-control" name="selected" ng-model="selectedSubjectID" ng-change="">
                            <option ng-repeat="flixSubject in flixSubjects" value="{{flixSubject.subject_id}}">{{flixSubject.subject_name}}</option>
                        </select>
                    </div>
                </div>
                <div class="row" style="padding-left:18px;padding-right:18px" ng-init="setSelectedSubjectID(<?php echo $topic_id;?>)">
                  <div class="col-sm-4">
                        <label><font color="#fff">Hour</font></label><br />   
                        <select class="form-control" name="selected" ng-model="timeHR" ng-init="'00'">
                            <option ng-repeat="hour in hours" value="{{hour}}">{{hour}}</option>
                        </select>
                    </div>

                    <div class="col-sm-4">
                        <label><font color="#fff">Minute</font></label><br />   
                        <select class="form-control" name="selected" ng-model="timeMIN" ng-init="'00'">
                            <option ng-repeat="minute in minutes" value="{{minute}}">{{minute}}</option>
                        </select>
                    </div>

                    <div class="col-sm-4">
                        <label><font color="#fff">Second</font></label><br /> 
                        <select class="form-control" name="selected" ng-model="timeSEC" ng-init="'00'">
                            <option ng-repeat="second in seconds" value="{{second}}">{{second}}</option>
                        </select>
                    </div>
                </div>

                
                <div class="row" style="padding-left:18px;padding-right:18px">
                  <div class="col-sm-12">
                        <label><font color="#fff">Notes</font></label><br />
                        <TEXTAREA class="form-control" NAME="notes0" TYPE=TEXT ROWS=4 COLS=38 PLACEHOLDER='Enter commentary to play at this point in the Flix' ng-model="notes"></TEXTAREA>
                   </div>
                </div>
                
                <div class="row" style="padding-left:18px;padding-right:18px">
                  <div class="col-sm-12">
                        <label><b><u><FONT color="#fff">OPTIONAL LINK/IMAGE</FONT></u></b></label>
                    </div>
                </div>
                
                <div class="row" style="padding-left:18px;padding-right:18px">
                    <div class="col-sm-12">
                        <label><font color="#fff">Link</font></label><br />
                        <input class="form-control" type="text" PLACEHOLDER='Link to additional content e.g. http://...' VALUE="" ng-model="link">
                    </div>
                </div>
                    
                <div class="row" style="padding-left:18px;padding-right:18px">
                    <div class="col-sm-12">
                        <label><font color="#fff">Image</font></label><br />
                        <input class="form-control" type="text" PLACEHOLDER='Link to photo/image e.g. http://...' VALUE="" ng-model="image">
                    </div>
                </div>
                
                 <br>
                <div class="row" style="padding-left:18px;padding-right:18px">
                    
                  <div class="col-sm-6 td-bottom">
                      <div class="col-xs-6 visible-xs-block" style="margin-top: 10px;"></div>
                        <button type="button"
                        class="btn btn-danger btn-block"
                        ng-hide="{{hideButtons}}" 
                        ng-click="saveRemix()"
                        id="btnSaveRemix">
                        Save & Exit
                        </button>
                  </div>
                  <div class="col-sm-6 td-bottom">
                    <div class="col-xs-6 visible-xs-block" style="margin-top: 10px;"></div>
                        <button type="button"
                        class="btn btn-danger btn-block"
                        ng-hide="{{hideButtons}}" 
                        ng-click="addMore()"
                        id="btnAddMore">
                        + Add More
                        </button>
                  </div>
                    <br>
                </div>
                    </div>
            </div>
            </div>
            <div class="col-lg-9 col-md-9 col-sm-9">
                <div class="row row-table" style="padding: 20px;margin-top: -21px;">
                 
                 
                 <h2 align="center"><B><FONT SIZE=+2 COLOR=RED FACE='Rockwell,Courier,Verdana'>FlixREMIX by FlixAcademy Interactive Lesson Plans!</FONT></B></h2>
               
                        <Table WIDTH=100% ALIGN=CENTER BORDER=0 CELLPADDING=5>
               <col width="5%">
               <col width="10%">
               <col width="35%">
               <col width="10%">
               <col width="30%">
               <col width="10%">
               <thead align="center">
                  <TR VALIGN=CENTER BGCOLOR=black>
                     <TH style="text-align:center"><font color="white">ID</font></TH>
                     <TH style="text-align:center"><font color="white">TIME</font></TH>
                     <TH style="text-align:center"><font color="white">COMMENTARY</font></TH>
                     <TH style="text-align:center"><font color="white">LINK</font></TH>
                     <TH style="text-align:center"><font color="white">IMAGE</font></TH>
                     <TH style="text-align:center"><font color="white">EDIT</font></TH>
                  </TR>
               </thead>
               <TR VALIGN=CENTER ng-repeat="remixEntry in remixEntries" value="{{remixEntry.seq_id}}">
                  <TD valign="center" align="center">{{remixEntry.seq_id}}</TD>
                  <TD valign="center" align="center">{{remixEntry.time}}</TD>
                  <TD valign="center" align="center">{{remixEntry.notes}}</TD>
                  <TD valign="center" align="center"><a href="{{remixEntry.link}}" target="blank">link</a></TD>
                  <TD VALIGN="center" ALIGN="center"> 
                     <a href="{{remixEntry.image}}" target="_blank"> 
                     <img align="center" width="100" height="100" ng-src="{{remixEntry.image}}"/> 
                     </a> 
                  </TD>
                  <TD ng-hide="{{hideButtons}}" VALIGN="center" ALIGN="center"> 
                     <a ng-hide="{{hideButtons}}" ng-click="editEntry(remixEntry)"><img src="/public/images/btn_edit_icon.png" width="35" height="35"/></a>&nbsp;&nbsp; 
                     <a ng-hide="{{hideButtons}}" ng-click="deleteEntry(remixEntry)"><img src="/public/images/btn_delete_icon.png" width="35" height="35"/></a> 
                  </TD>
               </TR>
            </Table>
                    
            </div>
        </div>
    </div>
    </div>
        </div>
       <?php
require $_SERVER['DOCUMENT_ROOT'] . "/include/layout/main.body-scripts.php";
?>
   </body>
</html>