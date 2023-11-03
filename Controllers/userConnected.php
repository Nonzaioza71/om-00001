<?php
    session_start();
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json; charset=utf-8');

    require_once('../Models/UserModel.php');
    $user_model = new UserModel();

    $res = false;
    if(!isset($_SESSION['isFirstConnection'])){
        $res = $user_model->userConnected();
        $_SESSION['isFirstConnection'] = true;
    }

    echo json_encode($res);
