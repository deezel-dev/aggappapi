<?php
   require_once $_SERVER['DOCUMENT_ROOT'] . "/include/_init.php";
   require_once $_SERVER['DOCUMENT_ROOT'] . "/include/account/requiresession.php";
   
   $product_id = -1;
   $topic_id = -1;
   $topic_name ="";
   
   if (isset($_GET["product_id"])) {
       $product_id = $_GET["product_id"];
   }
   
   if (isset($_GET["topic_id"])) {
       $topic_id = $_GET["topic_id"];
   }
   
   if (isset($_GET["topic_name"])) {
       $topic_name = $_GET["topic_name"];
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
      <!-- Custom CSS -->
      <link href="/public/css/flix_remix.css" rel="stylesheet">
      <!--
         <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
         -->
   </head>
   <body data-ng-controller="flixRemixCtrl">
      <!--  ng-app="flixAcademy"  -->
      <?php
         require $_SERVER['DOCUMENT_ROOT'] . "/include/layout/main.body-navbar.php";
         ?>
      <div ng-init="init(<?php echo $product_id;?>, <?php echo $profileID;?>, <?php echo $remixID;?>)">
         <div ng-hide="true" ng-model="flix_remix_id"><b><u>FLIX REMIX ID: </u></b>{{flix_remix_id}}</div>
         <div ng-hide="true" ng-model="profile_id"><b><u>PROFILE ID: </u></b>{{profile_id}}</div>
         <div class="container-fluid" style="margin-top: -12px;">
            <div class="row">
               <div ng-show="!isExistingRemix" class="col-lg-4 col-md-4 col-sm-5 col-xs-12" style="padding-left:8px;padding-top: 8px;">
                  <div class="row row-table" style="padding: 20px;margin-top: -21px;height: 100%;width: 100%;background-color: #000;">
                     <!--background-image: url({{coverArt}});-->
                     <div style="margin: -21px;">
                        <div id="grad1" >
                           <div class="row" style="padding-top:21px">
                              <div align="center" class="col-sm-12" style="margin-top: -8px;">
                                 <h4 style="margin-top: 0; padding-top: 0; line-height: 1.0em; color:#ff3030; font-weight: bold;">
                                    {{movieTitle}}
                                 </h4>
                                 <div ng-model="movieRuntime">
                                    <font color="#fff">{{movieRuntime}}&nbsp;minutes&nbsp;&nbsp;|&nbsp;&nbsp;Rating:&nbsp;{{movieRated}}</font>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div style="background-image: url({{coverArt}});background-size: 100%;background-repeat: no-repeat;height: 100%;width: 100%;">
                           <div style="background-color: rgba(0, 0, 0, 0.7);">
                              <div ng-style="{'overflow':'scroll','height':'525px'}">
                              <div class="row" style="padding-left:18px;padding-right:18px;padding-top: 8px;">
                                 <div class="col-sm-12">
                                    <label><font color="#fff" size="+1">LESSON NAME</font></label><br />
                                    <input class="form-control" type="text" PLACEHOLDER='Enter a name for your lesson' ng-model="lessonName">
                                 </div>
                              </div>
                              <div class="row" style="padding-left:18px;padding-right:18px;padding-top: 8px;">
                                 <div class="col-sm-12" ng-init="loadSubjects()">
                                    <label><font color="#fff" size="+1">TOPIC</font></label><br />                               
                                    <!--<select class="form-control" name="selected" ng-model="flixSubject.subject_id" ng-change="">
                                       <option ng-repeat="flixSubject in flixSubjects" value="{{flixSubject.subject_id}}">{{flixSubject.subject_name}}</option>
                                       </select>-->
                                    <select class="form-control" 
                                       ng-change=""
                                       ng-model="selected.flixSubject"                 
                                       ng-options="flixSubject.subject_name for flixSubject in flixSubjects track by flixSubject.subject_id"
                                       ng-init="initTopic(<?php echo $topic_id;?>, '<?php echo $topic_name;?>')">
                                    </select>
                                 </div>
                              </div>
                              <div class="row" style="padding-left:18px;padding-right:18px;padding-top: 8px;">
                                 <!--setSelectedSubjectID(<?php echo $topic_id;?>)-->
                                 <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                                    <label><font color="#fff" size="+1">HOUR</font></label><br />   
                                    <select class="form-control" name="selected" ng-model="timeHR" ng-init="'00'">
                                       <option ng-repeat="hour in hours" value="{{hour}}">{{hour}}</option>
                                    </select>
                                 </div>
                                 <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                                    <label><font color="#fff" size="+1">MINUTE</font></label><br />   
                                    <select class="form-control" name="selected" ng-model="timeMIN" ng-init="'00'">
                                       <option ng-repeat="minute in minutes" value="{{minute}}">{{minute}}</option>
                                    </select>
                                 </div>
                                 <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                                    <label><font color="#fff" size="+1">SECOND</font></label><br /> 
                                    <select class="form-control" name="selected" ng-model="timeSEC" ng-init="'00'">
                                       <option ng-repeat="second in seconds" value="{{second}}">{{second}}</option>
                                    </select>
                                 </div>
                              </div>
                              <br>
                              <div class="row" style="padding-left:18px;padding-right:18px;padding-top: 8px;">
                                 <!-- COMMENTARY VIEW -->
                                 <div ng-show="commentary_type==1">
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                       <div class="col-xs-6 visible-xs-block" style="margin: 10px;"></div>
                                       <button type="button"
                                          class="btn btn-danger btn-block active"
                                          ng-click="commentary_type=1; clearEntryFields()">
                                       COMMENTARY
                                       </button>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                       <div class="col-xs-6 visible-xs-block" style="margin: 10px;"></div>
                                       <button type="button"
                                          class="btn btn-block"
                                           style="background-color: #d4d4d4;"
                                          ng-click="commentary_type=2; clearEntryFields()">
                                       QUIZ
                                       </button>
                                    </div>
                                 </div>
                                 <!-- QUIZ VIEW -->
                                 <div ng-show="commentary_type==2">
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                       <div class="col-xs-6 visible-xs-block" style="margin: 10px;"></div>
                                       <button type="button"
                                          class="btn btn-block"
                                           style="background-color: #d4d4d4"
                                          ng-click="commentary_type=1; clearEntryFields()">
                                       COMMENTARY
                                       </button>
                                    </div>
                                    <div class="col-sm-6 col-xs-6">
                                       <div class="col-lg-6 col-md-6 col-xs-6 visible-xs-block" style="margin: 10px;"></div>
                                       <button type="button"
                                          class="btn btn-danger btn-block active"
                                          ng-click="commentary_type=2; clearEntryFields()">
                                       QUIZ
                                       </button>
                                    </div>
                                 </div>
                              </div>
                              <hr style="margin-top: 0; width: 100%; color: white; height: 1px; background-color:white;" />
                              
                               <div class="row" style="padding-left:18px;padding-right:18px;padding-top: 8px;">
                                 <div ng-show="commentary_type==1" class="col-sm-12">
                                    <label><font color="#fff" size="+1">COMMENTARY</font></label><br />
                                    <input class="form-control" NAME="" TYPE=TEXT PLACEHOLDER='Enter commentary to play at this point in the Flix' ng-model="commentary">
                                 </div>
                                  <div ng-show="commentary_type==2" class="col-sm-12">
                                    <label><font color="#fff" size="+1">QUIZ QUESTION</font></label><br />
                                    <input class="form-control" NAME="" TYPE=TEXT PLACEHOLDER='Example: Where did Lincoln give his speech?' ng-model="commentary">
                                 </div>
                              </div>
                               
                              
                              <div ng-show="commentary_type==1" >
                                 <div class="row" style="padding-left:18px;padding-right:18px;padding-top: 8px;">
                                    <div class="col-sm-12">
                                       <label><font color="#fff" size="+1">LINK (OPTIONAL)</font></label><br />
                                       <input class="form-control" type="text" PLACEHOLDER='Link to additional content e.g. http://...' VALUE="" ng-model="link">
                                    </div>
                                 </div>
                                 <div class="row" style="padding-left:18px;padding-right:18px;padding-top: 8px;">
                                    <div class="col-sm-12">
                                       <label><font color="#fff" size="+1">IMAGE (OPTIONAL)</font></label><br />
                                       <input class="form-control" type="text" PLACEHOLDER='Link to photo/image e.g. http://...' VALUE="" ng-model="image">
                                    </div>
                                 </div>
                              </div>
                              <!--  QUIZ SECTION  -->
                              <div ng-show="commentary_type==2" class="row-table" style="height: 100%;width: 100%;padding-bottom: 20px;">
                                 <div class="row" style="padding-left:18px;padding-right:18px;padding-top: 8px;">
                                    <div class="col-sm-12">
                                       <label><font color="#fff" size="+1">OPTION 1 (CORRECT ANSWER)</font></label><br />
                                       <input class="form-control" type="text" PLACEHOLDER='Gettysburg, PA' ng-model="option_1">
                                    </div>
                                 </div>
                                 <div class="row" style="padding-left:18px;padding-right:18px;padding-top: 8px;">
                                    <div class="col-sm-12">
                                       <label><font color="#fff" size="+1">OPTION 2 (WRONG ANSWER #1)</font></label><br />
                                       <input class="form-control" type="text" PLACEHOLDER='Pittsburgh, PA' ng-model="option_2">
                                    </div>
                                 </div>
                                 <div class="row" style="padding-left:18px;padding-right:18px;padding-top: 8px;">
                                    <div class="col-sm-12">
                                       <label><font color="#fff" size="+1">OPTION 3 (WRONG ANSWER #2)</font></label><br />
                                       <input class="form-control" type="text" PLACEHOLDER='Springfield, IL' ng-model="option_3">
                                    </div>
                                 </div>
                                 <div class="row" style="padding-left:18px;padding-right:18px;padding-top: 8px;">
                                    <div class="col-sm-12">
                                       <label><font color="#fff" size="+1">OPTION 4 (WRONG ANSWER #3)</font></label><br />
                                       <input class="form-control" type="text" PLACEHOLDER='Lincoln, NE' ng-model="option_4">
                                    </div>
                                 </div>
                              </div>

                               </div>

                              <div class="row-table" style="background-color:#000;height: 100%;width: 100%;padding-bottom: 5px;">
                                 <div class="row" style="padding:18px;">
                                    <div class="col-sm-6 col-xs-6">
                                       <div class="col-xs-6 visible-xs-block" style="margin: 10px;"></div>
                                       <button type="button"
                                          class="btn btn-danger btn-block"
                                          ng-hide="{{hideButtons}}" 
                                          ng-click="saveRemix()"
                                          id="btnSaveRemix">
                                       Save & Exit
                                       </button>
                                    </div>
                                    <div class="col-sm-6 col-xs-6">
                                       <div class="col-xs-6 visible-xs-block" style="margin: 10px;"></div>
                                       <button type="button"
                                          class="btn btn-danger btn-block"
                                          ng-hide="{{hideButtons}}" 
                                          ng-click="addMore()"
                                          id="btnAddMore">
                                       + Add More
                                       </button>
                                    </div>
                                    <div ng-hide="1" class="col-sm-6 col-xs-6">
                                       <div class="col-xs-6 visible-xs-block" style="margin: 10px;"></div>
                                       <button type="button"
                                          class="btn btn-danger btn-block"
                                          ng-hide="0" 
                                          ng-click="printIt()"
                                          id="btnPrint">
                                       PRINT
                                       </button>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               <div ng-class="getColumnWidth()">
                  <div class="" style="padding: 15px;margin-top: -21px;width: 100%;height: 100%;">
                     <h2 ng-show="!isExistingRemix" align="center"><B><FONT SIZE=+2 COLOR=RED FACE='Rockwell,Courier,Verdana'>FlixREMIX by FlixAcademy Interactive Lesson Plans!</FONT></B></h2>
                     <div ng-show="isExistingRemix" >
                        <div id="grad1">
                           <div class="row" style="padding-left:18px;padding-right:18px;padding-top: 1px;">
                              <div vertical-align="bottom" class="col-sm-5" style="padding: 5px;padding-bottom: 0px;margin-bottom: 0px;">
                                 <B><FONT SIZE=+1 COLOR=WHITE FACE='Rockwell,Courier,Verdana'>                            
                                 &nbsp;<font color="red"><u>MOVIE:</u></font>&nbsp;{{movieTitle}}
                                 <br>
                                 &nbsp;<font color="red"><u>RUNTIME:</u></font>&nbsp;{{movieRuntime}}&nbsp;minutes
                                 <br>
                                 &nbsp;<font color="red"><u>LESSON:</u></font>&nbsp;{{lessonName}}                           
                                 </FONT></B>
                              </div>
                              <div class="col-sm-2">
                              </div>
                              <div class="col-sm-5">
                                 <h2 style="margin-top: 0px;margin-bottom: -1px;padding-right: 30px;" vertical-align="top" align="right"><B><FONT SIZE=+2 COLOR=red FACE='Rockwell,Courier,Verdana'>FlixREMIX by</FONT></B></h2>
                                 <img align="right" style="margin-top: 0px;padding-bottom: 8px;height: 90%;" src="/public/images/flix-logo.png" alt="FlixAcademy" />
                              </div>
                           </div>
                        </div>
                     </div>
                     <div ng-show="!isExistingRemix" class="" style="background-color:#000">
                        <div class="row">
                           <div ng-hide="1" class="col-lg-1 col-md-1 col-sm-1 col-xs-1" align="center">
                              <u><b><label><font color="#000">ID</font></label></b></u>
                           </div>
                           <div ng-hide="1" class="col-lg-2 col-md-1 col-sm-1 col-xs-1" align="center">
                              <u><b><label><font color="#000">&nbsp;TIME</font></label></b></u>
                           </div>
                           <div ng-hide="0" class="col-lg-1 col-md-2 col-sm-2 col-xs-3" align="center">
                              <u><b><label><font color="#000">EDIT</font></label></b></u>
                           </div>
                           <div class="col-lg-5 col-md-5 col-sm-5 col-xs-4" align="center">
                              <u><b><label><font color="#000">TIME | COMMENTARY</font></label></b></u>
                           </div>
                           <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2" align="center">
                              <u><b><label><font color="#000">LINK</font></label></b></u>
                           </div>
                           <div class="col-lg-4 col-md-3 col-sm-3 col-xs-3" align="center">
                              <u><b><label><font color="#000">IMAGE</font></label></b></u>
                           </div>
                        </div>
                     </div>
                     <div style="overflow:scroll; height:600px;">

                         <div vertical-align="center" align ="left" ng-show="remixEntries==null || remixEntries.length<1">
                         <br><br><br>
                                    <font color="red" size="+5"><b><u>TIPS</u></b></font><br><br>
                                <font color="red" size="+3">1) Keep Notes short, like a Tweet... one or two sentences. <br><br>
                                2) Leave at least 20 seconds between consecutive Notes and one minute after a Quiz so viewers have time to answer. </font>
             
                         
                         </div>

                        <div ng-repeat="remixEntry in remixEntries | orderBy:'time'" value="{{remixEntry.seq_id}}">
                           <div ng-hide="{{hideButtons}}" class="col-lg-1 col-md-2 col-sm-2 col-xs-3" align="center">
                              <br> <img ng-hide="{{hideButtons}}" ng-click="editEntry(remixEntry)"src="/public/images/btn_edit_icon.png" width="20" height="20" align="middle"/>
                              <br><br><br>
                              <img ng-hide="{{hideButtons}}" ng-click="deleteEntry(remixEntry)"src="/public/images/btn_delete_icon.png" width="20" height="20" align="middle"/> 
                           </div>
                           <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4" align="left">
                              <br> {{remixEntry.time}} <br> <br> {{remixEntry.commentary}}
                           </div>
                           <!-- COMMENTARY -->
                           <div ng-show="{{remixEntry.commentary_type}}==1" class="row" style="padding: 2px;">
                              <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2" align="center">
                                 <br> <a href="{{remixEntry.link}}" target="blank">link</a>
                              </div>
                              <div class="col-lg-4 col-md-3 col-sm-3 col-xs-3" align="center">
                                 <br> 
                                 <a href="{{remixEntry.image}}" target="_blank"> 
                                 <img align="center" width="80%" height="80%" ng-src="{{remixEntry.image}}"/> 
                                 </a>
                              </div>
                           </div>
                           <!-- QUIZ -->
                           <div ng-show="{{remixEntry.commentary_type}}==2" class="row" style="padding: 2px;">
                              <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3" align="center">
                                 <br> {{remixEntry.option_1}} <br> <br> {{remixEntry.option_2}}
                              </div>
                              <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3" align="center">
                                 <br> {{remixEntry.option_3}} <br> <br> {{remixEntry.option_4}}
                              </div>
                           </div>
                           <HR COLOR="black" SIZE="2">
                        </div>
                     </div>
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