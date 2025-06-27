<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once '../dbcalls/conn.php';

if (!isset($_SESSION['email'])) {
    echo '<p>You must be logged in to edit feedback.</p>';
    exit;
}

$user_email = $_SESSION['email'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = intval($_POST['id']);
    $new_rating = intval($_POST['user_rating']);
    $new_review = trim($_POST['user_review']);
    // Only update if the feedback belongs to this user
    $stmt = $conn->prepare('UPDATE feedback SET user_rating = :user_rating, user_review = :user_review WHERE id = :id AND user_email = :email');
    $stmt->bindParam(':user_rating', $new_rating);
    $stmt->bindParam(':user_review', $new_review);
    $stmt->bindParam(':id', $id);
    $stmt->bindParam(':email', $user_email);
    $stmt->execute();
    // Get the place for this feedback
    $plaats_stmt = $conn->prepare('SELECT plaats FROM feedback WHERE id = :id');
    $plaats_stmt->bindParam(':id', $id);
    $plaats_stmt->execute();
    $plaats_row = $plaats_stmt->fetch(PDO::FETCH_ASSOC);
    if ($plaats_row) {
        $plaats = $plaats_row['plaats'];
        // Update average rating in booking table
        $avg_stmt = $conn->prepare('SELECT AVG(user_rating) as avg_rating FROM feedback WHERE plaats = :plaats');
        $avg_stmt->bindParam(':plaats', $plaats);
        $avg_stmt->execute();
        $avg = $avg_stmt->fetch(PDO::FETCH_ASSOC);
        $average_rating = $avg['avg_rating'] ? round($avg['avg_rating'], 1) : 0;
        $update_stmt = $conn->prepare('UPDATE booking SET rating = :rating WHERE plaats = :plaats');
        $update_stmt->bindParam(':rating', $average_rating);
        $update_stmt->bindParam(':plaats', $plaats);
        $update_stmt->execute();
    }
    $_SESSION['page_message'] = 'Feedback updated successfully!';
    header('Location: ../user-dashboard-views/messages.php');
    exit;
} else {
    $id = intval($_GET['id'] ?? 0);
    $stmt = $conn->prepare('SELECT * FROM feedback WHERE id = :id AND user_email = :email');
    $stmt->bindParam(':id', $id);
    $stmt->bindParam(':email', $user_email);
    $stmt->execute();
    $feedback = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$feedback) {
        echo '<p>Feedback not found or not authorized.</p>';
        exit;
    }
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Feedback</title>
    <link rel="stylesheet" href="../assets/css/dashboard-ui.css">
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
<div class="content" style="margin: 40px auto; max-width: 600px;">
    <h1>Edit Feedback</h1>
    <form action="edit-feedback.php" method="post">
        <input type="hidden" name="id" value="<?php echo $feedback['id']; ?>">
        <div class="form-group">
            <label for="user_rating">Rating:</label>
            <select name="user_rating" id="user_rating" required>
                <option value="5" <?php if ($feedback['user_rating'] == 5) echo 'selected'; ?>>5</option>
                <option value="4" <?php if ($feedback['user_rating'] == 4) echo 'selected'; ?>>4</option>
                <option value="3" <?php if ($feedback['user_rating'] == 3) echo 'selected'; ?>>3</option>
                <option value="2" <?php if ($feedback['user_rating'] == 2) echo 'selected'; ?>>2</option>
                <option value="1" <?php if ($feedback['user_rating'] == 1) echo 'selected'; ?>>1</option>
            </select>
        </div>
        <div class="form-group">
            <label for="user_review">Review:</label>
            <textarea name="user_review" id="user_review" rows="5" style="width:100%; border-radius:6px; padding:8px;" required><?php echo htmlspecialchars($feedback['user_review']); ?></textarea>
        </div>
        <button type="submit" class="edit-btn">Save Changes</button>
        <a href="../user-dashboard-views/messages.php" class="cancel-btn">Cancel</a>
    </form>
</div>
<style>
.edit-btn {
    background: #2980b9;
    color: #fff;
    border: none;
    padding: 5px 12px;
    border-radius: 4px;
    cursor: pointer;
    margin-right: 8px;
    transition: background 0.2s;
}
.edit-btn:hover {
    background: #1c5a85;
}
.cancel-btn {
    background: #aaa;
    color: #fff;
    border: none;
    padding: 5px 12px;
    border-radius: 4px;
    text-decoration: none;
    transition: background 0.2s;
}
.cancel-btn:hover {
    background: #888;
}
</style>
</body>
</html> 