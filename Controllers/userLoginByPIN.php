<?php
    session_start();
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json; charset=utf-8');

    require_once('../Models/UserModel.php');
    $user_model = new UserModel();

    $data = json_decode(file_get_contents('php://input'), true);

    $res = $user_model->userLoginByPIN($data['user_pin'], $_SESSION['user_data']['user_id']);

    echo json_encode(boolval(count($res)));

    if (count($res) > 0) {
        $_SESSION['PINLogined'] = $res[0];
    }