<?php
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="assets/css/index.css">
    <title>Document</title>
</head>
<body>
    <div class="header-bar">
        <div class="header-logo">
            <img src="assets/img/logo.png" alt="Tropical Tides Logo" style="height:215px; vertical-align:middle;">
        </div>
        <nav class="header-nav">
            <a href="/index.php">Home</a>
            <a href="/about.php">About</a>
            <a href="/booking.php">Booking</a>
            <?php if (isset($_SESSION['user_id'])): ?>
                <a href="/user-dashboard.php">Dashboard</a>
            <?php else: ?>
                <a href="/auth-views/login.php">Login</a>
            <?php endif; ?>
        </nav>
    </div>
</body>
</html>

<script>
// Simple cookie popup logic
function setCookie(name, value, days) {
    var expires = "";
    if (days) {
        var date = new Date();
        date.setTime(date.getTime() + (days*24*60*60*1000));
        expires = "; expires=" + date.toUTCString();
    }
    document.cookie = name + "=" + (value || "")  + expires + "; path=/";
}
function getCookie(name) {
    var nameEQ = name + "=";
    var ca = document.cookie.split(';');
    for(var i=0;i < ca.length;i++) {
        var c = ca[i];
        while (c.charAt(0)==' ') c = c.substring(1,c.length);
        if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length,c.length);
    }
    return null;
}
window.addEventListener('DOMContentLoaded', function() {
    if (!getCookie('tropical_tides_cookies')) {
        var popup = document.createElement('div');
        popup.className = 'cookie-popup';
        popup.innerHTML = `
            Deze website gebruikt cookies om je ervaring te verbeteren.
            <button id="accept-cookies">Accepteren</button>
            <button id="decline-cookies">Weigeren</button>
        `;
        document.body.appendChild(popup);
        document.getElementById('accept-cookies').onclick = function() {
            setCookie('tropical_tides_cookies', 'accepted', 365);
            popup.remove();
        };
        document.getElementById('decline-cookies').onclick = function() {
            setCookie('tropical_tides_cookies', 'declined', 365);
            popup.remove();
        };
    }
});
</script>