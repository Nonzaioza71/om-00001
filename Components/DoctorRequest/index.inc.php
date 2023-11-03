<?php
    require_once('Models\DoctorRequestModel.php');
    $path = __DIR__;

    $doctor_request_model = new DoctorRequestModel();

    $doctor_requests_list = $doctor_request_model->getDoctorRequests($user['user_id']);
    require_once($path."/view.inc.php");