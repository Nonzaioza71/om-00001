<?php
    session_start();
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json; charset=utf-8');

    require_once('../Models/DoctorRequestModel.php');
    $doctor_request_model = new DoctorRequestModel();

    $data = json_decode(file_get_contents('php://input'), true);

    $res = $doctor_request_model->insertDoctorRequest($_SESSION['user_data']['user_id'], $data['request_detail']);

    echo json_encode($res);
