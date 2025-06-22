<?php
session_start();
require_once __DIR__ . '/../../dbcalls/conn.php';

// Security check: only admins can perform this action
if (!isset($_SESSION['user_role']) || $_SESSION['user_role'] !== 'admin') {
    $_SESSION['message'] = "You are not authorized to perform this action.";
    $_SESSION['message_type'] = "danger";
    header('Location: ../../admin-dashboard.php?view=destinations');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);

    if (!$id) {
        $_SESSION['message'] = "Invalid ID for deletion.";
        $_SESSION['message_type'] = "danger";
    } else {
        try {
            $stmt = $conn->prepare("DELETE FROM booking WHERE id = :id");
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                $_SESSION['message'] = "Destination #{$id} has been deleted.";
                $_SESSION['message_type'] = "success";
            } else {
                $_SESSION['message'] = "Could not find destination #{$id} to delete.";
                $_SESSION['message_type'] = "danger";
            }
        } catch (PDOException $e) {
            error_log("Destination deletion error: " . $e->getMessage());
            $_SESSION['message'] = "A database error occurred. Could not delete destination.";
            $_SESSION['message_type'] = "danger";
        }
    }
} else {
    $_SESSION['message'] = "Invalid request method.";
    $_SESSION['message_type'] = "danger";
}

header('Location: ../../admin-dashboard.php?view=destinations');
exit(); 