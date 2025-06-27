<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once '../dbcalls/conn.php';

if (!isset($_SESSION['email'])) {
    echo '<p>You must be logged in to edit messages.</p>';
    exit;
}

$user_email = $_SESSION['email'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = intval($_POST['id']);
    $new_message = trim($_POST['message']);
    // Only update if the message belongs to this user
    $stmt = $conn->prepare('UPDATE messages SET message = :message WHERE id = :id AND email = :email');
    $stmt->bindParam(':message', $new_message);
    $stmt->bindParam(':id', $id);
    $stmt->bindParam(':email', $user_email);
    $stmt->execute();
    $_SESSION['page_message'] = 'Message updated successfully!';
    header('Location: ../user-dashboard-views/messages.php');
    exit;
} else {
    $id = intval($_GET['id'] ?? 0);
    $stmt = $conn->prepare('SELECT * FROM messages WHERE id = :id AND email = :email');
    $stmt->bindParam(':id', $id);
    $stmt->bindParam(':email', $user_email);
    $stmt->execute();
    $msg = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$msg) {
        echo '<p>Message not found or not authorized.</p>';
        exit;
    }
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Message</title>
    <link rel="stylesheet" href="../assets/css/dashboard-ui.css">
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
<div class="edit-content" style="margin: 40px auto; max-width: 600px;">
    <h1>Edit Message</h1>
    <form action="edit-message.php" method="post">
        <input type="hidden" name="id" value="<?php echo $msg['id']; ?>">
        <div class="form-group">
            <label for="message">Message:</label>
            <textarea name="message" id="message" rows="5" style="width:100%; border-radius:6px; padding:8px;" required><?php echo htmlspecialchars($msg['message']); ?></textarea>
        </div>
        <button type="submit" class="edit-btn">Save Changes</button>
        <a href="../user-dashboard-views/messages.php" class="cancel-btn">Cancel</a>
    </form>
</div>
</body>
</html> 