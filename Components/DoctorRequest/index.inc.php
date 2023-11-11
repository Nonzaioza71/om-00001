<?php
    require_once('Models/DoctorRequestModel.php');
    $doctor_requests_model = new DoctorRequestModel();

    $doctor_requests_list_waiting = $doctor_requests_model->getDoctorRequests($user['user_id'], false, 'waiting', $user['user_role']);
    $doctor_requests_list_approve = $doctor_requests_model->getDoctorRequests($user['user_id'], false, 'approve', $user['user_role']);
    $doctor_requests_list_approve_by_me = $doctor_requests_model->getDoctorRequestsByDoctorID($user['user_id']);

    if ($user['user_role'] == 'doctor') {
        require_once(__DIR__.'/doctor_view/index.inc.php');
    } else {
        require_once(__DIR__.'/view.inc.php');
    }
    