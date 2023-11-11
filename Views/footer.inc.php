<script>
    function to(url_path) {
        window.location.href = url_path
    }
    function getEle(selector) {
        return document.querySelector(selector)
    }

</script>
<div class="fixed-top col-12 h-100vh bg-light d-none" id="errorPage">
    <div class="col-12 fixed-top top-25 pt-5 text-center">
        <h1>เกิดข้อผิดพลาด</h1>
        <button class="btn btn-lg btn-danger ps-5 pe-5" onclick="getEle('#errorPage').classList.add('d-none')">ปิด</button>
    </div>
</div>
<div class="fixed-top col-12 h-100vh bg-light d-none" id="successPage">
    <div class="col-12 fixed-top top-25 pt-5 text-center">
        <h1>ดำเนินการเสร็จสิ้น</h1>
        <button class="btn btn-lg btn-success ps-5 pe-5" onclick="getEle('#successPage').classList.add('d-none')">ปิด</button>
    </div>
</div>