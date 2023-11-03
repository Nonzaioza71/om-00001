<div class="col-12 pb-5">
    <div class="col-12 row gap-5 p-5 justify-content-center">
        <div class="col-12 text-center">
            <img src="Templates\assets\imgs\user.png" alt="" srcset="" style="width:256px; height:256px;">
        </div>
        <div class="col-12 d-flex justify-content-center">
            <div class="col-8">
                <h1>บัญชี</h1>
                <hr>
                <h2 class="col-12">
                    <input class="form-control fs-2" type="text" value="<?php echo $user['user_prefix'] ?>" id="user_prefix"> 
                    <input class="form-control fs-2" type="text" value="<?php echo $user['user_name'] ?>" id="user_name"> 
                    <input class="form-control fs-2" type="text" value="<?php echo $user['user_lastname'] ?>" id="user_lastname">
                </h2>
                
                <h3 class="text-secondary mt-5">
                    รหัสบัตรประชาชน : <input class="form-control fs-3" type="text" value="<?php echo $user['user_national_card'] ?>" id="user_national_card" /> 
                </h3>
                <h3 class="text-secondary">
                    วัน/เดือน/ปี เกิด : 
                    <input type="date" onChange="_handleDateUpdate(this.value)" class="d-hidden" style="width: 0px;" name="datepicker" id="datepicker">
                    <!-- <button type="button" class="btn btn-primary" onClick="">เลือกวันที่</button> -->
                    <input  class="form-control mt-3 fs-3" type="text" value="<?php echo $user['user_birthday'] ?>" name="user_birthday" id="user_birthday" onClick="document.querySelector('#datepicker').showPicker()">

                </h3>
                <h4 class="text-secondary mt-5">เป็นสมาชิกเมื่อ : <?php echo $user['add_date'] ?></h4>
            </div>
        </div>
    </div>
    <div class="col-12 d-flex justify-content-center">
        <div class="col-8 d-flex justify-content-center">
            <button class="btn btn-lg btn-primary w-50" onclick="window.location.reload()">
                คืนค่าเดิม
            </button>
            <button class="btn btn-lg btn-success w-50" onclick="_handleSubmit()">
                แก้ไข
            </button>
        </div>
    </div>
</div>

<script>
    function _handleDateUpdate(val) {
        document.querySelector('#user_birthday').value = new Date(val).toLocaleDateString('en-GB');
    }
    function _handleSubmit() {
        const user_prefix = document.querySelector("#user_prefix").value
        const user_name = document.querySelector("#user_name").value
        const user_lastname = document.querySelector("#user_lastname").value
        const user_national_card = document.querySelector("#user_national_card").value
        const user_birthday = document.querySelector("#user_birthday").value

        fetch('./Controllers/updateUserByID.php', {
            headers: {
                'Accept' : 'application/json',
                'Content-Type' : 'application/json',
            },
            method: "POST",
            body: JSON.stringify({
                user_prefix,
                user_name,
                user_lastname,
                user_national_card,
                user_birthday
            })
        })
        .then(res=>res.json())
        .then(data=>{
            console.log(data);
            const _r = { isSuccess: true, refresh: true }
            toggleDoctorRequestModal(_r)
        })
        .catch(e=>{
            const _r = { isSuccess: false, refresh: true }
            toggleDoctorRequestModal(_r)
        })
    }
</script>

<?php require_once(__DIR__.'/modal.inc.php'); ?>