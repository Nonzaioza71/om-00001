<div class="col-12 pb-5">
    <div class="container pt-5 text-center">
        <img src="Templates\assets\imgs\user.png" class="col-1" alt="" srcset="">
        <h1 class="text-center mt-3">
            <strong>
                สมัครสมาชิก
            </strong>
        </h1>
        <form class="col-12" action="" method="post" id="regForm">
            <div class="col-12 row justify-content-center mt-5">
                <div class="formgroup col-10">
                    <label>คำนำหน้าชื่อ-ชื่อ-นามสกุล</label>
                    <div class="d-flex col-12">
                        <div class="col-2">
                            <input type="text" placeholder="นาย" class="form-control" id="user_prefix">
                        </div>
                        <div class="col-5">
                            <input type="text" placeholder="แดงเดือด" class="form-control" id="user_name">
                        </div>
                        <div class="col-5">
                            <input type="text" placeholder="เดื๊อดเดือด" class="form-control" id="user_lastname">
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 row justify-content-center mt-5">
                <div class="form-group col-5">
                    <label>วัน/เดือน/ปี เกิด</label>
                    <input type="date" onChange="_handleDateUpdate(this.value)" class="d-hidden" style="width: 0px;" name="datepicker" id="datepicker">
                    <!-- <button type="button" class="btn btn-primary" onClick="">เลือกวันที่</button> -->
                    <input type="text" name="user_birthday" id="user_birthday" onClick="document.querySelector('#datepicker').showPicker()" class="form-control mt-3">
                </div>
                <div class="form-group col-5 align-self-end">
                    <label>เพศ</label>
                    <select name="user_gender" id="user_gender" class="form-select">
                        <option value="male">ชาย</option>
                        <option value="female">หญิง</option>
                    </select>
                </div>
            </div>
            <div class="col-12 row justify-content-center mt-5">
                <div class="formgroup col-10">
                    <label>รหัสบัตรประชาชน</label>
                    <input type="text" placeholder="3157784225214" class="form-control" id="user_national_card">
                </div>
            </div>
            <button type="submit" class="btn btn-lg btn-success mt-5">ลงทะเบียน</button>
        </form>
    </div>
</div>

<script>
    document.querySelector('#user_birthday').setAttribute('placeholder', new Date().toLocaleDateString('en-GB'))
    
    function _handleDateUpdate(val) {
        document.querySelector('#user_birthday').value = new Date(val).toLocaleDateString('en-GB');
    }

    
    var form = document.querySelector("#regForm");

    function handleForm(event) {
        event.preventDefault();
        const user_prefix = document.querySelector('#user_prefix').value
        const user_name = document.querySelector('#user_name').value
        const user_lastname = document.querySelector('#user_lastname').value
        const user_national_card = document.querySelector('#user_national_card').value
        const user_birthday = document.querySelector('#user_birthday').value
        const user_gender = document.querySelector('#user_gender').value
        fetch('./Controllers/insertUserBy.php', {
                headers: {
                    'Accept': 'application/json',
                    'Content-Type': 'application/json'
                },
                method: "POST",
                body: JSON.stringify({
                    user_prefix,
                    user_name,
                    user_lastname,
                    user_national_card,
                    user_birthday,
                    user_gender,
                })
            }).then(res => res.json())
            .then(data => {
                console.log(data);
                if(data){
                    alert('ดำเนินการเสร็จสิ้น')
                    window.location.href = '?'
                }else{
                    alert('เกิดข้อผิดพลาดในการเข้าสู่ระบบกรุณาลองอีกครั้ง')
                }
            })
    }
    form.addEventListener('submit', handleForm);
</script>