<!<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../assets/css/index.css">
    <link rel="stylesheet" href="../assets/css/style.css">


    <title>Document</title>
</head>
<body>

<?php
include ('./conn.php');
include('./read.php');

$plaats  = '%' . $_GET["plaats"]. '%';
$personen  = $_GET["personen"];
$datum = $_GET["datum"];

$stmt = $conn->prepare("SELECT * FROM booking WHERE plaats LIKE :plaats");
$stmt->bindParam(":plaats", $plaats);
$stmt->bindParam(":personen", $personen);
$stmt->bindParam(":datum", $datum);

$stmt->execute();
$result = $stmt->fetchAll();

?>
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
