<?php
include_once 'conn.php';

$plaats = $_POST['plaats'];
$beschrijving = $_POST['beschrijving'];
$datum = $_POST['datum'];
$personen = $_POST['personen'];
$prijs = $_POST['prijs'];
$img = $_POST['img'];
$rating = $_POST['rating'];

$sql = 'INSERT INTO booking (plaats, beschrijving, datum, personen, prijs, img, rating) VALUES (:plaats, :beschrijving, :datum, :personen, :prijs, :img, :rating)';
$stmt = $conn->prepare($sql);
$stmt->bindParam(':plaats', $plaats);
$stmt->bindParam(':beschrijving', $beschrijving);
$stmt->bindParam(':datum', $datum);
$stmt->bindParam(':personen', $personen);
$stmt->bindParam(':prijs', $prijs);
$stmt->bindParam(':img', $img);
$stmt->bindParam(':rating', $rating);

try {
    $stmt->execute();
    echo "Booking created successfully!";
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
