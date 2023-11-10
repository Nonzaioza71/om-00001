<div class="col-12">
    <div class="col-12"></div>
    <div class="col-12 bg-info-50 pt-5 pb-5">
        <div class="container">
            <?php for ($i = 0; $i < count($boards_list); $i++) {
                $item = $boards_list[$i] ?>
                <div class="card container mb-3">
                    <div class="col-12 p-5">
                        <h1 class="text-start"><?php echo $item['board_title'] ?></h1>
                        <pre class="fs-3 text-start"><?php echo $item['board_detail'] ?></pre>
                        <div class="container mb-3">
                            <img src="<?php echo $item['board_image'] ?>" onclick="_toggleImgPreview('<?php echo $item['board_image'] ?>', true)" class="btn btn-outline-dark w-100 cursor-pointer" alt="" srcset="">
                        </div>
                        <div class="container d-flex justify-content-end">
                            <a href="?app=Home&view=detail&id=<?php echo $item['id'] ?>" class="align-self-center" id="comments_count">ความคิดเห็นอีก <?php echo $item['comments_count'] ?> รายการ</a>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</div>
<script>
    function _resizeCommentsCount() {

        if (window.innerWidth >= 406) {
            document.querySelectorAll('#comments_count').forEach(item => item.classList.add('fs-3'))
            document.querySelectorAll('#comments_count').forEach(item => item.classList.remove('fs-6'))
        }else if(window.innerWidth < 406 && window.innerWidth > 373){
            document.querySelectorAll('#comments_count').forEach(item => item.classList.add('fs-6')) 
            document.querySelectorAll('#comments_count').forEach(item => item.classList.remove('fs-3'))
        }
    }
    window.addEventListener("load", _resizeCommentsCount)
    window.addEventListener("resize", _resizeCommentsCount)
</script>
<?php require_once(__DIR__.'/img_preview.inc.php'); ?>