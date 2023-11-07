<div class="card col-12 h-100vh fixed-top" id="pinPage">
    <div class="card-body position-absolute w-100 bottom-25 justify-content-center">
        <div class="text-center">
            <img id="icon" src="Templates\assets\imgs\padlock.png" alt="" srcset="" style="width:128px; height:128px;" class="mb-5">
            <h1 id="msg">กรุณากรอก PIN</h1>
            <div class="verical-align-bottom">
                <div>
                    <input type="password" name="user_pin" id="user_pin" class="form-cotrol form-control-lg fs-2">
                </div>
                <div class="mt-5">
                    <button class="btn btn-lg btn-success" onclick="_handleSubmit()">
                        <h1>ยืนยัน</h1>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function checkSubmit() {
        const pinLength = document.querySelector('#user_pin').value.length
        if (pinLength == 0) {
            alert("กรุณากรอก PIN ให้เรียบร้อย")
            return false
        } else {
            return true
        }
    }

    function _handleSubmit() {
        const user_pin = document.querySelector('#user_pin').value
        if (checkSubmit()) {
            document.querySelector('#LoadingScreen').classList.remove('d-none')
            fetch('Controllers/userLoginByPIN.php', {
                    headers: {
                        "Accept": "application/json",
                        "Content-Type": "application/json"
                    },
                    method: "POST",
                    body: JSON.stringify({
                        user_pin
                    })
                })
                .then(res => res.json())
                .then(data => {
                    console.log(data);
                    document.querySelector('#LoadingScreen').classList.add('d-none')
                    const _r = {
                        isSuccess: data,
                        refresh: true
                    }
                    toggleDoctorRequestModal(_r)
                })
                .catch(e => {
                    document.querySelector('#LoadingScreen').classList.add('d-none')
                    const _r = {
                        isSuccess: false,
                        refresh: true
                    }
                    toggleDoctorRequestModal(_r)
                })
        }
    }
</script>

<?php require_once(__DIR__ . '/loading.inc.php'); ?>
<?php require_once(__DIR__ . '/modal.inc.php'); ?>