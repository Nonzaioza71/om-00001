<div class="col-12 bg-success-50 p-3">
    <?php for ($i=0; $i < count($boards_list); $i++) { $item = $boards_list[$i]; ?>

        <div class="card col-12 p-5 mb-3">
            <h1><strong><?php echo $item['board_title'] ?></strong></h1>
            <div class="col-12">
                <textarea class="fs-4 col-12 border-0" readonly><?php echo $item['board_detail'] ?></textarea>
            </div>
            <img src="<?php echo $item['board_image'] ?>" alt="" srcset="" class="w-100">
            <div class="col-12 mt-3">
                <a class="w-100 fs-4" href="?app=home&view=Board&idx=<?php echo $i ?>">ความคิดเห็นอีก <?php echo $item['comments_count']; ?> รายการ</a>
                <h4>เข้าชม <?php echo $item['board_view']; ?> ครั้ง</h4>
            </div>
        </div>

    <?php }?>
</div>