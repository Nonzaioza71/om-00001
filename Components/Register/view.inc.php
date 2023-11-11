<div class="col-12 mt-5 mb-5 p-5 card">
    <h1 class="text-center">สมัครสมาชิก</h1>
    <hr>
    <div class="col-12">
        <div class="form-group mb-5">
            <h3>คำนำหน้าชื่อ-ชื่อจริง-นามสกุล</h3>
            <div class="col-12 d-flex">
                <div class="col-2">
                    <input type="text" name="user_prefix" id="user_prefix" class="form-control">
                </div>
                <div class="col-5">
                    <input type="text" name="user_name" id="user_name" class="form-control">
                </div>
                <div class="col-5">
                    <input type="text" name="user_lastname" id="user_lastname" class="form-control">
                </div>
            </div>
        </div>
        <div class="form-group mb-5">
            <h3>เพศ</h3>
            <div class="col-12 d-flex">
                <div class="col-12">
                    <select type="text" name="user_gender" id="user_gender" class="form-select">
                        <option value="male">ชาย</option>
                        <option value="female">หญิง</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="form-group mb-5">
            <h3>วัน/เดือน/ปี เกิด</h3>
            <input type="date" name="user_birthday" id="user_birthday" class="form-control">
        </div>
        <div class="form-group mb-5">
            <h3>รหัสบัตรประชาชน</h3>
            <input type="text" name="user_national_card" id="user_national_card" class="form-control">
        </div>
        <div class="col-12 d-flex justify-content-around">
            <button class="btn btn-lg btn-success col-5" onclick="_handleSubmit()">สมัครสมาชิก</button>
            <button class="btn btn-lg btn-primary col-5" onclick="to('?app=login')">ไปที่เข้าสู่ระบบ</button>
        </div>
    </div>
</div>

<script>
    function _handleSubmit() {
        const user_prefix = getEle('#user_prefix').value
        const user_name = getEle('#user_name').value
        const user_lastname = getEle('#user_lastname').value
        const user_gender = getEle('#user_gender').value
        const user_birthday = getEle('#user_birthday').value
        const user_national_card = getEle('#user_national_card').value

        fetch('Controllers/insertUserBy.php', {
            headers: {
                "Accept": 'application/json',
                "Content-Type": 'application/json'
            },
            method: "POST",
            body: JSON.stringify({
                user_prefix,
                user_name,
                user_lastname,
                user_gender,
                user_birthday,
                user_national_card
            })
        })
        .then(res=>res.json())
        .then(data=>{
            console.log();
            if (data) {
                window.location.href = '?app=login'
            } else {
                getEle('#errorPage').classList.remove('d-none')
            }
        })
    }
</script>