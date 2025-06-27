<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once '../dbcalls/conn.php';

if (!isset($_SESSION['email'])) {
    $_SESSION['page_message'] = 'You must be logged in to delete feedback.';
    header('Location: ../user-dashboard-views/messages.php');
    exit;
}

$user_email = $_SESSION['email'];

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    $id = intval($_POST['id']);
    // Get the place for this feedback before deleting
    $plaats_stmt = $conn->prepare('SELECT plaats FROM feedback WHERE id = :id AND user_email = :email');
    $plaats_stmt->bindParam(':id', $id);
    $plaats_stmt->bindParam(':email', $user_email);
    $plaats_stmt->execute();
    $plaats_row = $plaats_stmt->fetch(PDO::FETCH_ASSOC);
    if ($plaats_row) {
        $plaats = $plaats_row['plaats'];
        // Delete the feedback
        $stmt = $conn->prepare('DELETE FROM feedback WHERE id = :id AND user_email = :email');
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':email', $user_email);
        $stmt->execute();
        // Update average rating in booking table
        $avg_stmt = $conn->prepare('SELECT AVG(user_rating) as avg_rating FROM feedback WHERE plaats = :plaats');
        $avg_stmt->bindParam(':plaats', $plaats);
        $avg_stmt->execute();
        $avg = $avg_stmt->fetch(PDO::FETCH_ASSOC);
        $average_rating = $avg['avg_rating'] ? round($avg['avg_rating'], 1) : 0;
        $update_stmt = $conn->prepare('UPDATE booking SET rating = :rating WHERE plaats = :plaats');
        $update_stmt->bindParam(':rating', $average_rating);
        $update_stmt->bindParam(':plaats', $plaats);
        $update_stmt->execute();
        $_SESSION['page_message'] = 'Feedback deleted successfully!';
    } else {
        $_SESSION['page_message'] = 'Feedback not found or not authorized.';
    }
} else {
    $_SESSION['page_message'] = 'Invalid request.';
}
header('Location: ../user-dashboard-views/messages.php');
exit; 