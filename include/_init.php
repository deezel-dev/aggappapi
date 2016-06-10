<?php

$GLOBALS["IsDevelopment"] = 1;

function testInit(){
    return "<b><u>INIT</u></b>";
}

function displayErrorIfDevelopment() {
    if ($GLOBALS["IsDevelopment"] == 1) {
        ?>
        window.alert("ERROR:\n\n" + data);
        <?php
    }
}

/*
$GLOBALS["IsDevelopment"] = 1; //($_SERVER['HTTP_HOST'] == "aggappapi.azurewebsites.net") || ($_SERVER['HTTP_HOST'] == "flixacademy-dev-danny.azurewebsites.net") ? 1 : 0;

echo "<b><u>INCLUDE2</u></b>";

if ($GLOBALS["IsDevelopment"] == 1) {
    ini_set('display_errors',1);
    ini_set('display_startup_errors',1);
    error_reporting(E_ALL & ~E_WARNING & ~E_DEPRECATED);
}



require_once "http://aggappapi.azurewebsites.net/include/constants.php";
session_start();
echo "<b><u>INCLUDE</u></b>";
*/
?>