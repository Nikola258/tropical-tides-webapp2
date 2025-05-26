<?php
$servername = "mariadb";
$username = "root";
$password = "root";

try {
    $conn = new PDO("mysql:host=$servername;dbname=EpicVacations", $username, $password);
    echo "Connected successfully";
    // set the PDO error mode to exception
    //  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>
