<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once '../dbcalls/conn.php';

if (!isset($_SESSION['email'])) {
    echo '<p>You must be logged in to view your messages.</p>';
    exit;
}

$user_email = $_SESSION['email'];

// Fetch messages for this user
$stmt = $conn->prepare('SELECT * FROM messages WHERE email = :email ORDER BY created_at DESC');
$stmt->bindParam(':email', $user_email);
$stmt->execute();
$messages = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Fetch feedback for this user
$feedback_stmt = $conn->prepare('SELECT * FROM feedback WHERE user_email = :email ORDER BY created_at DESC');
$feedback_stmt->bindParam(':email', $user_email);
$feedback_stmt->execute();
$feedbacks = $feedback_stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>My Messages</title>
    <link rel="stylesheet" href="../assets/css/dashboard-ui.css">
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
<?php include "../include/user-dashboard-sidebar.php"; ?>

<div class="content-messages">
    <div class="main-content-header-messages">
        <h1>My Messages</h1>
        <p>View, edit, or delete your contact messages and feedback.</p>
    </div>
    <h2>Contact Messages</h2>
    <?php if (empty($messages)): ?>
        <div class="alert alert-info">You have not sent any contact messages yet.</div>
    <?php else: ?>
        <?php foreach ($messages as $msg): ?>
            <div class="crud-item-messages" style="background: #f4f4f4; margin-top: 10px; border-left-color: #00C2FF; padding: 15px;">
                <p><strong>Message:</strong></p>
                <p><?php echo nl2br(htmlspecialchars($msg['message'])); ?></p>
                <small style="display: block; color: #777; margin-top: 5px;">Sent on: <?php echo date('d-m-Y H:i', strtotime($msg['created_at'])); ?></small>
                <form action="../include/edit-message.php" method="get" style="display:inline;">
                    <input type="hidden" name="id" value="<?php echo $msg['id']; ?>">
                    <button type="submit" class="edit-btn">Edit</button>
                </form>
                <form action="../include/delete-message.php" method="post" style="display:inline;" onsubmit="return confirm('Are you sure you want to delete this message?');">
                    <input type="hidden" name="id" value="<?php echo $msg['id']; ?>">
                    <button type="submit" class="delete-btn">Delete</button>
                </form>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>
    <h2 style="margin-top:40px;">My Feedback</h2>
    <?php if (empty($feedbacks)): ?>
        <div class="alert alert-info">You have not left any feedback yet.</div>
    <?php else: ?>
        <?php foreach ($feedbacks as $fb): ?>
            <div class="crud-item-messages" style="background: #f4f4f4; margin-top: 10px; border-left-color: #ffc107; padding: 15px;">
                <p><strong>Destination:</strong> <?php echo htmlspecialchars($fb['plaats']); ?></p>
                <p><strong>Rating:</strong> <?php echo htmlspecialchars($fb['user_rating']); ?>&#9733;</p>
                <p><strong>Review:</strong> <?php echo nl2br(htmlspecialchars($fb['user_review'])); ?></p>
                <small style="display: block; color: #777; margin-top: 5px;">Left on: <?php echo date('d-m-Y H:i', strtotime($fb['created_at'])); ?></small>
                <form action="../include/edit-feedback.php" method="get" style="display:inline;">
                    <input type="hidden" name="id" value="<?php echo $fb['id']; ?>">
                    <button type="submit" class="edit-btn">Edit Feedback</button>
                </form>
                <form action="../include/delete-feedback.php" method="post" style="display:inline;" onsubmit="return confirm('Are you sure you want to delete your feedback for this destination?');">
                    <input type="hidden" name="id" value="<?php echo $fb['id']; ?>">
                    <button type="submit" class="delete-btn">Delete Feedback</button>
                </form>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>
</div>
</body>
</html>