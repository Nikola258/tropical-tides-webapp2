<?php

include(__DIR__ . '/../../dbcalls/conn.php');
session_start();

$email = $_POST['email'];
$password = $_POST['password'];

// Admin login (plain text password)
$stmt = $conn->prepare("SELECT * FROM admin WHERE email = :email AND password = :password;");
$stmt->bindParam(":email", $email);
$stmt->bindParam(":password", $password);
$stmt->execute();
$admin = $stmt->fetch();

if ($admin) {
    $_SESSION['admin_id'] = $admin['id'];
    $_SESSION['email'] = $admin['email'];
    $_SESSION['name'] = $admin['name'] ?? 'Admin';
    header('Location: ../../admin-dashboard.php');
    exit;
}

// User login (hashed password)
$stmt = $conn->prepare("SELECT * FROM users WHERE email = :email");
$stmt->bindParam(":email", $email);
$stmt->execute();
$user = $stmt->fetch();

if ($user && password_verify($password, $user['password'])) {
    $_SESSION['user_id'] = $user['id'];
    $_SESSION['email'] = $user['email'];
    $_SESSION['name'] = $user['name'];
    header('Location: ../../user-dashboard.php');
    exit;
}

// Login failed
// Show error message (simple)
echo 'Ongeldig wachtwoord of email';