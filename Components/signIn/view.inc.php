<div class="col-12">
    <div class="col-12 pt-5 text-center">
        <img src="Templates\assets\imgs\user.png" class="col-1" alt="" srcset="">
        <h1 class="text-center mt-3">
            <strong>
                เข้าสู่ระบบ
            </strong>
        </h1>
        <form class="col-12" action="" method="post" id="loginForm">
            <div class="col-12 row justify-content-center">
                <div class="form-group col-6">
                    <label>วัน/เดือน/ปี เกิด</label>
                    <input type="date" onChange="_handleDateUpdate(this.value)" class="d-hidden" style="width: 0px;" name="datepicker" id="datepicker">
                    <!-- <button type="button" class="btn btn-primary" onClick="">เลือกวันที่</button> -->
                    <input type="text" name="user_birthday" id="user_birthday" onClick="document.querySelector('#datepicker').showPicker()" class="form-control mt-3">
                </div>
            </div>
            <div class="col-12 row justify-content-center">
                <div class="col-6">
                    <hr>
                </div>
            </div>
            <div class="col-12 row justify-content-center">
                <div class="formgroup col-6">
                    <label>รหัสบัตรประชาชน</label>
                    <input type="text" placeholder="3157784225214" class="form-control" id="user_national_card">
                </div>
            </div>
            <button type="submit" class="btn btn-lg btn-success mt-5">เข้าสู่ระบบ</button>
        </form>
    </div>
</div>

<script>
    document.querySelector('#user_birthday').setAttribute('placeholder', new Date().toLocaleDateString('en-GB'))

    function _handleDateUpdate(val) {
        document.querySelector('#user_birthday').value = new Date(val).toLocaleDateString('en-GB');
    }

    var form = document.querySelector("#loginForm");

    function handleForm(event) {
        event.preventDefault();
        const user_national_card = document.querySelector('#user_national_card').value
        const user_birthday = document.querySelector('#user_birthday').value
        fetch('./Controllers/getUserLoginBy.php', {
                headers: {
                    'Accept': 'application/json',
                    'Content-Type': 'application/json'
                },
                method: "POST",
                body: JSON.stringify({
                    user_national_card,
                    user_birthday
                })
            }).then(res => res.json())
            .then(data => {
                if(data.length == 0){
                    alert('เกิดข้อผิดพลาดในการเข้าสู่ระบบกรุณาลองอีกครั้ง')
                }else{
                    window.location.href = '?'
                }
            })
    }
    form.addEventListener('submit', handleForm);
</script>