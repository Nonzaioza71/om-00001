<div class="fixed-top h-100vh bg-light pt-5 pb-5 d-none" id="launchpad">
    <div class="container">

        <?php if (isset($user)) { ?>
            <button class="btn btn-lg btn-danger w-100" onclick="document.querySelector('#launchpad').classList.add('d-none')">
                <h1 class="text-center">ปิดเมนู</h1>
            </button>
            <hr>

            <div class="btn btn-outline-dark btn-lg w-100 bg-success-50 ps-5 pe-5 pt-3 pb-3 mb-3 cursor-pointer" onclick="to('?app=home')">
                <h2 class="text-center">หน้าหลัก</h2>
            </div>

            <div class="btn btn-outline-dark btn-lg w-100 bg-warning-50 ps-5 pe-5 pt-3 pb-3 mb-3 cursor-pointer" onclick="to('?app=doctor_request')">
                <h2 class="text-center">
                    <?php if ($user['user_role'] == 'doctor') {
                        echo 'นัดพบผู้ป่วย';
                    } else {
                        echo 'ขอนัดพบหมอ';
                    }
                    ?>
                </h2>
            </div>

            <div class="btn btn-outline-dark btn-lg w-100 bg-primary-50 ps-5 pe-5 pt-3 pb-3 mb-3 cursor-pointer" onclick="to('?app=estimate')">
                <h2 class="text-center">แบบประเมิน</h2>
            </div>

            <div class="btn btn-outline-dark btn-lg w-100 bg-primary-50 ps-5 pe-5 pt-3 pb-3 mb-3 cursor-pointer" onclick="to('?app=account')">
                <h2 class="text-center">บัญชี</h2>
            </div>

            <div class="btn btn-outline-dark btn-lg w-100 bg-danger-50 ps-5 pe-5 pt-3 pb-3 mb-3 cursor-pointer" onclick="to('?app=logout')">
                <h2 class="text-center">ออกจากระบบ</h2>
            </div>

        <?php } else { ?>
            <button class="btn btn-lg btn-danger w-100" onclick="document.querySelector('#launchpad').classList.add('d-none')">
                <h1 class="text-center">ปิดเมนู</h1>
            </button>
            <hr>

            <div class="btn btn-outline-dark btn-lg w-100 bg-success-50 ps-5 pe-5 pt-3 pb-3 mb-3 cursor-pointer" onclick="to('?app=home')">
                <h2 class="text-center">หน้าหลัก</h2>
            </div>

            <div class="btn btn-outline-dark btn-lg w-100 bg-info-50 ps-5 pe-5 pt-3 pb-3 mb-3 cursor-pointer" onclick="to('?app=login')">
                <h2 class="text-center">เข้าสู่ระบบ</h2>
            </div>

            <div class="btn btn-outline-dark btn-lg w-100 bg-warning-50 ps-5 pe-5 pt-3 pb-3 mb-3 cursor-pointer" onclick="to('?app=register')">
                <h2 class="text-center">สมัครสมาชิก</h2>
            </div>

        <?php } ?>

    </div>
</div>