<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once __DIR__ . '/../include/db.php';

$bookings = [];
if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
    try {
        $stmt = $conn->prepare("SELECT * FROM user_bookings WHERE user_id = :user_id ORDER BY arrivals_date DESC");
        $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        $stmt->execute();
        $bookings = $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        // Optionally log error
        $bookings = [];
    }
} else {
    // Not logged in, show empty bookings
    $bookings = [];
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../assets/css/dashboard-ui.css">
    <link rel="stylesheet" href="../assets/css/style.css">
    <title>Document</title>
</head>
<body>
<?php include "./include/user-dashboard-sidebar.php"; ?>

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
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($bookings as $booking): ?>
                <tr>
                    <td><?php echo htmlspecialchars($booking['id']); ?></td>
                    <td><?php echo htmlspecialchars($booking['plaats']); ?></td>
                    <td><?php echo htmlspecialchars($booking['personen']); ?></td>
                    <td><?php echo htmlspecialchars(date("d-m-Y", strtotime($booking['arrivals_date']))); ?></td>
                    <td><?php echo htmlspecialchars(date("d-m-Y", strtotime($booking['leaving_date']))); ?></td>
                    <td><?php echo htmlspecialchars(date("d-m-Y H:i", strtotime($booking['booking_date'] ?? 'now'))); ?></td>
                    <td>
                        <form method="POST" action="../include/cancel-booking.php" onsubmit="return confirm('Are you sure you want to cancel your booking?');" style="display:inline;">
                            <input type="hidden" name="booking_id" value="<?php echo htmlspecialchars($booking['id']); ?>">
                            <button type="submit" class="cancel-btn">Cancel</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
</div>

<style>
.cancel-btn {
    background: #e74c3c;
    color: #fff;
    border: none;
    padding: 5px 12px;
    border-radius: 4px;
    cursor: pointer;
    transition: background 0.2s;
}
.cancel-btn:hover {
    background: #c0392b;
}
</style>
</body>
</html>