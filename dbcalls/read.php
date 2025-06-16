<?php



$stmt = $conn->prepare("SELECT * FROM booking;");
$stmt->execute();
$result = $stmt->fetchAll();
