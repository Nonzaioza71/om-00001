<?php
    require_once('Models/BoardModel.php');
    $board_model = new BoardModel();

    $boards_list = $board_model->getBoardsBy();

    if (array_key_exists('view', $_GET)) {
        switch ($_GET['view']) {
            case 'Board':
                require_once(__DIR__.'/detail.inc.php');
                break;
            
            default:
                require_once(__DIR__.'/view.inc.php');
                break;
        }
    } else {
        require_once(__DIR__.'/view.inc.php');
    }
    