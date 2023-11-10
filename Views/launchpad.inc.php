<?php
$menuList = [];
$menuList['logined'] = [];
$menuList['logined'][] = array('src' => "Templates\assets\imgs\corkboard.png", 'name' => "หน้าหลัก", 'color' => "bg-warning-50", 'route' => '?');
$menuList['logined'][] = array('src' => "Templates\assets\imgs\advice.png", 'name' => "ขอวันนัดพบหมอ", 'color' => "bg-info-50", 'route' => '?app=DoctorRequest');
$menuList['logined'][] = array('src' => "Templates\assets\imgs\contract.png", 'name' => "แบบประเมิน", 'color' => "bg-warning-50", 'route' => '?app=Estimate');
$menuList['logined'][] = array('src' => "Templates\assets\imgs\user.png", 'name' => "บัญชี", 'color' => "bg-info-50", 'route' => '?app=Account');
$menuList['logined'][] = array('src' => "Templates\assets\imgs\log-out.png", 'name' => "ออกจากระบบ", 'color' => "bg-danger-50", 'route' => '?app=Logout');

$menuList['noLogin'] = [];
$menuList['noLogin'][] = array('src' => "Templates\assets\imgs\corkboard.png", 'name' => "หน้าหลัก", 'color' => "bg-warning-50", 'route' => '?');
$menuList['noLogin'][] = array('src' => "Templates\assets\imgs\import.png", 'name' => "เข้าสู่ระบบ", 'color' => "bg-info-50", 'route' => '?app=signIn');
$menuList['noLogin'][] = array('src' => "Templates\assets\imgs\contract.png", 'name' => "สมัครสมาชิก", 'color' => "bg-warning-50", 'route' => '?app=signUp');
?>

<div class="w-100 h-100vh bg-light fixed-top card d-none overflow-scroll" id="launchpad">
    <div class="card-header d-flex justify-content-center bg-light container">
        <div class="col-12">
            <button class="btn btn-lg btn-danger ps-5 pe-5 w-100" onClick="toggleLaunchpad(false)">
                <h1>ปิด</h1>
            </button>
        </div>
    </div>
    <div class="card-body col-12 d-flex justify-content-center container">
        <div class="col-12 row justify-content-center gap-1 container">

            <?php if ($user) { ?>
                <?php for ($i = 0; $i < count($menuList['logined']); $i++) { ?>
                    <button class="btn btn-light card col-12 <?php echo $menuList['logined'][$i]['color']?>" onClick="window.location.href = '<?php echo $menuList['logined'][$i]['route'] ?>'" id="itemLaunchpad">
                        <div class="d-flex justify-content-between col-12 m-auto">
                            <div class="col-2">
                                <img src="<?php echo $menuList['logined'][$i]['src'] ?>" alt="" srcset="" class="col-12">
                            </div>
                            <div class="col-10" style="place-self: center;">
                                <h1 class="text-center">
                                    <?php echo $menuList['logined'][$i]['name'] ?>
                                </h1>
                            </div>
                            <div></div>
                        </div>
                    </button>
                <?php } ?>
            <?php } else { ?>
                <?php for ($i = 0; $i < count($menuList['noLogin']); $i++) { ?>
                    <button class="btn btn-light card col-12 <?php echo $menuList['noLogin'][$i]['color']?>" onClick="window.location.href = '<?php echo $menuList['noLogin'][$i]['route'] ?>'" id="itemLaunchpad">
                        <div class="d-flex justify-content-between col-12 m-auto">
                            <div class="col-2">
                                <img src="<?php echo $menuList['noLogin'][$i]['src'] ?>" alt="" srcset="" class="col-12">
                            </div>
                            <div class="col-10" style="place-self: center;">
                                <h1 class="text-center">
                                    <?php echo $menuList['noLogin'][$i]['name'] ?>
                                </h1>
                            </div>
                            <div></div>
                        </div>
                    </button>
                <?php } ?>
            <?php } ?>

        </div>
    </div>
</div>

<script>
    function toggleLaunchpad(showLaunchpad) {
        //   console.log(showLaunchpad);
        showLaunchpad
            ?
            document.querySelector('#launchpad').classList.remove("d-none") :
            document.querySelector('#launchpad').classList.add("d-none")
    }

    function reSizeItemLaunchPad() {
        let items = document.querySelectorAll('#itemLaunchpad')
        items.forEach(item => {
            if (window.innerWidth < window.innerHeight) {
                item.classList.add('col-5')
                item.classList.remove('col-3')
            } else {
                item.classList.remove('col-5')
                item.classList.add('col-3')
            }
        });
    }
    // window.addEventListener("resize", reSizeItemLaunchPad)
    // reSizeItemLaunchPad()
</script>