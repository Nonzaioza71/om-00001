<div class="col-12 ps-3 pe-3 pt-5 bg-success-50">
    <h1 class="text-center">แบบประเมิน</h1>
    <hr>
    <div class="col-12 pt-5 pb-5 mb-5">

        <?php for ($i=0; $i < count($estiamtes_list); $i++) { $item = $estiamtes_list[$i]; ?>
            <div class="card mb-3 p-5 bg-info-50">
                <h3><?php echo $item['estimate_title'] ?></h3>
                <div class="col-12 btn-group">
                    <select class="form-select bg-primary-50 text-light fs-3" name="estimate_item" id="estimate_item">
                        <option value="5">ดีมาก</option>
                        <option value="5">ดี</option>
                        <option value="5">พอใช้</option>
                        <option value="5">แย่</option>
                        <option value="5">แย่มาก</option>
                    </select>
                </div>
            </div>
        <?php }?>

        <div class="col-12">
            <button class="btn btn-lg btn-success w-100" onclick="_handleSubmit()">
                <h3>
                ส่งการประเมิน
                </h3>
            </button>
        </div>

    </div>
</div>
<script>
    function _handleSubmit() {
        const items = document.querySelectorAll('#estimate_item')
        const data = []
        items.forEach((item, idx)=>{
            data.push({estimate_id : (idx+1), estimate_score: item.value})
        })
        fetch('Controllers/EstimateScoreByUser.php', {
            headers: {
                "Accept": 'application/json',
                "Content-Type": 'application/json'
            },
            method: "POST",
            body: JSON.stringify({
                data
            })
        })
        .then(res=>res.json())
        .then(data=>{
            console.log();
            if (data) {
                window.history.back()
            } else {
                getEle('#errorPage').classList.remove('d-none')
            }
        })
    }
</script>