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
    <title>About - Tropical Tides</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
    <div class="hero-about">
        <div class="hero-overlay"></div>
        <div class="header-absolute">
            <?php include "include/header.php"; ?>
        </div>
        <div class="hero-content">
            <div class="hero-title">Let's Dive Into Our Story</div>
        </div>
    </div>
    <div class="section founded">
        <div class="founded-text">
            <h2 style="margin-top:0; font-size:1.4em; font-weight:bold; color:#222;">How we were founded</h2>
            <p style="color:#222; font-size:1.05em;">Tropical Tides was founded out of passion for the ocean, new connections, and a dream of stress-free travels. We believe memories deserve adventure, a touch of perspective—and genuine dreaming with friends. Our enthusiastic team from hidden shores do everything with care, good vibes and the chillest guest environment and every little success.</p>
        </div>
        <div class="founded-img">
            <img src="https://journeyjunket.com/wp-content/uploads/2022/06/1.-Business-Travel-Agents-06242022-1080x721.jpg" alt="How we were founded">
        </div>
    </div>

    <div class="section-title">What we do best</div>
    <div class="section best">
        <div class="what-we-do">
            <div class="do-item">
                <img src="/assets/img/pathway.png" alt="Snorkeling">
                <div class="do-title snorkel">Hidden Cove Snorkeling</div>
                <small>Enjoy unique snorkeling trips to hidden coves and reefs.</small>
            </div>
            <div class="do-item">
                <img src="/assets/img/sun.png" alt="Sunshine">
                <div class="do-title sun">Sunshine Paradise</div>
                <small>Relax on the sunniest beaches with unforgettable activities.</small>
            </div>
            <div class="do-item">
                <img src="/assets/img/wave.png" alt="Boat Tours">
                <div class="do-title boat">Boat Tours</div>
                <small>Explore the coast on our signature boat tours and cruises.</small>
            </div>
        </div>
    </div>

    <div class="section-title">What Makes Us Special</div>
    <div class="section special">
        <div class = "specials-title">
            <p class = "specials-text">At Tropical Tides, we believe in unique experiences and a welcoming atmosphere. Our team is passionate about sharing the beauty of the ocean and making every guest feel at home. Choose us for adventures, relaxation, and memories that last a lifetime.</p>
        </div>

            <div class="specials">
                <div class="special-item">
                    <img src="https://wallpaperaccess.com/full/703686.jpg" alt="Hidden Paradise">
                    <div><b>Discover Hidden Paradise</b></div>
                    <small>Swim with tropical fish and explore secret coves in the clearest waters.</small>
                </div>

                <div class="special-item">
                    <img src="https://static.vecteezy.com/system/resources/previews/027/381/220/non_2x/family-silhouette-playing-on-the-beach-at-sunset-free-photo.jpg" alt="Family Fun">
                    <div><b>Stress-Free Family Fun</b></div>
                    <small>From scenic boat rides to family-friendly activities, we make it easy to relax and play.</small>
                </div>

                <div class="special-item">
                    <img src="https://www.beaches.com/blog/content/images/2022/08/Beaches-Ocho-Rios-Resort.jpg" alt="Snorkeling">
                    <div><b>All-Inclusive Escapes</b></div>
                    <small>Enjoy packages that include everything you need for the perfect beach trip.</small>
                </div>
            </div>
    </div>
    <?php include "include/footer.php"; ?>
</body>
</html>
