<?php
// Prevent direct access
if (!defined('IS_ADMIN_DASHBOARD')) {
    die("This page cannot be accessed directly.");
}

// Get the ID from the URL
$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
if (!$id) {
    $_SESSION['message'] = "Invalid destination ID.";
    $_SESSION['message_type'] = "danger";
    header('Location: admin-dashboard.php?view=destinations');
    exit();
}

// Fetch the destination data
try {
    $stmt = $conn->prepare("SELECT * FROM booking WHERE id = :id");
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    $destination = $stmt->fetch(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    error_log("Fetch destination for edit error: " . $e->getMessage());
    $_SESSION['message'] = "Database error while fetching destination.";
    $_SESSION['message_type'] = "danger";
    header('Location: admin-dashboard.php?view=destinations');
    exit();
}

// If no destination is found
if (!$destination) {
    $_SESSION['message'] = "Destination with ID #{$id} not found.";
    $_SESSION['message_type'] = "danger";
    header('Location: admin-dashboard.php?view=destinations');
    exit();
}
?>

<div class="main-content-header">
    <h1>Edit Destination</h1>
    <p>You are now editing destination #<?php echo htmlspecialchars($id); ?>.</p>
</div>

<div class="card">
    <h2>Edit Details</h2>
    <form class="crud-form" action="include/admin-actions/destination-update.php" method="post">
        <input type="hidden" name="id" value="<?php echo htmlspecialchars($destination['id']); ?>">
        
        <div class="form-row">
            <div class="form-group">
                <label for="plaats">Destination Name:</label>
                <input type="text" name="plaats" id="plaats" value="<?php echo htmlspecialchars($destination['plaats']); ?>" required>
            </div>
            <div class="form-group">
                <label for="prijs">Price per night:</label>
                <input type="number" step="0.01" name="prijs" id="prijs" value="<?php echo htmlspecialchars($destination['prijs']); ?>" required>
            </div>
        </div>
        <div class="form-group">
            <label for="beschrijving">Description:</label>
            <textarea name="beschrijving" id="beschrijving" rows="3" required><?php echo htmlspecialchars($destination['beschrijving']); ?></textarea>
        </div>
        <div class="form-row">
            <div class="form-group">
                <label for="img">Image (URL):</label>
                <input type="text" name="img" id="img" value="<?php echo htmlspecialchars($destination['img']); ?>">
            </div>
            <div class="form-group">
                <label for="rating">Rating (0.0-5.0):</label>
                <input type="number" step="0.1" name="rating" id="rating" min="0" max="5" value="<?php echo htmlspecialchars($destination['rating']); ?>" required>
            </div>
        </div>
        <div class="form-actions">
            <input type="submit" value="Update Destination" class="btn-submit">
            <a href="admin-dashboard.php?view=destinations" class="btn-cancel">Cancel</a>
        </div>
    </form>
</div> 