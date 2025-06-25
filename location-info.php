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
    <title>Location & Information - Tropical Tides</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <div class="hero-location-information">
        <div class="hero-overlay"></div>
        <div class="header-absolute">
            <?php include "include/header.php"; ?>
        </div>
        <div class="hero-content">
            <div class="hero-title">Location & Information</div>
        </div>
    </div>
    <div class="section founded">
        <div class="founded-text">
            <h2 style="margin-top:0; font-size:1.4em; font-weight:bold; color:#222;">About Tropical Tides</h2>
            <p style="color:#222; font-size:1.05em;">
                Tropical Tides is there for people who want to experience exciting trips but have difficulty organizing them. We take all the worries off your hands, so you can just enjoy the adventure. Whether you dream of discovering hidden bays, snorkeling among colorful fish, or just relaxing on a sun-drenched beach – we take care of it for you.            </p>
            <p style="color:#222; font-size:1.05em;">
                Our mission is to make travel accessible and stress-free for everyone. We offer fully organized packages to tropical destinations, including transportation, accommodation, and unique activities. This way, you can enjoy an unforgettable vacation worry-free, whether alone, with friends, or with the whole family.            </p>
        </div>
        <div class="founded-img">
            <img src="https://images.unsplash.com/photo-1506744038136-46273834b3fb?auto=format&fit=crop&w=800&q=80" alt="Tropical Tides locatie">
        </div>
    </div>
    <div class="section-title">Our Location</div>
    <div class="section best">
        <div class="what-we-do">
            <div class="do-item">
                <img src="/assets/img/pathway.png" alt="Locatie">
                <div class="do-title snorkel">Head office</div>
                <small>Our headquarters is located by the coast, where we draw inspiration from the sea and the beach every day. Here we plan your dream trip in detail.</small>
            </div>
            <div class="do-item">
                <img src="/assets/img/sun.png" alt="Contact">
                <div class="do-title sun">Contact & Service</div>
                <small>Do you have questions or special requests? Our team is always ready to assist you, both before and during your trip.</small>
            </div>
            <div class="do-item">
                <img src="/assets/img/wave.png" alt="Tropische Bestemmingen">
                <div class="do-title boat">Tropical Destinations</div>
                <small>From the Caribbean to Southeast Asia: we know the most beautiful places and ensure that you can enjoy them stress-free.</small>
            </div>
        </div>
    </div>
    <?php include "include/footer.php"; ?>
</body>
</html> 