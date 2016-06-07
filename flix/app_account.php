<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/include/_init.php";
$HOST = $_SERVER['HTTP_HOST'];
?>

<div class="container">
    <form ng-show="isLoaded">
        <div class="row visible-md-block visible-lg-block" id="logoRow" ng-hide="movies.length > 0">
            <div class="col-xs-12" id="logoColumn">
                <img src="/public/images/logo.png" alt="FlixAcademy Logo" />
            </div>
        </div>
        <div class="row">
                    
            <div class="well col-xs-12 col-sm-5 col-centered" ng-hide="requestSignUp">
                <div class="row">
                    <div class="col-xs-12 col-centered" style="max-width: 400px;">
                        <div class="row">
                            <h3>
                                Sign in&nbsp;<small>&nbsp;&nbsp;<a href="#" ng-click="lnkSignUp_Click()">...or <strong>sign up</strong></a></small>
                            </h3>
                            <span class="text-danger" ng-show="signInError">{{signInError}}</span>
                        </div>
                        <div class="form-group clearfix">
                            <label class="control-label col-xs-12">Email</label>
                            <input id="txtSignInEmail" type="email" ng-model="signInEmail" class="form-control col-xs-12" />
                        </div>
                        <div class="form-group clearfix">
                            <label class="control-label col-xs-12">Password <small><a href="#" ng-click="lnkForgotPassword_Click( <?php echo $HOST ?>)">Forgot your password?</a></small></label>
                            <input id="txtSignInPassword" type="password" ng-model="signInPassword" class="form-control col-xs-12" />
                        </div>
                        <?php /*<div class="row">
                            <div class="col-xs-12 clearfix">
                                <label class="checkboxk-inline">
                                    <input type="checkbox" ng-model="signInRememberMe" />
                                    Remember me?
                                </label>
                            </div>
                        </div>*/ ?>
                        <div class="row">
                            <div class="col-xs-12 clearfix">
                                <button class="btn btn-primary form-control" ng-click="btnSignIn_Click('<?php echo $HOST ?>')">Sign In</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
                    
                    
                    
            <div class="well col-xs-12 col-lg-10 col-centered" ng-show="requestSignUp">
                <div class="row">
                    <h3>
                        Sign up&nbsp;<small>&nbsp;&nbsp;<a href="#" ng-click="lnkSignIn_Click()">...or <strong>sign in</strong></a></small>
                    </h3>
                </div>
                <div class="row">
                    <div class="col-xs-12 col-sm-8 col-md-6">
                        <div class="form-group clearfix">
                            <label class="control-label col-xs-12 cold-md-6">Email <small class="required-text">(required)</small></label>
                            <input id="txtSignUpEmail" type="email" ng-model="signUpEmail" class="form-control col-xs-12 col-md-6" />
                            <span class="text-danger" ng-show="signUpEmailError">{{signUpEmailError}}</span>
                            <span class="help-block">We do not share your email address with members of the website, or anyone else for that matter.</span>
                        </div>
                        <div class="form-group clearfix">
                            <label class="control-label col-xs-12 cold-md-6">Display name <small class="required-text">(required)</small></label>
                            <input id="txtSignUpDisplayName" type="text" ng-model="signUpDisplayName" class="form-control col-xs-12 col-md-6" />
                            <span class="text-danger" ng-show="signUpDisplayNameError">{{signUpDisplayNameError}}</span>
                            <span class="help-block">This name is visible to other members of the website and must be alphanumeric.</span>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-8 col-md-6">
                        <div class="form-group clearfix">
                            <label class="control-label col-xs-12 cold-md-6">Password <small class="required-text">(required)</small></label>
                            <input id="txtSignUpPassword" type="password" ng-model="signUpPassword" class="form-control col-xs-12 col-md-6" />
                            <span class="text-danger" ng-show="signUpPasswordError">{{signUpPasswordError}}</span>
                            <span class="help-block">Your password must be at least 6 characters long, contain both letters and numbers, and may contain any of the following symbols: !@#$%^&amp;*()</span>
                        </div>
                        <div class="form-group clearfix">
                            <label class="control-label col-xs-12 cold-md-6">Confirm password <small class="required-text">(required)</small></label>
                            <input id="txtSignUpConfirmPassword" type="password" ng-model="signUpConfirmPassword" class="form-control col-xs-12 col-md-6" />
                            <span class="text-danger" ng-show="signUpConfirmPasswordError">{{signUpConfirmPasswordError}}</span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12 col-sm-8 col-md-6 col-md-offset-6 clearfix">
                        <div class="form-group">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" ng-model="signUpTermsAccepted" />
                                    I agree to the Terms of Use, available <a href="/terms.php" target="_blank">here</a>.
                                </label>
                            </div>
                            <div class="text-danger" ng-show="signUpTermsAcceptedError">
                                {{signUpTermsAcceptedError}}
                            </div>
                        </div>
                        <button class="btn btn-primary form-control" ng-click="btnSignUp_Click(<?php echo $HOST ?>)">Sign Up</button>
                    </div>
                </div>
            </div>
                    
                    
                    
        </div>
        <div class="row">
            <p style="text-align: center; font-size: 10pt;">Copyright &copy; 2015 FlixAcademy, Inc. All rights reserved. <a href="/terms.php">Terms of Use</a></p>
        </div>
    </form>
</div>
 