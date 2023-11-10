<div class="container mb-3 pt-5 pb-5 bg-info-50">
    <div class="col-12 card p-5 mb-3">
        <h1><?php echo $board_data['board_title'] ?></h1>
        <pre class="fs-3"><?php echo $board_data['board_detail'] ?></pre>
        <div class="container mb-3">
            <img src="<?php echo $board_data['board_image'] ?>" class="w-100" alt="" srcset="">
        </div>
        <div class="container d-flex justify-content-end">
            <h2 class="align-self-center">ความคิดเห็นอีก <span id="comment_count"><?php echo $board_data['comments_count'] ?></span> รายการ</h2>
        </div>
    </div>
    <div class="col-12 mb-3">
        <button class="btn btn-lg btn-primary w-100">
            แสดงความคิดเห็น
        </button>
    </div>
    <div class="list-group">
        <div id="comment_list" class="list-group mb-3">

        </div>
        <?php if (isset($user)) { ?>
            <div class="list-group-item list-group-action p-3">
                <h2><?php echo $user['user_prefix'] . $user['user_name'] . " " . $user['user_lastname'] ?></h2>
                <hr>
                <div class="mb-3">
                    <h3 for="comment_msg" class="form-label">ความคิดเห็น</h3>
                    <textarea class="form-control fs-3" name="comment_msg" id="comment_msg" rows="3"></textarea>
                </div>
                <div class="col-12 d-flex justify-content-end">
                    <button class="btn btn-lg btn-primary ps-5 pe-5" onclick="_handleSubmit()">
                        ส่ง
                    </button>
                </div>
            </div>
        <?php } ?>
    </div>
</div>
<input type="text" class="d-none" id="board_id" value="<?php echo $_GET['id'] ?>">
<script>
    function _handleSubmit() {
        const comment_msg = document.querySelector('#comment_msg').value
        const board_id = document.querySelector('#board_id').value
        const check = Boolean(comment_msg.length > 0)
        if (check) {
            fetch('Controllers/insertReplyBoardByID.php', {
                    headers: {
                        'Accept': 'application/json',
                        'Content-Type': 'application/json',
                    },
                    method: "POST",
                    body: JSON.stringify({
                        comment_msg,
                        board_id
                    })
                })
                .then(res => res.text())
                .then(data => {
                    // console.log(data);
                    _loadComment()
                    document.querySelector('#comment_msg').value = ""
                })
        }
    }

    function _loadComment() {
        const comment_msg = document.querySelector('#comment_msg')
        const board_id = document.querySelector('#board_id').value
        const comment_list = document.querySelector('#comment_list')
        const comment_count = document.querySelector('#comment_count')
        fetch('Controllers/getBoardCommentByID.php', {
                headers: {
                    'Accept': 'application/json',
                    'Content-Type': 'application/json',
                },
                method: "POST",
                body: JSON.stringify({
                    board_id
                })
            })
            .then(res => res.json())
            .then(data => {
                let ele = ""
                data.forEach((item, idx) => {
                    ele += `
                    <div class="list-group-item list-group-action p-3">
                        <h2 class="mb-3">${item['user_prefix'] + item['user_name']+ " " + item['user_lastname']}</h2>
                        <div class="mb-3">
                            <pre class="fs-3" readOnluy rows="3">${item['user_msg']}</pre>
                        </div>
                    </div>
                    `
                })
                comment_list.innerHTML = ele
                comment_count.innerHTML = data.length
            })
    }

    function _scrollToBottom() {
        window.scrollTo({
            top: document.body.scrollHeight
        })
    }

    function _scrollToTop() {
        window.scrollTo({
            top: 0
        })
    }

    _loadComment()
    setInterval(_loadComment, 1000)
</script>