<div class="col-12 pt-5">
    <div class="col-12 d-flex justify-content-center">
        <div class="col-10">
            <div class="row">
                <button class="btn btn-success" onclick="sendDoctorRequest()">
                    <h1>ขอวันนัดพบหมอ</h1>
                </button>
            </div>
            <hr>
        </div>
    </div>
    <div class="col-12 d-flex justify-content-center pb-5">
        <div class="card bg-warning-50 col-10 p-3">
            <h2>กำลังรอวันนัดจากหมอ</h2>
            <hr>
            <div class="list-group">

                <?php for ($i=0; $i < count($doctor_requests_list); $i++) { ?>
                    <div class="list-group-item list-group-item-action list-group-item-warning">
                        <h3>ส่งคำขอเมื่อ : <?php echo $doctor_requests_list[$i]['sign_date'] ?></h3>
                        <h3>สถานะ : <?php echo $doctor_requests_list[$i]['status_th'] ?></h3>
                        <button class="btn btn-lg btn-danger w-100" onclick="cancelDoctorRequest(<?php echo $doctor_requests_list[$i]['id'] ?>)">ยกเลิก</button>
                    </div>
                <?php } ?>

            </div>
        </div>
    </div>
</div>

<script>
    function sendDoctorRequest() {
        fetch('./Controllers/insertDoctorRequest.php')
        .then(res=>res.json())
        .then(data=>{
            const _r = { isSuccess: true }
            toggleDoctorRequestModal(_r)
        })
        .catch(e=>{
            const _r = { isSuccess: false }
            toggleDoctorRequestModal(_r)
        })
    }

    function cancelDoctorRequest(id){
        fetch('./Controllers/cancelDoctorRequestByID.php',{
            headers: {
                'Accept' : 'application/json',
                'Content-Type': 'application/json',
            },
            method : "POST",
            body: JSON.stringify({ id })
        })
        .then(res=>res.json())
        .then(data=>{
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