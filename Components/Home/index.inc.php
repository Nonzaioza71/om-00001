<?php
if (array_key_exists('app', $_GET)) {
    if ($_GET['app'] != '?') {
        // echo '<script>window.location.href = "?"</script>';
    }
}
$path = __DIR__;
require_once('Models/BoardModel.php');
$board_model = new BoardModel();
$boards_list = $board_model->getBoardsBy();


if (array_key_exists('app', $_GET)) {
    if (array_key_exists('view', $_GET)) {
        switch ($_GET['view']) {
            case 'detail':
                $board_data = $board_model->getBoardsByID($_GET['id']);
                require_once($path . "/detail.inc.php");
                break;

            default:
                require_once($path . "/view.inc.php");
                break;
        }
    } else {
        require_once($path . "/view.inc.php");
    }
} else {
    require_once($path . "/view.inc.php");
}
