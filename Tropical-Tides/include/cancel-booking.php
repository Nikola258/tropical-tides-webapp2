<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once __DIR__ . '/db.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: ../auth-views/login.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['booking_id'])) {
    $user_id = $_SESSION['user_id'];
    $booking_id = intval($_POST['booking_id']);

    // Check if the booking belongs to the user
    $stmt = $conn->prepare('SELECT * FROM user_bookings WHERE id = :id AND user_id = :user_id');
    $stmt->bindParam(':id', $booking_id, PDO::PARAM_INT);
    $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
    $stmt->execute();
    $booking = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($booking) {
        // Delete the booking
        $del_stmt = $conn->prepare('DELETE FROM user_bookings WHERE id = :id AND user_id = :user_id');
        $del_stmt->bindParam(':id', $booking_id, PDO::PARAM_INT);
        $del_stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        $del_stmt->execute();
        $_SESSION['page_message'] = 'Booking cancelled successfully.';
        $_SESSION['message_type'] = 'success';
    } else {
        $_SESSION['page_message'] = 'Booking not found or not authorized.';
        $_SESSION['message_type'] = 'error';
    }
} else {
    $_SESSION['page_message'] = 'Invalid request.';
    $_SESSION['message_type'] = 'error';
}

header('Location: ../user-dashboard.php');
exit; 