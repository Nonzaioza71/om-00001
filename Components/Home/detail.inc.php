<?php
$board_data = $boards_list[$_GET['idx']]
?>

<div class="col-12 mb-5">
    <div class="col-12 mt-5 card p-5 mb-3">
        <h1><?php echo $board_data['board_title'] ?></h1>
        <pre class="fs-5"><?php echo $board_data['board_detail'] ?></pre>
        <img src="<?php echo $board_data['board_image'] ?>" alt="" srcset="" class="w-100">
        <h4 class="mt-5">ความคิดเห็นทั้งหมด <span id="comments_count"></span> รายการ</h4>
    </div>

    <div class="col-12 mb-3" id="comments_list">

    </div>

    <div class="col-12 card p-5 mb-5">
        <h3>ความคิดเห็น</h3>
        <textarea name="user_reply" id="user_reply" cols="30" rows="10" class="form-control fs-5"></textarea>
        <input type="text" class="d-none" id="board_id" value="<?php echo $board_data['id'] ?>">
        <input type="text" class="d-none" id="board_view" value="<?php echo $board_data['board_view'] ?>">
        <button class="btn btn-lg btn-primary mt-3" onclick="_handleSubmit()">
            ส่ง
        </button>
    </div>
</div>

<script>
    function _handleSubmit() {
        const user_reply = getEle('#user_reply')
        const board_id = getEle('#board_id').value

        fetch('Controllers/insertReplyBoardByID.php', {
                headers: {
                    "Accept": 'application/json',
                    "Content-Type": 'application/json'
                },
                method: "POST",
                body: JSON.stringify({
                    comment_msg: user_reply.value,
                    board_id
                })
            })
            .then(res => res.json())
            .then(data => {
                console.log();
                if (data) {
                    user_reply.value = ""
                } else {
                    getEle('#errorPage').classList.remove('d-none')
                }
            })
    }

    function _loadComment() {
        const board_id = getEle('#board_id').value
        let eleStr = ''

        fetch('Controllers/getBoardCommentByID.php', {
                headers: {
                    "Accept": 'application/json',
                    "Content-Type": 'application/json'
                },
                method: "POST",
                body: JSON.stringify({
                    board_id
                })
            })
            .then(res => res.json())
            .then(data => {
                if (data) {
                    data.forEach((item, idx) => {
                        if (item['user_id'] != null) {
                            if (item['user_role'] == 'admin') {
                            eleStr += `<div class="card p-5 mb-3">
                                        <div class="col-12 mb-3">
                                            <div class="col-2">
                                                <img src="Templates\\assets\\imgs\\${item['user_role']}_${item['user_gender']}.png" alt="" srcset="" class="icon-xl rounded-circle">
                                            </div>
                                        </div>
                                        <h3>${item['admin_prefix']}${item['admin_name']} ${item['admin_lastname']}</h3>
                                        <pre class="fs-5">${item['user_msg']}</pre>
                                    </div>`
                                }else{
                                eleStr += `<div class="card p-5 mb-3">
                                            <div class="col-12 mb-3">
                                                <div class="col-2">
                                                    <img src="Templates\\assets\\imgs\\${item['user_role']}_${item['user_gender']}.png" alt="" srcset="" class="icon-xl rounded-circle">
                                                </div>
                                            </div>
                                            <h3>${item['user_prefix']}${item['user_name']} ${item['user_lastname']}</h3>
                                            <pre class="fs-5">${item['user_msg']}</pre>
                                        </div>`

                            }
                        }
                    });
                    getEle('#comments_list').innerHTML = eleStr
                    getEle('#comments_count').innerHTML = data.length
                    // console.log(data);
                } else {
                    getEle('#errorPage').classList.remove('d-none')
                }
            })

    }

    function _boardView() {
        const board_view = getEle('#board_view').value
        const board_id = getEle('#board_id').value
        fetch('Controllers/updateBoardView.php', {
            headers: {
                "Accept": 'application/json',
                "Content-Type": 'application/json'
            },
            method: "POST",
            body: JSON.stringify({
                board_view: (parseInt(board_view) + 1),
                board_id,
            })
        })
        .then(res=>res.text())
        .then(data=>console.log(data))
    }

    window.addEventListener("load", _loopLoad)

    function _loopLoad() {
        _boardView()
        setInterval(() => {
            _loadComment()
        }, 1000);
    }
</script>