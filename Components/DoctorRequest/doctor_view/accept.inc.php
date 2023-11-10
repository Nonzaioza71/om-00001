<pre><?php
        // print_r($doctor_requests_approve_list);
        ?></pre>
<div class="col-12 p-5">
    <h1>รับเคสผู้ป่วย/ผู้ใช้งาน</h1>
    <hr>
    <div class="col-12">
        <table class="table table-striped">
            <tr>
                <th>
                    ลำดับ
                </th>
                <th>
                    เนื่องจาก
                </th>
                <th>
                    ผู้ป่วย
                </th>
                <th>
                    วันที่
                </th>
                <th>
                    #
                </th>
            </tr>
            <?php for ($i=0; $i < count($doctor_requests_approve_list); $i++) { $item = $doctor_requests_approve_list[$i] ?>
                <tr>
                    <td>
                        <?php echo $i+1?>
                    </td>
                    <td>
                        <pre><?php echo $item['detail'] ?></pre>
                    </td>
                    <td>
                        <?php echo $item['user_prefix'].$item['user_name']." ".$item['user_lastname']?>
                    </td>
                    <td>
                        <?php echo $item['reply_date']?>
                    </td>
                    <td>
                        <button class="btn btn-success" onclick="cancelDoctorRequest(<?php echo $item['id']?>)">Success</button>
                    </td>
                </tr>
            <?php }?>
        </table>
    </div>
    <div class="card container pt-3 pb-5 ps-3">
        <h3>รายละเอียดใบขอพบ</h3>
        <div class="col-12 row mt-3 ps-5">
            <div class="col-4">
                <label for="">แจ้งโดย</label>
                <p><?php echo
                    $doctor_request['user_prefix'] .
                        $doctor_request['user_name'] .
                        " " .
                        $doctor_request['user_lastname']
                    ?></p>
            </div>
            <div class="col-4">
                <label for="">เกิดเมื่อวันที่</label>
                <p><?php echo $doctor_request['user_birthday'] ?></p>
            </div>
            <div class="col-4">
                <label for="">เพศ</label>
                <p><?php echo $doctor_request['gender_th'] ?></p>
            </div>
            <div class="col-4">
                <label for="">เป็นสมาชิกเมื่อ</label>
                <p><?php echo $doctor_request['add_date'] ?></p>
            </div>
            <div class="col-4">
                <label for="">สถานะ</label>
                <p><?php echo $doctor_request['status_th'] ?></p>
            </div>
            <div class="col-4">
                <label for="">แจ้งมาเมื่อ</label>
                <p><?php echo $doctor_request['sign_date'] ?></p>
            </div>
            <div class="col-12 mt-5">
                <label>รายละเอียดการขอเข้าพบ</label>
                <p>
                    <?php echo $doctor_request['detail'] ?>
                </p>
            </div>
        </div>
    </div>

    <div class="card container pt-3 pb-5 ps-3">
        <h3>กรอกข้อมูลวันนัดพบ</h3>
        <div class="col-12 row mt-3 ps-5">
            <div class="col-4">
                <label for="">วันที่</label>
                <input type="date" onChange="_handleDateUpdate(this.value)" class="d-hidden" style="width: 0px;" name="datepicker" id="datepicker">
                <!-- <button type="button" class="btn btn-primary" onClick="">เลือกวันที่</button> -->
                <input type="text" name="reply_date" id="reply_date" onClick="document.querySelector('#datepicker').showPicker()" class="form-control">
            </div>
            <div class="col-4 align-self-end">
                <label for="">เวลา</label>
                <input type="time" class="form-control" id="reply_time">
            </div>
            <div class="col-4 align-self-end">
                <label for="">แพทย์</label>
                <input type="text" value="
                        <?php echo
                        $user['user_prefix'] .
                            $user['user_name'] .
                            ' ' .
                            $user['user_lastname']
                        ?>
                    " class="form-control" readonly>
                    <input type="text" id="doctor_id" class="d-none" value="<?php echo $user['user_id']?>" >
                    <input type="text" id="req_id" class="d-none" value="<?php echo $_GET['id']?>" >
            </div>
            <div class="col-12 mt-3">
                <label>รายละเอียด</label>
                <textarea name="reply_detail" id="reply_detail" cols="30" rows="10" class="form-control"></textarea>
            </div>
        </div>
        <button class="btn btn-success mt-5" onclick="_handleSubmit()">รับเคส</button>
    </div>

</div>

<script>
    document.querySelector('#reply_date').setAttribute('placeholder', new Date().toLocaleDateString('en-GB'))

    function _handleDateUpdate(val) {
        document.querySelector('#reply_date').value = new Date(val).toLocaleDateString('en-GB');
    }

    function _handleSubmit(){
        const reply_date = document.querySelector('#reply_date').value
        const reply_time = document.querySelector('#reply_time').value
        const reply_detail = document.querySelector('#reply_detail').value
        const doctor_id = document.querySelector('#doctor_id').value
        const req_id = document.querySelector('#req_id').value

        const reply = `นัดหมายวันที่ : ${reply_date} \n เวลา : ${reply_time} \n รายละเอียด : ${reply_detail}`
        const _date = `${reply_date} - ${reply_time}`

        fetch('./Controllers/acceptDoctorRequestByID.php', {
                headers: {
                    'Accept' : 'application/json',
                    'Content-Type': 'application/json',
                },
                method : "POST",
                body: JSON.stringify({ reply, req_id, doctor_id, _date })
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

    function cancelDoctorRequest(case_id){
        console.log(case_id)
        fetch('Controllers/cancelDoctorRequestByID.php',{
            headers: {
                'Accept' : 'application/json',
                'Content-Type': 'application/json',
            },
            method : "POST",
            body: JSON.stringify({ id: case_id })
        })
        .then(res=>res.json())
        .then(data=>{
            // console.log(data);
            const _r = { isSuccess: true, refresh: true }
            toggleDoctorRequestModal(_r)
        })
        .catch(e=>{
            const _r = { isSuccess: false, refresh: true }
            toggleDoctorRequestModal(_r)
        })
    }
</script>

<?php require_once(__DIR__.'/../modal.inc.php'); ?>