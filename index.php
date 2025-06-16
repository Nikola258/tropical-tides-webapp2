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
            <img src="https://wallpaperaccess.com/full/169950.jpg" alt="beach" class="index-img">
        </div>
        <div class="bottem_content">
            <h1>Explore the tides!</h1>
            <h3>Tropical Tides offers amazing</h3>
            <h3>beach activity desinations!</h3>
        </div>
    </section>
    <section>
        <div class="index-img-box">
            <img src="https://wallpaperaccess.com/full/169950.jpg" alt="beach" class="index-img">
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
<section class="mid_page">
    <h1 class="wave_text">hoi</h1>
    <img class="waves" src="./assets/img/waves.png">

</section>
</body>

</html>