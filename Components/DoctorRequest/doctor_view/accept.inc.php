<div class="col-12 mt-5">
    <h1>รับเคสผู้ขอพบ</h1>
    <hr>

    <div class="col-12 mt-5 card shadow p-5">
        <h1>รายการนัดก่อนหน้านี้</h1>
        <table class="table table-striped mt-3">
            <tr>
                <th>ลำดับ</th>
                <th>ผู้เข้าพบ</th>
                <th>รายละเอียด</th>
                <th>วันที่นัดพบ</th>
                <th>#</th>
            </tr>

            <?php for ($i = 0; $i < count($doctor_requests_list_approve_by_me); $i++) {
                $item = $doctor_requests_list_approve_by_me[$i]; ?>
                <tr>
                    <td><?php echo $i + 1 ?></td>
                    <td><?php echo $item['user_prefix'] . $item['user_name'] . " " . $item['user_lastname'] ?></td>
                    <td><?php echo $item['detail'] ?></td>
                    <td><?php echo $item['reply_date'] ?></td>
                    <td>
                        <button class="btn btn-success">Success</button>
                    </td>
                </tr>
            <?php } ?>

        </table>
    </div>

    <div class="col-12 mt-5 card shadow p-5">
        <h1>รายละเอียดใบขอพบ</h1>
        <hr>
        <div class="col-12 row">
            <div class="col-4">
                <h4 class="text-center">จาก <?php echo $request_data['user_prefix'] . $request_data['user_name'] . " " . $request_data['user_lastname'] ?></h4>
            </div>
            <div class="col-4">
                <h4 class="text-center">เกิดวันที่ <?php echo $request_data['user_birthday'] ?></h4>
            </div>
            <div class="col-4">
                <h4 class="text-center">จาก <?php echo $request_data['user_prefix'] . $request_data['user_name'] . " " . $request_data['user_lastname'] ?></h4>
            </div>
            <div class="col-12 mt-5">
                <h4>
                    รายละเอียด
                </h4>
                <pre class="fs-5 w-100">
                    <?php echo $request_data['detail'] ?>
                </pre>
            </div>
        </div>
    </div>

    <div class="col-12 mt-5 card shadow p-5">
        <h1>กรอกรายละเอียดการเข้าพบ</h1>
        <div class="col-12 row">
            <div class="col-4">
                <h4>วันที่</h4>
                <input type="date" name="reply_date" id="reply_date" class="form-control">
            </div>
            <div class="col-4">
                <h4>เวลา</h4>
                <input type="time" name="reply_time" id="reply_time" class="form-control">
            </div>
            <div class="col-4">
                <h4>โดย</h4>
                <input type="text" id="doctor_name" value="<?php echo $user['user_prefix'] . $user['user_name'] . " " . $user['user_lastname'] ?>" class="form-control">
                <input type="text" name="doctor_id" value="<?php echo $user['user_id'] ?>" id="doctor_id" class="d-none">
                <input type="text" name="req_id" value="<?php echo $request_data['id'] ?>" id="req_id" class="d-none">
            </div>
            <div class="col-12 mt-5">
                <h4>รายละเอียด</h4>
                <textarea name="reply" id="reply" cols="30" rows="10" class="form-control"></textarea>
            </div>
        </div>
        <div class="col-12 mt-3">
            <button class="btn btn-success ps-5 pe-5" onclick="_handleSubmit()">
                ยืนยัน
            </button>
        </div>
    </div>

</div>

<script>
    function _handleSubmit() {
        const reply_date = getEle('#reply_date').value
        const reply_time = getEle('#reply_time').value
        const doctor_id = getEle('#doctor_id').value
        const req_id = getEle('#req_id').value
        const doctor_name = getEle('#doctor_name').value
        const reply = `วันที่ : ${reply_time} | เวลา ${reply_time} \n ${getEle('#reply').value} \n โดย ${doctor_name}`

        fetch('Controllers/acceptDoctorRequestByID.php', {
                headers: {
                    "Accept": 'application/json',
                    "Content-Type": 'application/json'
                },
                method: "POST",
                body: JSON.stringify({
                    req_id,
                    doctor_id,
                    reply,
                    _date: reply_date + ' - ' + reply_time
                })
            })
            .then(res => res.json())
            .then(data => {
                // console.log(data);
                if (data) {
                    window.history.back()
                } else {
                    getEle('#errorPage').classList.remove('d-none')
                }
            })
    }
</script>