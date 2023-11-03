<?php
    session_start();
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json; charset=utf-8');

    require_once('../Models/DoctorRequestModel.php');
    $doctor_request_model = new DoctorRequestModel();

    $data = json_decode(file_get_contents('php://input'), true);

    $res = $doctor_request_model->getDoctorRequests($_SESSION['user_data']['user_id'], $data['doctor_id']);

    echo json_encode($res);
