<?php
session_start();
require_once('Models/UserModel.php');
require_once('Models/BoardModel.php');
$user_model = new UserModel();
$board_model = new BoardModel();

$user = isset($_SESSION['user_data']) ? $_SESSION['user_data'] : null;
if (isset($user)) {
    $user['user_image'] = 'Templates\assets\imgs\\' . $user['user_role'] . '_' . $user['user_gender'] . '.png'; 
}

$boards_list = $board_model->getBoardsBy();

$views_count = count($user_model->getUserRating());
$boards_count = count($boards_list);

require_once(__DIR__ . '/menu.inc.php');
require_once(__DIR__ . '/content.inc.php');
require_once(__DIR__ . '/launchpad.inc.php');
