<?php
// Prevent direct access to this file.
if (!defined('IS_USER_DASHBOARD')) {
    die("This page cannot be accessed directly. Please go through the user dashboard.");
}

// All necessary variables like $conn and the session are available from user-dashboard.php

// Fetch bookings for the logged-in user
$user_id = $_SESSION['user_id'];
$bookings = [];

try {
    $stmt = $conn->prepare(
        "SELECT id, plaats, personen, arrivals_date, leaving_date, booking_date 
         FROM user_bookings 
         WHERE user_id = :user_id 
         ORDER BY booking_date DESC"
    );
    $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
    $stmt->execute();
    $bookings = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    // In a real app, you would log this error.
    error_log("Failed to fetch user bookings: " . $e->getMessage());
    echo "<div class='alert alert-danger'>Could not retrieve your bookings due to a database error.</div>";
}
?>

<div class="main-content-header">
    <h1>My Bookings</h1>
    <p>Here is an overview of all your past and upcoming trips.</p>
</div>

<div class="table-container">
    <?php if (empty($bookings)): ?>
        <div class="alert alert-info">
            You have not made any bookings yet. <a href="../booking.php">Book your first trip now!</a>
        </div>
    <?php else: ?>
        <table class="data-table">
            <thead>
                <tr>
                    <th>Booking ID</th>
                    <th>Destination</th>
                    <th>Guests</th>
                    <th>Arrival Date</th>
                    <th>Leaving Date</th>
                    <th>Booked On</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($bookings as $booking): ?>
                    <tr>
                        <td>#<?php echo htmlspecialchars($booking['id']); ?></td>
                        <td><?php echo htmlspecialchars($booking['plaats']); ?></td>
                        <td><?php echo htmlspecialchars($booking['personen']); ?></td>
                        <td><?php echo htmlspecialchars(date("d-m-Y", strtotime($booking['arrivals_date']))); ?></td>
                        <td><?php echo htmlspecialchars(date("d-m-Y", strtotime($booking['leaving_date']))); ?></td>
                        <td><?php echo htmlspecialchars(date("d-m-Y H:i", strtotime($booking['booking_date']))); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
</div>