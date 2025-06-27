<?php
include_once 'conn.php';

try {
    $stmt = $conn->prepare("SELECT * FROM booking;");
    $stmt->execute();
    $result = $stmt->fetchAll();
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
    $result = [];
}
