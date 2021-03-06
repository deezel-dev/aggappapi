
<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/include/_init.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/include/flix/search.php";
?>

<!DOCTYPE html>

<html data-ng-app="app" lang="en">
    <head>
        <?php require $_SERVER['DOCUMENT_ROOT'] . "/include/layout/main.head.php" ?> 
      <!-- Angular -->  
      <script src="//ajax.googleapis.com/ajax/libs/angularjs/1.2.4/angular.min.js"></script>  
      <!-- UI-Router -->  
      <script src="//angular-ui.github.io/ui-router/release/angular-ui-router.js"></script>  
      <script src="app.js"></script>  
    </head>
    <body>
        <?php require $_SERVER['DOCUMENT_ROOT'] . "/include/layout/main.body-navbar.php" ?>        
        <div class="container" data-ng-controller="flixSubmissionCntrl">
            <form style="width:100%;">
                <div class="row">
                    <div class="col-xs-12">
                        <h3><b>Submit a Flix</b></h3>
                        <small><b>Please enter the NAME and/or LINK of a Movie/Video, and optionally one or more TOPICS</b></small>
                    </div>
                </div>

                <!-- DESKTOP TABLET VIEW  -->
                <div class="visible-md-block visible-lg-block" style="width:80%">

                    <br>
                    <table width="90%">
                        <col width="50%">
                        <col width="50%">
                        <tr valign="top">
                            <td>
                                <div class="r">
                                    <font style="display: inline;" color="red"><b><u>NAME:</u></b></font>
                                    <input style="width:70%;float:right;" type="text" id="txtEntryName" PLACEHOLDER='Enter NAME of Flix e.g. LINCOLN' aria-label="Link or title" ng-model="entryName" />
                                </div>
                                <br>
                                <div class="r">
                                    <font style="display: inline;" color="red"><b><u>LINK:</u></b></font>
                                    <input style="width:70%;float:right" type="text" id="txtEntryName" PLACEHOLDER='Enter URL to Flix e.g. http://...' aria-label="Link or title" ng-model="entryLink" />
                                </div>
                            </td>
                            <td align="center">                                
                                <div class="r" style="margin-right: 10px;">
                                    <!-- <font color="red"><b><u>TOPIC:</u></b></font><br>-->
                                    <select multiple ng-multiple="true" size="10" style="height:80%;width:75%;"  name="selected" ng-model="selectedSubjectNames" ng-change="" ng-init="loadSubjects()">
                                        <option ng-repeat="flixSubject in flixSubjects" value="{{flixSubject.subject_name}}">{{flixSubject.subject_name}}</option>
                                    </select>
                                </div>
                            </td>
                        </tr>
                    </table>
                    <br>

                </div>
                
                <!-- MOBILE VIEW  -->
                <div class="visible-xs-block visible-sm-block">
            
                    <div class="row" style="display: inline">
                        <font style='display: inline;' color="red"><b><u>NAME:</u></b></font>
                        <input style="width:80%;float:right;" type="text" id="txtEntryName" PLACEHOLDER='Enter NAME of Flix e.g. LINCOLN' aria-label="Link or title" ng-model="entryName" />
                    </div>
                
                    <div class="row" style="display: inline">
                        <font style='display: inline;' color="red"><b><u>LINK:</u></b></font>
                        <input style="width:80%;float:right;" type="text" id="txtEntryName" PLACEHOLDER='Enter URL to Flix e.g. http://...' aria-label="Link or title" ng-model="entryLink" />
                    </div>

                    <div class="row" style="display: inline">
                        <font style='display: inline;float: left' color="red"><b><u>TOPIC:</u></b></font>
                        <select multiple ng-multiple="true" size="10" style="height:100%;width:80%;float:right;"  name="selected" ng-model="selectedSubjectNames" ng-change="" ng-init="loadSubjects()">
                            <option ng-repeat="flixSubject in flixSubjects" value="{{flixSubject.subject_name}}">{{flixSubject.subject_name}}</option>
                        </select>
                    </div>
                </div>

                <div class="row">
                        <div class="form-group" align="center">
                            <button id="btnSubmit" ng-click="btnSubmit_Click($event)" class="btn btn-primary" style="width: 95%;">Submit</button>
                        </div>
                    </div>

                    <div class="row">
                        <p style="text-align: center; font-size: 10pt;">Copyright &copy; 2015 FlixAcademy, Inc. All rights reserved. <a href="/terms.php">Terms of Use</a></p>
                    </div>

            </form>
        </div>
        
        <?php require $_SERVER['DOCUMENT_ROOT'] . "/include/layout/main.body-scripts.php" ?>
        
    </body>
</html>