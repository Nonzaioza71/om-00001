<div class="col-12 mt-5 mb-5 p-5 card">
    <h1 class="text-center">เข้าสู่ระบบ</h1>
    <hr>
    <div class="col-12">
        <div class="form-group mb-5">
            <h3>วัน/เดือน/ปี เกิด</h3>
            <input type="date" name="user_birthday" id="user_birthday" class="form-control">
        </div>
        <div class="form-group mb-5">
            <h3>รหัสบัตรประชาชน</h3>
            <input type="text" name="user_national_card" id="user_national_card" class="form-control">
        </div>
        <div class="col-12 d-flex justify-content-around">
            <button class="btn btn-lg btn-success col-5" onclick="_handleSubmit()">เข้าสู่ระบบ</button>
            <button class="btn btn-lg btn-primary col-5" onclick="to('?app=register')">ไปที่สมัครสมาชิก</button>
        </div>
    </div>
</div>
<script>
    function _handleSubmit() {
        const user_birthday = getEle('#user_birthday').value
        const user_national_card = getEle('#user_national_card').value

        fetch('Controllers/getUserLoginBy.php', {
            headers: {
                "Accept": 'application/json',
                "Content-Type": 'application/json'
            },
            method: "POST",
            body: JSON.stringify({
                user_birthday,
                user_national_card
            })
        })
        .then(res=>res.json())
        .then(data=>{
            console.log();
            if (data) {
                window.location.href = '?app=home'
            } else {
                getEle('#errorPage').classList.remove('d-none')
            }
        })
    }
</script>