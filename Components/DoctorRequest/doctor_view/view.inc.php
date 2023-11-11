<div class="col-12 mt-5">
    <h1>รายการเคสผู้ขอเข้าพบ</h1>
    <hr>
    <div class="col-12">

        <?php for ($i = 0; $i < count($doctor_requests_list_waiting); $i++) {
            $item = $doctor_requests_list_waiting[$i]; 
            if ($item['status'] == 'waiting') {
        ?>
            <div class="col-12 p-5 pb-3 card bg-warning-50">
                <h3>ขอไปเมื่อ <?php echo $item['sign_date'] ?></h3>
                <h3>สถานะ <?php echo $item['status_th'] ?></h3>
                <h3>จาก <?php echo $item['user_prefix'].$item['user_name']." ".$item['user_lastname'] ?></h3>
                <hr>
                <h4>รายละเอียด</h4>
                <pre class="fs-5"> <?php echo $item['detail'] ?></pre>
                <button class="btn btn-success w-100" onclick="to('?app=doctor_request&view=accept&idx=<?php echo $i?>')">
                    รับเคสผู้ขอพบคนนี้
                </button>
            </div>
        <?php }} ?>

        <?php for ($i = 0; $i < count($doctor_requests_list_approve_by_me); $i++) {
            $item = $doctor_requests_list_approve_by_me[$i]; 
        ?>
            <div class="col-12 p-5 pb-3 card bg-success-50">
                <h3>ขอไปเมื่อ <?php echo $item['sign_date'] ?></h3>
                <h3>สถานะ <?php echo $item['status_th'] ?></h3>
                <h3>จาก <?php echo $item['user_prefix'].$item['user_name']." ".$item['user_lastname'] ?></h3>
                <hr>
                <h4>รายละเอียด</h4>
                <pre class="fs-5"> <?php echo $item['detail'] ?></pre>
            </div>
        <?php } ?>

    </div>
</div>