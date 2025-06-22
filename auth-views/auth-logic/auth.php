<?php


include("../../dbcalls/conn.php");
session_start();


$email = $_POST['email'];
$password = $_POST['password'];

$stmt = $conn->prepare("SELECT * FROM admin WHERE email = :email AND password = :password;");
$stmt->bindParam(":email", $_POST['email']);
$stmt->bindParam(":password", $_POST['password']);
$stmt->execute();
$result = $stmt->fetchAll();

$stmt = $conn->prepare("SELECT * FROM users WHERE email = :email AND password = :password;");
$stmt->bindParam(":email", $_POST['email']);
$stmt->bindParam(":password", $_POST['password']);
$stmt->execute();
$resultaat = $stmt->fetchAll();

if ($result) {


    header('location: ../../admin-dashboard.php');


    exit;


}else{
    if ($resultaat) {
        header('location: ../../user-dashboard.php');
    exit;
    }else {
        echo 'ongeldig wachtwoord of email';
    }
}