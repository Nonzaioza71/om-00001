<div class="card col-12 h-100vh fixed-top d-none" id="theModal">
    <div class="card-body position-absolute w-100 bottom-25 justify-content-center">
        <div class="text-center">
            <img id="modalIcon" src="Templates\assets\imgs\loading.png" alt="" srcset="" style="width:128px; height:128px;" class="mb-5">
            <h1 id="modalMsg"></h1>
            <button class="btn btn-lg btn-primary" onclick="toggleDoctorRequestModal(false)">
                <h1>รับทราบ</h1>
            </button>
        </div>
    </div>
</div>

<script>
    function toggleDoctorRequestModal(show) {
        const modal = document.querySelector('#theModal')
        show ? modal.classList.remove('d-none') : modal.classList.add('d-none')
        if (show) {
            const icon = document.querySelector('#modalIcon')
            const msg = document.querySelector('#modalMsg')
            if (show.isSuccess) {
                icon.setAttribute('src', 'Templates\\assets\\imgs\\checked.png')
                msg.innerHTML = 'ดำเนินการเสร็จสิ้น <br> ยินดีต้อนรับ'
            } else {
                icon.setAttribute('src', 'Templates\\assets\\imgs\\close.png')
                msg.innerHTML = 'เกิดข้อผิดพลาด หรือ PIN ไม่ถูกต้อง กรุณาลองใหม่ภายหลัง'
            }
        }else{
            window.location.reload()
        }
    }
</script>