<?php
session_start();

function setMessage($type, $message) {
    $_SESSION[$type] = $message;
}

function isLoggedIn() {
    return isset($_SESSION['user_id']);
}

function getRoleNames($pdo) {
    $stmt = $pdo->query("SELECT admin, user FROM user_roles WHERE id = 1");
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function loginUser($email, $password, $pdo, $roleNames) {
    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$user) {
        setMessage('error', 'Invalid login credentials.');
        return false;
    }

    $passwordMatches = false;
    if ($user['name'] === $roleNames['admin']) {
        $passwordMatches = password_verify($password, $user['password']);
    } else {
        $passwordMatches = ($password === $user['password']);
    }

    if (!$passwordMatches) {
        setMessage('error', 'Invalid login credentials.');
        return false;
    }

    $_SESSION['user_id'] = $user['id'];
    $_SESSION['email'] = $user['email'];
    $_SESSION['name'] = $user['name'];

    if ($user['name'] === $roleNames['admin']) {
        $_SESSION['role'] = 'admin';
        header("Location: ../../admin-dashboard.php");
    } elseif ($user['name'] === $roleNames['user']) {
        $_SESSION['role'] = 'user';
        header("Location: ../../user-dashboard.php");
    } else {
        setMessage('error', 'Unknown user role.');
        header("Location: ../auth-views/login.php");
    }
    exit;
}

function registerUser($email, $password, $name, $pdo, $roleNames) {
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        setMessage('error', 'Invalid email address.');
        return false;
    }

    if (strlen($password) < 8) {
        setMessage('error', 'Password must be at least 8 characters long.');
        return false;
    }

    $stmt = $pdo->prepare("SELECT COUNT(*) FROM users WHERE email = ?");
    $stmt->execute([$email]);
    if ($stmt->fetchColumn()) {
        setMessage('error', 'Email already exists.');
        return false;
    }

    $assignedRole = $roleNames['user'];

    $stmt = $pdo->prepare("INSERT INTO users (email, password, name) VALUES (?, ?, ?)");
    $success = $stmt->execute([$email, $password, $assignedRole]);

    if (!$success) {
        setMessage('error', 'Something went wrong, please try again.');
        return false;
    }

    return true;
}

?>