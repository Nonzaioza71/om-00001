<?php
    if (array_key_exists('view', $_GET)) {
        switch ($_GET['view']) {
            case 'accept':
                $request_data = $doctor_requests_list_waiting[$_GET['idx']];
                require_once(__DIR__.'/accept.inc.php');
                break;
            
            default:
                require_once(__DIR__.'/view.inc.php');
                break;
        }
    } else {
        require_once(__DIR__.'/view.inc.php');
    }
    