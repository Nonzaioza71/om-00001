<?php
    require_once('Models\DoctorRequestModel.php');
    $path = __DIR__;

    $doctor_request_model = new DoctorRequestModel();

    $doctor_requests_list = $doctor_request_model->getDoctorRequests($user['user_id'], false, 'waiting', $user['user_role']);
    $doctor_requests_list_approve = $doctor_request_model->getDoctorRequests($user['user_id'], false, 'approve', $user['user_role']);
    // print_r($user);
    if ($user['user_role'] == 'doctor') {
        require_once($path."/doctor_view/index.inc.php");
    }else{
        require_once($path."/view.inc.php");
    }