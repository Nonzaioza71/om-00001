<?php
    session_start();
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json; charset=utf-8');

    require_once('../Models/UserModel.php');
    $user_model = new UserModel();

    $data = json_decode(file_get_contents('php://input'), true);

    $res = $user_model->getUserLoginBy($data['user_national_card'], $data['user_birthday']);

    echo json_encode($res);

    if (count($res) > 0) {
        $_SESSION['user_data'] = $res[0];
    }