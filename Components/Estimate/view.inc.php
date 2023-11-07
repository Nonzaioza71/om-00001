<div class="col-12 pt-5 pb-5">
    <div class="col-12 d-flex justify-content-center">
        <div class="col-10">
            <div class="row">
                <h1>การประเมิน</h1>
            </div>
            <hr>
        </div>
    </div>
    <div class="col-12 pb-5">
        <div class="col-12 align-items-center">
            <div class="col-10 m-auto">
                <table class="table table-striped">
                    <?php for ($i = 0; $i < count($estimate_choices); $i++) { $item = $estimate_choices[$i] ?>
                        <tr>
                            <td>
                                <div class="mt-5 mb-5">
                                    <h2><?php echo ($i+1).". ".$item['estimate_title']?></h2>
                                    <div class="btn-group mb-3 w-100 mt-5">
                                        <button class="btn btn-lg btn-danger border" id="btn_<?php echo $i?>" onclick="estimateScore(this, <?php echo $i?>, 1)">
                                            <h4>แย่มาก</h4>
                                        </button>
                                        <button class="btn btn-lg btn-danger border" id="btn_<?php echo $i?>" onclick="estimateScore(this, <?php echo $i?>, 2)">
                                            <h4>แย่</h4>
                                        </button>
                                        <button class="btn btn-lg btn-warning border" id="btn_<?php echo $i?>" onclick="estimateScore(this, <?php echo $i?>, 3)">
                                            <h4>พอใช้</h4>
                                        </button>
                                        <button class="btn btn-lg btn-success border" id="btn_<?php echo $i?>" onclick="estimateScore(this, <?php echo $i?>, 4)">
                                            <h4>ดี</h4>
                                        </button>
                                        <button class="btn btn-lg btn-success border" id="btn_<?php echo $i?>" onclick="estimateScore(this, <?php echo $i?>, 5)">
                                            <h4>ดีมาก</h4>
                                        </button>
                                    </div>
                                    <div class="col-12">
                                        <button class="btn btn-lg btn-primary d-none w-100" id="btn_edit_<?php echo $i?>" onclick="estimateScoreEdit(<?php echo $i?>)">แก้ไข</button>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    <?php } ?>
                </table>
            </div>
            <div class="col-10 m-auto">
                <button class="btn btn-lg btn-success w-100 d-none" id="btn_submit" onclick="_handleSubmit()">
                    <h3>ยืนยัน</h3>
                </button>
            </div>
        </div>
    </div>
</div>

<script>
    let score = {
        <?php for ($i=0; $i < count($estimate_choices); $i++) { ?>
            "unit_<?php echo $estimate_choices[$i]['id']?>" : 0 ,
        <?php }?>
    }
    function estimateScore(ele, id, point) {
        const btns = document.querySelectorAll('#btn_'+id)
        document.querySelector("#btn_edit_"+id).classList.remove('d-none')
        btns.forEach((item, idx)=>{
            item.setAttribute('disabled', true)
        })
        ele.removeAttribute('disabled')
        score['unit_'+(id+1)] = point
        toggleSubmitButton()
    }
    function estimateScoreEdit(id){
        const btns = document.querySelectorAll('#btn_'+id)
        document.querySelector("#btn_edit_"+id).classList.add('d-none')
        btns.forEach((item, idx)=>{
            item.removeAttribute('disabled')
        })
        score['unit_'+(id+1)] = 0
        toggleSubmitButton()
    }
    function toggleSubmitButton() {
        document.querySelector('#btn_submit').classList.remove('d-none')
        Object.keys(score).forEach(key=>{
            score[key] == 0 && document.querySelector('#btn_submit').classList.add('d-none')
        })
    }
    function _handleSubmit() {
        let data = Object.keys(score).map(key=>{
            const id = parseInt(key.replace('unit_', ''))
            return { estimate_id: id, estimate_score: score[key] }
        })
        fetch('Controllers/EstimateScoreByUser.php', {
            headers: {
                "Accept" : "application/json",
                "Content-Type" : "application/json"
            },
            method: "POST",
            body: JSON.stringify({data})
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

<?php require_once(__DIR__.'/modal.inc.php'); ?>