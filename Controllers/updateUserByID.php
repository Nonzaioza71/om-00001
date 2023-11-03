<?php
    session_start();
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json; charset=utf-8');

    require_once('../Models/UserModel.php');
    $user_model = new UserModel();

    $data = json_decode(file_get_contents('php://input'), true);

    $res = $user_model->updateUserByID(
        $data['user_prefix'],
        $data['user_name'],
        $data['user_lastname'],
        $data['user_national_card'],
        $data['user_birthday'],
        $_SESSION['user_data']['user_id']
    );

    if($res == true){
        $newData = $user_model->getUserByID($_SESSION['user_data']['user_id']);
        if (count($newData) > 0) {
            $_SESSION['user_data'] = $newData[0];
        }
    }

    echo json_encode($res);
