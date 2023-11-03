<div class="card col-12 h-100vh fixed-top d-none" id="doctorRequestModal">
    <div class="card-body position-absolute w-100 bottom-50 justify-content-center">
        <div class="text-center">
            <img id="icon" src="Templates\assets\imgs\checked.png" alt="" srcset="" style="width:128px; height:128px;" class="mb-5">
            <h1 id="msg">ดำเนินการเสร็จสิ้น</h1>
            <button class="btn btn-lg btn-success" onclick="toggleDoctorRequestModal(false)">
                <h1>รับทราบ</h1>
            </button>
        </div>
    </div>
</div>

<script>
    function toggleDoctorRequestModal(show) {
        const modal = document.querySelector('#doctorRequestModal')
        show ? modal.classList.remove('d-none') : modal.classList.add('d-none')
        if (show) {
            const icon = document.querySelector('#icon')
            const msg = document.querySelector('#msg')
            if (show.isSuccess) {
                icon.setAttribute('src', 'Templates\\assets\\imgs\\checked.png')
                msg.innerHTML = 'ดำเนินการเสร็จสิ้น'
            } else {
                icon.setAttribute('src', 'Templates\\assets\\imgs\\close.png')
                msg.innerHTML = 'เกิดข้อผิดพลาดกรุณาลองใหม่ภายหลัง'
            }
        }else{
            window.location.reload()
        }
    }
</script>