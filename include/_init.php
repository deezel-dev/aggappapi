<?php

    $GLOBALS["IsDevelopment"] = 1;

    if ($GLOBALS["IsDevelopment"] == 1) {
        ini_set('display_errors',1);
        ini_set('display_startup_errors',1);
        error_reporting(E_ALL & ~E_WARNING & ~E_DEPRECATED);
    }

    function displayErrorIfDevelopment() {
        if ($GLOBALS["IsDevelopment"] == 1) {
            ?>
            window.alert("ERROR:\n\n" + data);
            <?php
        }
    }

    require_once ("/include/constants.php");
    session_start();

?>