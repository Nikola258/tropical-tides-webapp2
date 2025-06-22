<?php
session_start();
include('../dbcalls/conn.php');

$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['feedback_submit'])) {
    if (!isset($_SESSION['user_id'])) {
        die('Je moet ingelogd zijn om een beoordeling te plaatsen.');
    }

    $plaats = $_POST['plaats'];
    $user_name = $_SESSION['name']; 
    $user_email = $_SESSION['email'];
    $user_rating = $_POST['user_rating'];
    $user_review = trim($_POST['user_review']);

    // Validatie
    if (!empty($plaats) && !empty($user_rating)) {
        // Voorkom dubbele beoordelingen
        $check_stmt = $conn->prepare("SELECT id FROM feedback WHERE plaats = :plaats AND user_email = :user_email");
        $check_stmt->bindParam(':plaats', $plaats);
        $check_stmt->bindParam(':user_email', $user_email);
        $check_stmt->execute();

        if ($check_stmt->fetch()) {
            $message = "Je hebt deze locatie al beoordeeld.";
        } else {
            // Corrected INSERT statement
            $stmt = $conn->prepare(
                "INSERT INTO feedback (plaats, user_name, user_email, user_description, user_rating, user_review) 
                 VALUES (:plaats, :user_name, :user_email, :user_desc, :user_rating, :user_rev)"
            );
            $stmt->bindParam(':plaats', $plaats);
            $stmt->bindParam(':user_name', $user_name);
            $stmt->bindParam(':user_email', $user_email);
            $stmt->bindParam(':user_desc', $user_review); // user_description gets the review text
            $stmt->bindParam(':user_rating', $user_rating);
            $stmt->bindParam(':user_rev', $user_review); // user_review also gets the review text

            if ($stmt->execute()) {
                $message = "Bedankt voor je beoordeling!";
            } else {
                $message = "Er is iets misgegaan. Probeer het opnieuw.";
            }
        }
    } else {
        $message = "Kies een locatie en geef een rating.";
    }
}

$_SESSION['page_message'] = $message;
header('Location: ../feedback.php');
exit(); 