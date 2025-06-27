<?php
include(__DIR__ . '/../dbcalls/conn.php');
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    // Validatie
    if (empty($name) || empty($email) || empty($password) || empty($confirm_password)) {
        die('Vul alle velden in.');
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        die('Ongeldig e-mailadres.');
    }
    if ($password !== $confirm_password) {
        die('Wachtwoorden komen niet overeen.');
    }
    if (strlen($password) < 6) {
        die('Wachtwoord moet minimaal 6 tekens zijn.');
    }

    // Check of email al bestaat
    $stmt = $conn->prepare("SELECT id FROM users WHERE email = :email");
    $stmt->bindParam(':email', $email);
    $stmt->execute();
    if ($stmt->fetch()) {
        die('Dit e-mailadres is al geregistreerd.');
    }

    // Wachtwoord hashen
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Gebruiker toevoegen
    $stmt = $conn->prepare("INSERT INTO users (email, password, name) VALUES (:email, :password, :name)");
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':password', $hashed_password);
    $stmt->bindParam(':name', $name);
    if ($stmt->execute()) {
        // Automatisch inloggen
        $_SESSION['user_id'] = $conn->lastInsertId();
        $_SESSION['email'] = $email;
        $_SESSION['name'] = $name;
        header('Location: ../../user-dashboard.php');
        exit;
    } else {
        die('Registratie mislukt. Probeer opnieuw.');
    }
} else {
    header('Location: register.php');
    exit;
} 