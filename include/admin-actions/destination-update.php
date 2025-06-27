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
    // Sanitize and retrieve form data
    $id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
    $plaats = filter_input(INPUT_POST, 'plaats', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $beschrijving = filter_input(INPUT_POST, 'beschrijving', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $prijs = filter_input(INPUT_POST, 'prijs', FILTER_VALIDATE_FLOAT);
    $img = filter_input(INPUT_POST, 'img', FILTER_SANITIZE_URL);
    $rating = filter_input(INPUT_POST, 'rating', FILTER_VALIDATE_FLOAT);

    // Basic validation
    if (!$id || !$plaats || !$beschrijving || $prijs === false || $rating === false) {
        $_SESSION['message'] = "Please fill in all required fields with valid data.";
        $_SESSION['message_type'] = "danger";
    } else {
        try {
            $stmt = $conn->prepare(
                "UPDATE booking 
                 SET plaats = :plaats, beschrijving = :beschrijving, prijs = :prijs, img = :img, rating = :rating 
                 WHERE id = :id"
            );
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->bindParam(':plaats', $plaats);
            $stmt->bindParam(':beschrijving', $beschrijving);
            $stmt->bindParam(':prijs', $prijs);
            $stmt->bindParam(':img', $img);
            $stmt->bindParam(':rating', $rating);
            
            $stmt->execute();

            $_SESSION['message'] = "Destination successfully updated!";
            $_SESSION['message_type'] = "success";
        } catch (PDOException $e) {
            error_log("Destination update error: " . $e->getMessage());
            $_SESSION['message'] = "A database error occurred. Could not update destination.";
            $_SESSION['message_type'] = "danger";
        }
    }
} else {
    $_SESSION['message'] = "Invalid request method.";
    $_SESSION['message_type'] = "danger";
}

header('Location: ../../admin-dashboard.php?view=destinations');
exit(); 