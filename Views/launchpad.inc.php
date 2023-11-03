<?php
$menuList = [];
$menuList['logined'] = [];
$menuList['logined'][] = array('src' => "Templates\assets\imgs\corkboard.png", 'name' => "หน้าหลัก", 'route' => '?');
$menuList['logined'][] = array('src' => "Templates\assets\imgs\advice.png", 'name' => "ขอวันนัดพบหมอ", 'route' => '?app=DoctorRequest');
$menuList['logined'][] = array('src' => "Templates\assets\imgs\contract.png", 'name' => "แบบประเมิน", 'route' => '?app=Estimate');
$menuList['logined'][] = array('src' => "Templates\assets\imgs\user.png", 'name' => "บัญชี", 'route' => '?app=Account');
$menuList['logined'][] = array('src' => "Templates\assets\imgs\log-out.png", 'name' => "ออกจากระบบ", 'route' => '?app=Logout');

$menuList['noLogin'] = [];
$menuList['noLogin'][] = array('src' => "Templates\assets\imgs\corkboard.png", 'name' => "หน้าหลัก", 'route' => '?');
$menuList['noLogin'][] = array('src' => "Templates\assets\imgs\import.png", 'name' => "เข้าสู่ระบบ", 'route' => '?app=signIn');
$menuList['noLogin'][] = array('src' => "Templates\assets\imgs\contract.png", 'name' => "สมัครสมาชิก", 'route' => '?app=signUp');
?>

<div class="w-100 h-100vh bg-light fixed-top card d-none overflow-scroll" id="launchpad">
    <div class="card-header d-flex justify-content-center bg-light">
        <div>
            <button class="btn btn-lg btn-danger ps-5 pe-5" onClick="toggleLaunchpad(false)">
                <h1>ปิด</h1>
            </button>
        </div>
    </div>
    <div class="card-body col-12 d-flex justify-content-center">
        <div class="col-12 row justify-content-center gap-1">

            <?php if ($user) { ?>
                <?php for ($i = 0; $i < count($menuList['logined']); $i++) { ?>
                    <button class="btn btn-light card text-center align-items-center pt-5 pb-5 ps-2 pe-2" onClick="window.location.href = '<?php echo $menuList['logined'][$i]['route'] ?>'" id="itemLaunchpad">
                        <img src="<?php echo $menuList['logined'][$i]['src'] ?>" alt="" srcset="" class="w-100">
                        <h1 class="text-center">
                            <?php echo $menuList['logined'][$i]['name'] ?>
                        </h1>
                    </button>
                <?php } ?>
            <?php }else{ ?>
                <?php for ($i = 0; $i < count($menuList['noLogin']); $i++) { ?>
                    <button class="btn btn-light card text-center align-items-center pt-5 pb-5 ps-2 pe-2" onClick="window.location.href = '<?php echo $menuList['noLogin'][$i]['route'] ?>'" id="itemLaunchpad">
                        <img src="<?php echo $menuList['noLogin'][$i]['src'] ?>" alt="" srcset="" class="w-100">
                        <h1 class="text-center">
                            <?php echo $menuList['noLogin'][$i]['name'] ?>
                        </h1>
                    </button>
                <?php } ?>
            <?php }?>

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
    window.addEventListener("resize", reSizeItemLaunchPad)
    reSizeItemLaunchPad()
</script>