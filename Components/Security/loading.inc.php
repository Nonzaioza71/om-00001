<div class="card col-12 h-100vh fixed-top d-none" id="LoadingScreen">
    <div class="card-body position-absolute w-100 bottom-50 justify-content-center">
        <div class="text-center">
            <img id="icon" src="Templates\assets\imgs\loading.png" alt="" srcset="" style="width:128px; height:128px;" class="mb-5">
            <h1 id="msg">กำลังตรวจสอบ</h1>
            <button class="btn btn-lg btn-danger" onclick="closeLoading(true)">
                <h1>ยกเลิก</h1>
            </button>
        </div>
    </div>
</div>
<script>
    function closeLoading(isClose) {
        if (isClose) {
            document.querySelector('#loadingScreen').classList.add('d-none')
        }
    }
</script>