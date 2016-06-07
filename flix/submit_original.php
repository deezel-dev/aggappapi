<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/include/_init.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/include/flix/search.php";
?>

<!DOCTYPE html>

<html lang="en">
    <head>
        <?php require $_SERVER['DOCUMENT_ROOT'] . "/include/layout/main.head.php" ?>
    </head>
    <body ng-app="flixAcademy">
        <?php require $_SERVER['DOCUMENT_ROOT'] . "/include/layout/main.body-navbar.php" ?>        
        <div class="container">
            <form ng-controller="SubmitFlixController">
                <div class="row">
                    <div class="col-xs-12">
                        <h3>Submit a Flix recommendation</h3>
                    </div>
                </div>
                
                <div class="row" style="margin-top: 10px; margin-bottom: 20px;">
                    <div class="col-xs-12 col-sm-8" style="font-size: 1.1em; text-align: justify;">
                        We're working to make user-submitted content worth your time -
                        <?php if (isset($_SESSION[SESSION_PROFILE_ID])) { ?>
                            we'll
                        <?php } else { ?>
                            please share your contact information so that we can
                        <?php } ?>
                        return the favor when our rewards program goes live!<br />
                        <small>We will not share your name or email address without your permission.</small>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-xs-12 well">
                        <div class="row">
                            <div class="col-xs-12 col-sm-6 col-md-4">
                                <div class="row">
                                    <h5>Your suggestion</h5>
                                </div>
                                <div class="form-group clearfix" style="max-width: 400px;">
                                    <label class="col-xs-12 control-label">Link (preferred) or title, or new category<small>&nbsp;(required field)</small></label>
                                    <div class="col-xs-12 col-xs-nowide">
                                        <input type="text" class="form-control" id="txtEntry" aria-label="Link or title" ng-model="entry" />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php if (isset($_SESSION[SESSION_PROFILE_ID])) { ?>
                            <div class="row">
                                <div class="col-xs-12 col-sm-6 col-md-4">
                                    <div class="row">
                                        <h5>About you</h5>
                                    </div>
                                    <div class="form-group clearfix" style="max-width: 400px;">
                                        <label class="col-xs-12 control-label">You</label>
                                        <div class="col-xs-12">
                                            <p class="form-control-static"><?php echo htmlentities($_SESSION[SESSION_PROFILE_DISPLAYNAME]); ?> <small>(currently signed in)</small></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                        <div class="row">
                            <div class="col-xs-12">
                                <div class="form-group">
                                    <button id="btnSubmit" ng-click="btnSubmit_Click($event)" class="btn btn-primary col-xs-12 col-sm-6 col-md-4" style="max-width: 400px;">Submit</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <p style="text-align: center; font-size: 10pt;">Copyright &copy; 2015 FlixAcademy, Inc. All rights reserved. <a href="/terms.php">Terms of Use</a></p>
                </div>
            </form>
        </div>
        
        
        
        <?php require $_SERVER['DOCUMENT_ROOT'] . "/include/layout/main.body-scripts.php" ?>
        <script type="text/javascript">
            (function(angular) {
                angular.module('flixAcademy', []).controller('SubmitFlixController', ['$scope', '$http', function($scope, $http) {                    
                    // Form
                    $scope.entry = "";
                    $scope.termsAccepted = false;
                    
                    //
                    // Events
                    
                    $scope.btnSubmit_Click = function($event) {
                        if ($scope.entry == null || $scope.entry == "")
                        {
                            window.alert("A link or title is required.");
                            return;
                        }
                        
                        $http.post("//<?php echo($_SERVER['HTTP_HOST']) ?>/flix/submit-post.php", {
                            entry: $scope.entry
                        })
                        .success(function(data, status, headers, config) {
                            window.alert("Thank you for submitting a suggestion! We review and add suggestions on a regular basis.");
                            $scope.entry = "";
                        }).error(function(data, status, headers, config) {
                            
                        });
                    }
                }]);
            })(window.angular);
        </script>
    </body>
</html>