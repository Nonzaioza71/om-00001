<script>
    fetch('./Controllers/userConnected.php')
    .then(res=>res.json())
    .then(data=>console.log('connection : ', data))
    .catch(e => console.log('connection error : ', e))
</script>