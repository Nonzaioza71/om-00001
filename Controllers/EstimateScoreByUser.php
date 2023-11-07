<?php
    session_start();
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json; charset=utf-8');

    require_once('../Models/EstimateModel.php');
    $estimate_model = new EstimateModel();

    $data = json_decode(file_get_contents('php://input'), true);

    $checkInserted = $estimate_model->getEstimateByUser($_SESSION['user_data']['user_id']);
    $res = false;

    if(count($checkInserted) > 0){
        $res = $estimate_model->updateEstimateByID($_SESSION['user_data']['user_id'], $data['data']);
    }else{
        $res = $estimate_model->insertEstimateScoreBy($_SESSION['user_data']['user_id'], $data['data']);
    }
    // $res = $estimate_model->insertEstimateScoreBy($_SESSION['user_data']['user_id'], $data['data']);

    echo json_encode($res);
