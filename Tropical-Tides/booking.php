<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include('dbcalls/conn.php');

// Fetch all available destinations to display
try {
    $destinations_stmt = $conn->prepare("SELECT * FROM booking ORDER BY plaats ASC");
    $destinations_stmt->execute();
    $destinations = $destinations_stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    // In a real app, you would log this error.
    error_log("Failed to fetch destinations: " . $e->getMessage());
    $destinations = []; // Ensure destinations is an array
}

// Fetch logged-in user's data to pre-fill the form
$user_data = null;
if (isset($_SESSION['user_id'])) {
    try {
        $user_stmt = $conn->prepare("SELECT name, email FROM users WHERE id = :id");
        $user_stmt->bindParam(':id', $_SESSION['user_id'], PDO::PARAM_INT);
        $user_stmt->execute();
        $user_data = $user_stmt->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        error_log("Failed to fetch user data: " . $e->getMessage());
    }
}


// Message handling for feedback from booking-action.php
$page_message = '';
$message_type = '';
if (isset($_SESSION['page_message'])) {
    $page_message = $_SESSION['page_message'];
    $message_type = $_SESSION['message_type'] ?? 'success';
    unset($_SESSION['page_message']);
    unset($_SESSION['message_type']);
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking - Tropical Tides</title>
    <link href="https://fonts.googleapis.com/css2?family=Inknut+Antiqua&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/booking-page.css">
</head>
<body>
    <div class="hero-booking">
        <div class="hero-overlay"></div>
        <div class="header-absolute">
            <?php include "include/header.php"; ?>
        </div>
        <div class="hero-content">
            <div class="hero-title">Start Your Tropical Journey</div>
        </div>
    </div>

    <main class="booking-page-main">
        <?php if ($page_message): ?>
            <div class="alert <?php echo $message_type === 'success' ? 'alert-success' : 'alert-danger'; ?>">
                <?php echo htmlspecialchars($page_message); ?>
            </div>
        <?php endif; ?>

        <div class="form-container">
            <form action="include/booking-action.php" method="POST" class="booking-form">
                <div class="form-row">
                    <div class="form-group">
                        <label for="name">Name:</label>
                        <input type="text" id="name" name="naam" placeholder="Enter your name" 
                        <?php if (isset($user_data) && $user_data): ?>
                            value="<?php echo htmlspecialchars($user_data['name']); ?>" readonly
                        <?php endif; ?>
                        required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="email" id="email" name="email" placeholder="Enter your email" 
                        <?php if (isset($user_data) && $user_data): ?>
                            value="<?php echo htmlspecialchars($user_data['email']); ?>" readonly
                        <?php endif; ?>
                        required>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label for="where-to">Where to:</label>
                        <select class="where-to" id="where-to" name="plaats" required>
                            <option value="" disabled selected>Select a destination</option>
                            <?php foreach ($destinations as $dest): ?>
                                <option value="<?php echo htmlspecialchars($dest['plaats']); ?>"><?php echo htmlspecialchars($dest['plaats']); ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="address">Address:</label>
                        <input type="text" id="address" name="adres" placeholder="Enter your address" required>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label for="phone">Phone number:</label>
                        <input type="tel" id="phone" name="telefoonnummer" placeholder="Enter your phone number" required>
                    </div>
                    <div class="form-group">
                        <label for="guests">How many guests:</label>
                        <input type="number" id="guests" name="personen" min="1" placeholder="Enter how many guests" required>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label for="arrivals">Arrivals:</label>
                        <input type="date" id="arrivals" name="arrivals_date" required>
                    </div>
                    <div class="form-group">
                        <label for="leaving">Leaving:</label>
                        <input type="date" id="leaving" name="leaving_date" required>
                    </div>
                </div>
                <div class="form-row submit-row">
                    <input type="submit" value="Submit">
                </div>
            </form>
        </div>

        <div class="destinations-container">
            <?php if (!empty($destinations)): ?>
                <?php foreach ($destinations as $dest): ?>
                    <div class="destination-card">
                        <img src="<?php echo htmlspecialchars($dest['img'] ?? 'assets/img/placeholder.jpg'); ?>" alt="<?php echo htmlspecialchars($dest['plaats'] ?? 'Destination'); ?>" class="card-img">
                        <div class="card-body">
                            <div class="card-title-rating">
                                <h3><?php echo htmlspecialchars($dest['plaats'] ?? 'Location Name'); ?></h3>
                                <span class="rating">
                                    <?php echo htmlspecialchars(str_replace('.', ',', $dest['rating'] ?? '0')); ?>&#9733;
                                </span>
                            </div>
                            <p class="description"><?php echo htmlspecialchars($dest['beschrijving'] ?? 'Description not available.'); ?></p>
                            <p class="price">€<?php echo htmlspecialchars($dest['prijs'] ?? '0.00'); ?></p>
                            <div class="card-links">
                                <a href="#">Book now →</a>
                                <a href="location-info.php?id=<?php echo $dest['id']; ?>">Dive Deeper →</a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>No destinations available at the moment.</p>
            <?php endif; ?>
        </div>
    </main>

    <?php include "include/footer.php"; ?>
</body>
</html> 