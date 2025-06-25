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
    <title>Terms of Service - Tropical Tides</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/terms-of-service.css">
    </head>
<body>
    <div class="hero-overlay-ts">
        <div class="hero-overlay"></div>
        <div class="header-absolute">
            <?php include "include/header.php"; ?>
        </div>
        <div class="hero-content">
            <div class="hero-title">Terms of Service</div>
        </div>
    </div>
    <div class="section founded">
        <div class="founded-text">
            <h2 style="margin-top:0; font-size:1.4em; font-weight:bold; color:#222;">General Terms and Conditions</h2>
            <p style="color:#222; font-size:1.05em;">
                By using the services of Tropical Tides, you agree to our general terms and conditions. We strive to make your travel experience as smooth and enjoyable as possible. Please read the conditions below carefully.            </p>
            <ul style="color:#222; font-size:1.05em; padding-left: 18px;">
                <li><b>Bookings:</b> All bookings are only final after receipt of a confirmation and payment. </li>
                <li><b>Cancellations:</b> Cancellations can be made up to 14 days before departure. After that, cancellation fees may be applied.  </li>
                <li><b>Payment:</b> Payments must be fully completed before the start of the trip. </li>
                <li><b>Liability:</b> Tropical Tides is not liable for damages, loss, or injury during the trip, unless there is gross negligence involved. </li>
                <li><b>Changes:</b> We reserve the right to adjust trips or activities in unforeseen circumstances. </li>
                <li><b>Privacy:</b> Your data will be treated confidentially, as described in our privacy policy.</li>
            </ul>
        </div>
        <div class="founded-img">
            <img src="https://images.unsplash.com/photo-1507525428034-b723cf961d3e?auto=format&fit=crop&w=800&q=80" alt="Terms of Service">
        </div>
    </div>
    <div class="section-title">Questions?</div>
    <div class="section best">
        <div class="what-we-do">
            <div class="do-item">
                <img src="/assets/img/pathway.png" alt="Contact">
                <div class="do-title snorkel">Contact</div>
                <small>If you have questions about our terms, feel free to contact us, we are happy to assist you further.</small>
            </div>
            <div class="do-item">
                <img src="/assets/img/sun.png" alt="Flexibiliteit">
                <div class="do-title sun">Flexibility</div>
                <small>We are happy to help you if your travel plans change or if you have special requests.</small>
            </div>
            <div class="do-item">
                <img src="/assets/img/wave.png" alt="Zorgeloos Boeken">
                <div class="do-title boat">Carefree Books</div>
                <small>With clear conditions and transparent communication, you can book with peace of mind.</small>
            </div>
        </div>
    </div>
    <?php include "include/footer.php"; ?>
</body>
</html> 