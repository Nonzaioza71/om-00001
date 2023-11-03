<?php
    session_start();
    $user = isset($_SESSION['user_data']) ? $_SESSION['user_data'] : null;
    require_once(__DIR__."/menu.inc.php");
    require_once(__DIR__."/content.inc.php");
    require_once(__DIR__."/launchpad.inc.php");