<?php
    session_start();
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json; charset=utf-8');

    require_once('../Models/UserModel.php');
    $user_model = new UserModel();

    $data = json_decode(file_get_contents('php://input'), true);

    $task = [];
    $task[1] = false;
    $task[2] = false;

    $task[1] = $user_model->updateUserByID(
        $data['user_prefix'],
        $data['user_name'],
        $data['user_lastname'],
        $data['user_national_card'],
        $data['user_birthday'],
        $_SESSION['user_data']['user_id']
    );

    if (array_key_exists('user_pin', $data)) {
        $checkInserted = $user_model->getUserPINByID($_SESSION['user_data']['user_id']);
        if (count($checkInserted) > 0) {
            $task[2] = $user_model->updateUserPINByID($_SESSION['user_data']['user_id'], $data['user_pin']);
        } else {
            $task[2] = $user_model->insertUserPINBy($_SESSION['user_data']['user_id'], $data['user_pin']);
        }
        
    }

    if($task[1] == true){
        $newData = $user_model->getUserByID($_SESSION['user_data']['user_id']);
        if (count($newData) > 0) {
            $_SESSION['user_data'] = $newData[0];
        }
    }

    $res = boolval($task[1] && $task[2]);

    echo json_encode($res);
