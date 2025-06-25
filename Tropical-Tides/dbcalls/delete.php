<?php
include_once 'conn.php';

$id = $_POST['id'];

$sql = 'DELETE FROM booking WHERE id = :id';
$stmt = $conn->prepare($sql);
$stmt->bindParam(':id', $id);

try {
    $stmt->execute();
    echo "Booking deleted successfully!";
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
} 