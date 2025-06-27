<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once '../dbcalls/conn.php';

if (!isset($_SESSION['email'])) {
    $_SESSION['page_message'] = 'You must be logged in to delete messages.';
    header('Location: ../user-dashboard-views/messages.php');
    exit;
}

$user_email = $_SESSION['email'];

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    $id = intval($_POST['id']);
    // Only delete if the message belongs to this user
    $stmt = $conn->prepare('DELETE FROM messages WHERE id = :id AND email = :email');
    $stmt->bindParam(':id', $id);
    $stmt->bindParam(':email', $user_email);
    $stmt->execute();
    if ($stmt->rowCount() > 0) {
        $_SESSION['page_message'] = 'Message deleted successfully!';
    } else {
        $_SESSION['page_message'] = 'Message not found or not authorized.';
    }
} else {
    $_SESSION['page_message'] = 'Invalid request.';
}
header('Location: ../user-dashboard-views/messages.php');
exit; 