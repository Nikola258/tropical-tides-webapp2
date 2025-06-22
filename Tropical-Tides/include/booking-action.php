<?php
session_start();
// This file needs to exist and connect to the database.
// Assuming it's in the parent directory of 'include'.
require_once __DIR__ . '/../dbcalls/conn.php'; 

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    // Only allow POST requests
    header('Location: ../booking.php');
    exit;
}

// Get user_id from session if logged in
$user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;

if ($user_id) {
    // If logged in, fetch name and email from the database for security
    try {
        $user_stmt = $conn->prepare("SELECT name, email FROM users WHERE id = :id");
        $user_stmt->bindParam(':id', $user_id, PDO::PARAM_INT);
        $user_stmt->execute();
        $user_data = $user_stmt->fetch(PDO::FETCH_ASSOC);
        $naam = $user_data['name'];
        $email = $user_data['email'];
    } catch (PDOException $e) {
        error_log("Failed to fetch user data for booking: " . $e->getMessage());
        $_SESSION['page_message'] = "Sorry, there was an error processing your request.";
        $_SESSION['message_type'] = "error";
        header('Location: ../booking.php');
        exit;
    }
} else {
    // If not logged in, sanitize data from the form
    $naam = filter_input(INPUT_POST, 'naam', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
}

// Sanitize and retrieve the rest of the form data
$plaats = filter_input(INPUT_POST, 'plaats', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$adres = filter_input(INPUT_POST, 'adres', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$telefoonnummer = filter_input(INPUT_POST, 'telefoonnummer', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$personen = filter_input(INPUT_POST, 'personen', FILTER_VALIDATE_INT);
$arrivals_date = filter_input(INPUT_POST, 'arrivals_date');
$leaving_date = filter_input(INPUT_POST, 'leaving_date');

// Basic validation
if (!$naam || !$email || !$plaats || !$adres || !$telefoonnummer || !$personen || !$arrivals_date || !$leaving_date) {
    $_SESSION['page_message'] = "Error: Please fill in all required fields.";
    // Add logic to handle which message class to use (e.g., error, success)
    $_SESSION['message_type'] = "error";
    header('Location: ../booking.php');
    exit;
}

try {
    $stmt = $conn->prepare(
        "INSERT INTO user_bookings (user_id, naam, email, plaats, adres, telefoonnummer, personen, arrivals_date, leaving_date) 
         VALUES (:user_id, :naam, :email, :plaats, :adres, :telefoonnummer, :personen, :arrivals_date, :leaving_date)"
    );

    $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
    $stmt->bindParam(':naam', $naam, PDO::PARAM_STR);
    $stmt->bindParam(':email', $email, PDO::PARAM_STR);
    $stmt->bindParam(':plaats', $plaats, PDO::PARAM_STR);
    $stmt->bindParam(':adres', $adres, PDO::PARAM_STR);
    $stmt->bindParam(':telefoonnummer', $telefoonnummer, PDO::PARAM_STR);
    $stmt->bindParam(':personen', $personen, PDO::PARAM_INT);
    $stmt->bindParam(':arrivals_date', $arrivals_date);
    $stmt->bindParam(':leaving_date', $leaving_date);
    
    $stmt->execute();

    $_SESSION['page_message'] = "Your booking has been successfully submitted!";
    $_SESSION['message_type'] = "success";

} catch (PDOException $e) {
    // In a real app, you would log this error, not display it to the user
    error_log("Booking Error: " . $e->getMessage());
    $_SESSION['page_message'] = "Sorry, there was an error processing your booking. Please try again later.";
    $_SESSION['message_type'] = "error";
}

header('Location: ../booking.php');
exit; 