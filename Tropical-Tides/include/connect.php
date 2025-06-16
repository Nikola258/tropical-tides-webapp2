<?php
$servername = "mysql_db";
$username = "root";
$password = "rootpassword";
$dbname = "epic-vacationsdb"; // Corrected to match your database screenshot

try {
    $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}
?> 