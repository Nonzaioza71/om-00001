<?php
    session_start();
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json; charset=utf-8');

    require_once('../Models/BoardModel.php');
    $board_model = new BoardModel();

    $data = json_decode(file_get_contents('php://input'), true);

    $res = $board_model->getBoardCommentByID($data['board_id']);

    echo json_encode($res);
