<?php
$path = __DIR__;
require_once($path . "/../Models/UserModel.php");
$user_model = new UserModel();


if ((isset($user)) && ($user['user_id'])) {
    $checkHasPIN = $user_model->getUserPINByID($user['user_id']);
    if (count($checkHasPIN) > 0) {
        if (array_key_exists('PINLogined', $_SESSION)) {
            if (array_key_exists('app', $_GET)) {
                switch ($_GET['app']) {
                    case 'DoctorRequest':
                        require_once($path . "/../Components/DoctorRequest/index.inc.php");
                        break;

                    case 'Account':
                        require_once($path . "/../Components/Account/index.inc.php");
                        break;

                    case 'Estimate':
                        require_once($path . "/../Components/Estimate/index.inc.php");
                        break;

                    case 'Logout':
                        require_once($path . "/../Components/signOut/index.inc.php");
                        break;

                    default:
                        require_once($path . "/../Components\Home\index.inc.php");
                        break;
                }
            } else {
                require_once($path . "/../Components\Home\index.inc.php");
            }
        } else {
            require_once($path . "/../Components\Security\index.inc.php");
        }
    } else {
        if (array_key_exists('app', $_GET)) {
            switch ($_GET['app']) {
                case 'DoctorRequest':
                    require_once($path . "/../Components/DoctorRequest/index.inc.php");
                    break;

                case 'Account':
                    require_once($path . "/../Components/Account/index.inc.php");
                    break;

                case 'Estimate':
                    require_once($path . "/../Components/Estimate/index.inc.php");
                    break;

                case 'Logout':
                    require_once($path . "/../Components/signOut/index.inc.php");
                    break;

                default:
                    require_once($path . "/../Components\Home\index.inc.php");
                    break;
            }
        } else {
            require_once($path . "/../Components\Home\index.inc.php");
        }
    }
} else {
    if (array_key_exists('app', $_GET)) {
        switch ($_GET['app']) {
            case 'signIn':
                require_once($path . "/../Components\signIn\index.inc.php");
                break;

            case 'signUp':
                require_once($path . "/../Components\signUp\index.inc.php");
                break;

            default:
                require_once($path . "/../Components\Home\index.inc.php");
                break;
        }
    } else {
        require_once($path . "/../Components\Home\index.inc.php");
    }
}
