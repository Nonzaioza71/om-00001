<div class="col-12 card mt-5 p-5 mb-5">
    <div class="col-12 d-flex">
        <h1>ขอวันนัดพบหมด</h1>
    </div>
    <hr>
    <div>
        <textarea class="form-control mb-5" name="user_request" id="user_request" cols="30" rows="10"></textarea>
        <button class="btn btn-lg btn-success w-100" onclick="_handleSubmit()">
            <h1>ขอคำขอนัดหมอ</h1>
        </button>
    </div>
    <div class="col-12">
        <h2>รายการนัดหมอ</h2>
        <div class="col-12">

            <?php for ($i=0; $i < count($doctor_requests_list_waiting); $i++) { $item = $doctor_requests_list_waiting[$i]; ?>
                <div class="card p-5 mb-3 <?php 
                        if ($item['status'] == 'waiting') {
                            echo 'bg-warning-50';
                        } else {
                            echo 'bg-success-50';
                        }
                        
                    ?>">
                    <h3>ขอไปเมื่อ <?php echo $item['sign_date'] ?></h3>
                    <h3>สถานะ <?php echo $item['status_th'] ?></h3>
                    <hr>
                    <h4>รายละเอียด</h4>
                    <pre class="fs-5"> <?php echo $item['reply'] ?></pre>
                </div>
            <?php }?>

            <?php for ($i=0; $i < count($doctor_requests_list_approve); $i++) { $item = $doctor_requests_list_approve[$i]; ?>
                <div class="card p-5 mb-3 <?php 
                        if ($item['status'] == 'waiting') {
                            echo 'bg-warning-50';
                        } else {
                            echo 'bg-success-50';
                        }
                        
                    ?>">
                    <h3>ขอไปเมื่อ <?php echo $item['sign_date'] ?></h3>
                    <h3>สถานะ <?php echo $item['status_th'] ?></h3>
                    <hr>
                    <h4>รายละเอียด</h4>
                    <pre class="fs-5"> <?php echo $item['reply'] ?></pre>
                </div>
            <?php }?>

        </div>
    </div>

</div>

<script>
    function _handleSubmit() {
        const request_detail = getEle('#user_request').value
        fetch('Controllers/insertDoctorRequest.php', {
            headers: {
                "Accept": 'application/json',
                "Content-Type": 'application/json'
            },
            method: "POST",
            body: JSON.stringify({
                request_detail
            })
        })
        .then(res=>res.json())
        .then(data=>{
            console.log();
            if (data) {
                window.location.reload()
            } else {
                getEle('#errorPage').classList.remove('d-none')
            }
        })
    }
</script>