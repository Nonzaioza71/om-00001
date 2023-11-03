<?php
    if (array_key_exists('app', $_GET)) {
        if ($_GET['app'] != '?') {
            // echo '<script>window.location.href = "?"</script>';
        }
    }
    $path = __DIR__;
    require_once($path."/view.inc.php");