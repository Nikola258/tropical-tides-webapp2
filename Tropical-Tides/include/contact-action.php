<?php
session_start();
include('../dbcalls/conn.php');

$message = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['contact_submit'])) {
        $name = trim($_POST['contact_name']);
        $email = trim($_POST['contact_email']);
        $message_text = trim($_POST['contact_message']);

        if (!empty($name) && !empty($email) && !empty($message_text) && filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $stmt = $conn->prepare("INSERT INTO messages (name, email, message) VALUES (:name, :email, :message)");
            $stmt->bindParam(':name', $name);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':message', $message_text);
            if ($stmt->execute()) {
                $message = "Bericht succesvol verzonden!";
            } else {
                $message = "Er is iets misgegaan. Probeer het opnieuw.";
            }
        } else {
            $message = "Vul alle velden correct in.";
        }
    }
}
$_SESSION['page_message'] = $message;
header('Location: ../contact.php');
exit(); 