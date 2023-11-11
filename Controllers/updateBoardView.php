<?php
    session_start();
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json; charset=utf-8');

    require_once('../Models/BoardModel.php');
    $board_model = new BoardModel();

    $data = json_decode(file_get_contents('php://input'), true);

    $res = $board_model->updateBoardViewByID($data['board_id'], $data['board_view']);

    echo json_encode($res);
