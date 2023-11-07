<?php
    session_start();
    //Check and clear session if is not ntc project. :DDDDDDDDDDDD
    if (array_key_exists('isNTCSession', $_SESSION)) {
        session_destroy();
        $_SESSION['isNTCSession'] = true;
    }

    $user = isset($_SESSION['user_data']) ? $_SESSION['user_data'] : null;
    require_once(__DIR__."/menu.inc.php");
    require_once(__DIR__."/content.inc.php");
    require_once(__DIR__."/launchpad.inc.php");