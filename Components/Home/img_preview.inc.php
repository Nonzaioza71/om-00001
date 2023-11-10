<div class="d-none" id="modalPreview">
    <div class="col-12 h-100vh fixed-top bg-dark-50" onclick="_toggleImgPreview('', false)">
    </div>
    <div class="container fixed-top pt-5">
        <img id="img_preview" src="" alt="" srcset="" class="w-100">
    </div>
</div>
<script>
    function _toggleImgPreview(url, show) {
        if (url) {
            document.querySelector('#img_preview').setAttribute('src', url)
        }
        show
        ? document.querySelector('#modalPreview').classList.remove('d-none')
        : document.querySelector('#modalPreview').classList.add('d-none')
    }
</script>