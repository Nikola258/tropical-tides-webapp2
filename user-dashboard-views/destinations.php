<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once '../dbcalls/conn.php';

// Fetch all available destinations to display
try {
    $destinations_stmt = $conn->prepare("SELECT * FROM booking ORDER BY plaats ASC");
    $destinations_stmt->execute();
    $destinations = $destinations_stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    error_log("Failed to fetch destinations: " . $e->getMessage());
    $destinations = [];
}

// Fetch average ratings for all places in one query
$avg_ratings = [];
try {
    $ratings_stmt = $conn->query("SELECT plaats, AVG(user_rating) as avg_rating FROM feedback GROUP BY plaats");
    while ($row = $ratings_stmt->fetch(PDO::FETCH_ASSOC)) {
        $avg_ratings[$row['plaats']] = round($row['avg_rating'], 1);
    }
} catch (PDOException $e) {
    // If feedback table doesn't exist or error, just leave $avg_ratings empty
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Destinations</title>
    <link rel="stylesheet" href="../assets/css/dashboard-ui.css">
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/css/booking-page.css">
</head>
<body>
<?php include "../include/user-dashboard-sidebar.php"; ?>

<div class="destinations-content">
    <div class="main-content-header">
        <h1>Destinations</h1>
        <p>Explore our available destinations.</p>
    </div>
    <div class="destinations-container">
        <?php if (!empty($destinations)): ?>
            <?php foreach ($destinations as $dest): ?>
                <?php $average_rating = $avg_ratings[$dest['plaats']] ?? 0; ?>
                <div class="destination-card">
                    <img src="<?php echo htmlspecialchars($dest['img'] ?? '../assets/img/placeholder.jpg'); ?>" alt="<?php echo htmlspecialchars($dest['plaats'] ?? 'Destination'); ?>" class="card-img">
                    <div class="card-body">
                        <div class="card-title-rating">
                            <h3><?php echo htmlspecialchars($dest['plaats'] ?? 'Location Name'); ?></h3>
                            <span class="rating">
                                <?php echo $average_rating; ?>&#9733;
                            </span>
                        </div>
                        <p class="description"><?php echo htmlspecialchars($dest['beschrijving'] ?? 'Description not available.'); ?></p>
                        <p class="price">€<?php echo htmlspecialchars($dest['prijs'] ?? '0.00'); ?></p>
                        <div class="card-links">
                            <a href="../booking.php">Book now →</a>
                            <a href="../location-info.php?id=<?php echo $dest['id']; ?>">Dive Deeper →</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>No destinations available at the moment.</p>
        <?php endif; ?>
    </div>
</div>
</body>
</html>