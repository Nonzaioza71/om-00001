<div class="col-12 pt-5">
    <div class="col-12 d-flex justify-content-center">
        <div class="col-10">
            <div class="row">
                <button class="btn btn-success" onclick="sendDoctorRequest()">
                    <h1>ขอวันนัดพบหมอ</h1>
                </button>
                <div class="mb-3">
                  <h2 for="request_detail" class="form-label">รายละเอียดขอนัดพบหมอ</h2>
                  <textarea class="form-control" name="request_detail" id="request_detail" rows="3"></textarea>
                  <h2 class="text-danger" id="alert_msg"></h2>
                </div>
            </div>
            <hr>
        </div>
    </div>
    <div class="col-12 text-center">
        <div class="btn-group col-10">
            <button class="btn btn-lg btn-warning bg-warning-50 text-dark rounded-0 border-bottom-0" onClick="_switchTabType('waiting')">กำลังรอ</button>
            <button class="btn btn-lg btn-success bg-success-50 text-dark rounded-0 border-bottom-0" onClick="_switchTabType('approve')">ยืนยันแล้ว</button>
        </div>
    </div>
    <div class="col-12 d-flex justify-content-center pb-5">
        <div class="card bg-warning-50 col-10 p-3 rounded-0 border-top-0 tab-item" id="waiting">
            <h2>กำลังรอวันนัดจากหมอ</h2>
            <hr>
            <div class="list-group">

                <?php for ($i=0; $i < count($doctor_requests_list); $i++) { ?>
                    <div class="list-group-item list-group-item-action list-group-item-warning mb-3">
                        <h3>ส่งคำขอเมื่อ : <?php echo $doctor_requests_list[$i]['sign_date'] ?></h3>
                        <h3>สถานะ : <?php echo $doctor_requests_list[$i]['status_th'] ?></h3>
                        <hr>
                        <h4>
                            <pre><?php echo $doctor_requests_list[$i]['detail'] ?></pre>
                        </h4>
                        <button class="btn btn-lg btn-danger w-100" onclick="cancelDoctorRequest(<?php echo $doctor_requests_list[$i]['id'] ?>)">ยกเลิก</button>
                    </div>
                <?php } ?>

            </div>
        </div>
        <div class="card bg-success-50 col-10 p-3 d-none rounded-0 border-top-0 tab-item" id="approve">
            <h2>ได้รับการยืนยันนัดจากหมอแล้ว</h2>
            <hr>
            <div class="list-group">

                <?php for ($i=0; $i < count($doctor_requests_list_approve); $i++) { ?>
                    <div class="list-group-item list-group-item-action list-group-item-success mb-3">
                        <h3>ส่งคำขอเมื่อ : <?php echo $doctor_requests_list_approve[$i]['sign_date'] ?></h3>
                        <h3>สถานะ : <?php echo $doctor_requests_list_approve[$i]['status_th'] ?></h3>
                        <h3>พบกับหมอ : <?php echo $doctor_requests_list_approve[$i]['user_prefix'].$doctor_requests_list_approve[$i]['user_name']." ".$doctor_requests_list_approve[$i]['user_lastname'] ?></h3>
                        <hr>
                        <h4>
                            <pre><?php echo $doctor_requests_list_approve[$i]['detail'] ?></pre>
                        </h4>
                    </div>
                <?php } ?>

            </div>
        </div>
    </div>
</div>

<script>
    function sendDoctorRequest() {
        const request_detail = document.querySelector('#request_detail').value
        if (request_detail == "") {
            document.querySelector('#alert_msg').innerHTML = 'กรุณากรอกรายละเอียดเพื่อให้แพทย์ได้ทราบ'
            document.querySelector('#request_detail').focus()
        }else{
            document.querySelector('#alert_msg').innerHTML = ''
            fetch('./Controllers/insertDoctorRequest.php', {
                headers: {
                    'Accept' : 'application/json',
                    'Content-Type': 'application/json',
                },
                method : "POST",
                body: JSON.stringify({ request_detail })
            })
            .then(res=>res.json())
            .then(data=>{
                // console.log(data);
                const _r = { isSuccess: true }
                toggleDoctorRequestModal(_r)
            })
            .catch(e=>{
                const _r = { isSuccess: false }
                toggleDoctorRequestModal(_r)
            })
        }
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

    function _switchTabType(type) {
        document.querySelectorAll('.tab-item').forEach(item=>item.classList.add('d-none'))
        document.querySelector(`#${type}`).classList.remove('d-none')
    }
</script>

<?php require_once(__DIR__.'/modal.inc.php'); ?>