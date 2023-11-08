<script>
    fetch('./Controllers/userConnected.php')
    .then(res=>res.json())
    .then(data=>console.log('connection : ', data))
    .catch(e => console.log('connection error : ', e))

    setInterval(()=>{
        fetch('Controllers/checkUserIsBanned.php')
        .then(res=>res.json())
        .then(data=>{
            const isBanned = data
            if (isBanned) {
                alert("บัญชีนี้ถูกระงับการใช้งานจากผู้ดูแล")
                window.location.href = '?app=Logout'
            }
        })
    }, 5000)
</script>