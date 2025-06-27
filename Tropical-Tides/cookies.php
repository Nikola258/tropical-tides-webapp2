<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cookies - Tropical Tides</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <div class="hero-ck">
        <div class="hero-overlay"></div>
        <div class="header-absolute">
            <?php include "include/header.php"; ?>
        </div>
        <div class="hero-content">
            <div class="hero-title">Cookies on Tropical Tides</div>
        </div>
    </div>
    <div class="section founded">
        <div class="founded-text">
            <h2 style="margin-top:0; font-size:1.4em; font-weight:bold; color:#222;">Cookies op Tropical Tides</h2>
            <p style="color:#222; font-size:1.05em;">
                Our website uses cookies to improve your experience. Cookies are small text files that are stored on your device. They help us to make the website work properly and to remember, for example, that you have accepted our cookie notice.            </p>
            <p style="color:#222; font-size:1.05em;">
                You can always adjust your cookie preferences by accepting or rejecting the cookie notice. (Note: at this moment, refusing cookies has no impact on the functionality of the site, but you will receive fewer notifications!)            </p>
        </div>
        <div class="founded-img">
            <img src="https://images.unsplash.com/photo-1519125323398-675f0ddb6308?auto=format&fit=crop&w=800&q=80" alt="Cookies">
        </div>
    </div>
    <div class="section-title">Your choice</div>
    <div class="section best">
        <div class="what-we-do">
            <div class="do-item">
                <img src="/assets/img/pathway.png" alt="Cookies accepteren">
                <div class="do-title snorkel">Accept cookies</div>
                <small>By accepting cookies, you get the best experience on our website.</small>
            </div>
            <div class="do-item">
                <img src="/assets/img/sun.png" alt="Cookies weigeren">
                <div class="do-title sun">Reject cookies</div>
                <small>You can decline cookies, but the site will continue to function.</small>
            </div>
        </div>
    </div>
    <?php include "include/footer.php"; ?>
</body>
</html> 