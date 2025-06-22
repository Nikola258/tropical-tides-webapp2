<?php
include_once 'conn.php';

$id = $_POST['id'];
$plaats = $_POST['plaats'];
$beschrijving = $_POST['beschrijving'];
$datum = $_POST['datum'];
$personen = $_POST['personen'];
$prijs = $_POST['prijs'];
$img = $_POST['img'];
$rating = $_POST['rating'];

$sql = 'UPDATE booking SET plaats = :plaats, beschrijving = :beschrijving, datum = :datum, personen = :personen, prijs = :prijs, img = :img, rating = :rating WHERE id = :id';
$stmt = $conn->prepare($sql);
$stmt->bindParam(':id', $id);
$stmt->bindParam(':plaats', $plaats);
$stmt->bindParam(':beschrijving', $beschrijving);
$stmt->bindParam(':datum', $datum);
$stmt->bindParam(':personen', $personen);
$stmt->bindParam(':prijs', $prijs);
$stmt->bindParam(':img', $img);
$stmt->bindParam(':rating', $rating);

try {
    $stmt->execute();
    echo "Booking updated successfully!";
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
} 