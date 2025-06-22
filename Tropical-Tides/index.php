<?php
include('./dbcalls/conn.php');
include('./dbcalls/read.php');
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="assets/css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Inknut+Antiqua&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Anton&family=Bakbak+One&family=Inknut+Antiqua:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <title>Document</title>
</head>
<body>
<div class="hero-home">
    <div class="hero-overlay"></div>
    <div class="header-absolute">
        <?php include "include/header.php"; ?>
    </div>
    <div class="hero-content">
        <div class="hero-title">Explore our Tropical Destinations!</div>
    </div>
</div>
<section class="content">
    <section>
        <div class="index-img-box">
            <img src="https://wallpaperaccess.com/full/169950.jpg" alt="beach" class="index-img">
        </div>
        <div class="bottem_content">
            <h1>Most populiar destinations</h1>
            <h3>Tropical Tides offers the</h3>
            <h3>most populiar destinations!</h3>
        </div>
    </section>
    <section>
        <div class="index-img-box">
            <img src="https://th.bing.com/th/id/OIP.QRo162ZeajOyAjpYtbW3VAHaFM?rs=1&pid=ImgDetMain" alt="beach" class="index-img">
        </div>
        <div class="bottem_content">
            <h1>Explore the tides!</h1>
            <h3>Tropical Tides offers amazing</h3>
            <h3>beach activity desinations!</h3>
        </div>
    </section>
    <section>
        <div class="index-img-box">
            <img src="https://th.bing.com/th/id/OIP.C39a3iAWFRMmox1j0zKpQQHaE7?rs=1&pid=ImgDetMain" alt="beach" class="index-img">
        </div>
        <div class="bottem_content">
            <h1>Most cheapest destinations</h1>
            <h3>Tropical Tides offers the </h3>
            <h3>most cheapest destinations!</h3>
        </div>
    </section>
</section>

<section class="search_bar">
    <form action="./dbcalls/search.php" class="search_balk" method="GET">
        <input type="text" placeholder="Locatie" name="plaats">
        <input type="text" placeholder="Aantal Pers." name="personen">
        <input type="date" placeholder="VertrekDatum" name="datum">
        <input type="submit" value="Search">
    </form>

</section>
<section class="booking_destanation">
    <?php
    foreach ($result as $key => $value) {
        echo '<section class="booking_block">';
        echo '<section class="booking_row">';
        echo '<img class="img_box" src="' . ($value['img']) . '" '
            . 'alt="' . ($value['plaats']) . '"  />';
        echo '</div>';
        echo '</section>';
        echo '<section class="booking_row">';
        echo '<section class="middle_row">';
        echo '<div>' . $value['plaats'] . '</div>';
        echo '<div>' . $value['beschrijving'] . '</div>';
        echo '</section>';
        echo '<section class="middle_row">';
        echo '<div>'.'prijs: ' . $value['prijs'] .' euro' .'</div>';
        echo '</section>';
        echo '<section class="middle_row">';
        echo '<div>'.'aantal personen: ' . $value['personen'] .'</div>';
        echo '</section>';

        echo '</section>';
        echo '<section class="booking_row">';
        echo '<section class="middle_row">';
        echo '<div>'.'rating: ' . $value['rating'] .'</div>';
        echo '</section>';
        echo '<section class="middle_row">';
        echo '<div>'.'vertrek datum: ' . $value['datum'] .'</div>';
        echo '</section>';
        echo '</section>';
        echo '</section>';


    } ?>
</section>
<h1 class="wave_text">About Tropical Tides</h1>
<section class="mid_page">
    <!--<img class="waves" src="./assets/img/waves.png">-->
    <img class="waves" src="https://th.bing.com/th/id/R.eb548a468792ed123efcd738b2a8a69e?rik=sHaogbNyMiGvMg&pid=ImgRaw&r=0" alt="waves">
</section>

<div class="about-tropical-tides">
    <h1 class="h1-1">Your gateway to tropical escapes.</h1>
    <h1 class="h1-2">Explore stunning beach destinations and</h1>
    <h1 class="h1-3">let us help you plan the perfect getaway.</h1>
</div>
<?php include "include/footer.php"; ?>
</body>
</html>