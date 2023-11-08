<?php
    session_start();
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json; charset=utf-8');

    require_once('../Models/UserModel.php');
    $user_model = new UserModel();

    $res = $user_model->getUserBannedByID($_SESSION['user_data']['user_id']);

    echo json_encode(boolval(count($res)));
