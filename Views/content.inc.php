<div class="col-12">
    <div class="container">
        <div class="col-12">
            <img src="Templates\assets\imgs\banner.png" alt="" srcset="" class="w-100">
            <div class="btn-group col-12">
                <div class="btn btn-lg btn-warning">
                    <h1>จำนวนผู้เข้าชม <?php echo $views_count ?> คน</h1>
                </div>
                <div class="btn btn-lg btn-info">
                    <h1>กระทู้ทั้งหมด <?php echo $boards_count ?> รายการ</h1>
                </div>
            </div>
        </div>
        <?php
        if ($user == null) {
            if (array_key_exists('app', $_GET)) {
                switch ($_GET['app']) {
                    case 'login':
                        require_once('Components/Login/index.inc.php');
                        break;

                    case 'register':
                        require_once('Components/Register/index.inc.php');
                        break;

                    default:
                        require_once('Components/Home/index.inc.php');
                        break;
                }
            } else {
                require_once('Components/Index/index.inc.php');
            }
        } else {
            if (array_key_exists('app', $_GET)) {
                switch ($_GET['app']) {
                    case 'account':
                        require_once('Components/Account/index.inc.php');
                        break;

                    case 'doctor_request':
                        require_once('Components/DoctorRequest/index.inc.php');
                        break;

                    case 'home':
                        require_once('Components/Home/index.inc.php');
                        break;

                    case 'estimate':
                        require_once('Components/Estimate/index.inc.php');
                        break;

                    case 'logout':
                        require_once('Components/Logout/index.inc.php');
                        break;

                    default:
                        echo '<script>window.location.href = "?app=home"</script>';
                        break;
                }
            } else {
                require_once('Components/Index/index.inc.php');
                echo '<script>window.location.href = "?app=home"</script>';
            }
        }
        ?>
    </div>
</div>