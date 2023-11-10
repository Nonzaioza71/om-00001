<pre><?php
    // print_r($doctor_requests_list);
?></pre>
<div class="col-12 pt-5">
    <div class="col-12 d-flex justify-content-center">
        <div class="col-10">
            <div class="row">
                <h1>รายการวันขอนัดพบจากผู้ใช้งาน</h1>
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
                        <h3>จาก : 
                            <?php echo 
                                $doctor_requests_list[$i]['user_prefix'].
                                $doctor_requests_list[$i]['user_name']. 
                                " ". 
                                $doctor_requests_list[$i]['user_lastname'] 
                            ?>
                        </h3>
                        <hr>
                        <h4>
                            <pre><?php echo $doctor_requests_list[$i]['detail'] ?></pre>
                        </h4>
                        <button class="btn btn-lg btn-success w-100" onclick="window.location.href = '?app=DoctorRequest&view=Accept&id=<?php echo $doctor_requests_list[$i]['id']?>'">รับเคส</button>
                    </div>
                <?php } ?>

            </div>
        </div>
    </div>
</div>

<?php require_once(__DIR__.'/../modal.inc.php'); ?>