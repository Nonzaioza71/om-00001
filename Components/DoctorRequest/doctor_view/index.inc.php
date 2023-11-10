<?php

if (array_key_exists('view', $_GET)) {
    switch ($_GET['view']) {
        case 'Accept':
            $doctor_request = $doctor_request_model->getDoctorRequestByID($_GET['id'])[0];
            $doctor_requests_approve_list = $doctor_request_model->getDoctorRequestsByDoctorID($user['user_id']);
            // getDoctorRequestsByDoctorID
            require_once(__DIR__."/accept.inc.php");
            break;
        
        default:
            require_once(__DIR__."/view.inc.php");
            break;
    }
} else {
    require_once(__DIR__."/view.inc.php");
}
    