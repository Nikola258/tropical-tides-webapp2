<?php
session_start();
// check of user is ingelogd, anders terugsturen
if (!isset($_SESSION['user_id'])) {
    header('Location: auth-views/login.php');
    exit();
}

include('dbcalls/conn.php');

// Haal alle unieke locaties (plaatsen) op voor de dropdown
$locations_stmt = $conn->prepare("SELECT DISTINCT plaats FROM booking ORDER BY plaats ASC");
$locations_stmt->execute();
$locations = $locations_stmt->fetchAll(PDO::FETCH_COLUMN);

// Haal alle feedback op om te tonen
$feedback_stmt = $conn->prepare("SELECT * FROM feedback ORDER BY created_at DESC");
$feedback_stmt->execute();
$feedbacks = $feedback_stmt->fetchAll();

$page_message = '';
if (isset($_SESSION['page_message'])) {
    $page_message = $_SESSION['page_message'];
    unset($_SESSION['page_message']);
}

function generate_stars($rating) {
    $stars = '';
    for ($i = 1; $i <= 5; $i++) {
                                 //filled star  empty star
        $stars .= $i <= $rating ? '&#9733;' : '&#9734;';
    }
    return $stars;
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Feedback - Tropical Tides</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <div class="hero-fb">
        <div class="hero-overlay"></div>
        <div class="header-absolute">
            <?php include "include/header.php"; ?>
        </div>
        <div class="hero-content">
            <div class="hero-title">Feedback & Reviews</div>
        </div>
    </div>

    <div class="admin-dashboard-container" style="margin: 40px auto; max-width: 900px;">
        <h1>Review a Location</h1>
        <p>Share your experience and help other travelers!</p>

        <?php if ($page_message): ?>
            <div class="alert" style="padding: 10px; background: #e6f7ff; border-left: 4px solid #00C2FF; margin-bottom: 15px;"><?php echo htmlspecialchars($page_message); ?></div>
        <?php endif; ?>

        <div class="crud-item">
            <p style="margin-bottom: 15px;">You leave a review when: <strong><?php echo htmlspecialchars($_SESSION['name']); ?></strong></p>
            <form action="include/feedback-action.php" method="post" class="crud-form" style="padding-top: 10px;">
                <label for="plaats">Choose a location:</label>
                <select name="plaats" id="plaats" required style="flex: 2 1 200px; padding: 8px 12px; border: 1px solid #cce7f6; border-radius: 6px; background: #f4faff;">
                    <?php foreach ($locations as $location): ?>
                        <option value="<?php echo htmlspecialchars($location); ?>"><?php echo htmlspecialchars($location); ?></option>
                    <?php endforeach; ?>
                </select>

                <label for="user_rating">Rating:</label>
                <div class="star-rating">
                    <input type="radio" id="5-stars" name="user_rating" value="5" required/><label for="5-stars" class="star">&#9733;</label>
                    <input type="radio" id="4-stars" name="user_rating" value="4" /><label for="4-stars" class="star">&#9733;</label>
                    <input type="radio" id="3-stars" name="user_rating" value="3" /><label for="3-stars" class="star">&#9733;</label>
                    <input type="radio" id="2-stars" name="user_rating" value="2" /><label for="2-stars" class="star">&#9733;</label>
                    <input type="radio" id="1-star" name="user_rating" value="1" /><label for="1-star" class="star">&#9733;</label>
                </div>
                
                <label for="user_review">Note:</label>
                <textarea name="user_review" id="user_review" rows="2" style="width:100%; border-radius:6px; padding:8px;"></textarea>
                
                <input type="submit" name="feedback_submit" value="Leave a review">
            </form>
        </div>
        
        <h2 style="margin-top: 40px;">All Reviews</h2>
        <?php if (empty($feedbacks)): ?>
            <p>There are no reviews yet. Be the first.!</p>
        <?php else: ?>
            <?php foreach ($feedbacks as $fb): ?>
                <div class="crud-item" style="background: #f4f4f4; margin-top: 10px; border-left-color: #ffbf00;">
                    <h4><?php echo htmlspecialchars($fb['plaats']); ?></h4>
                    <p><strong><?php echo htmlspecialchars($fb['user_name']); ?>:</strong> "<?php echo htmlspecialchars($fb['user_review']); ?>"</p>
                    <div class="stars-display"><?php echo generate_stars($fb['user_rating']); ?></div>
                    <small style="display: block; color: #777; margin-top: 5px;">Posted on: <?php echo date('d-m-Y', strtotime($fb['created_at'])); ?></small>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>

    <?php include "include/footer.php"; ?>
</body>
</html> 