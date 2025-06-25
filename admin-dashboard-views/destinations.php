<?php
// Prevent direct access
if (!defined('IS_ADMIN_DASHBOARD')) {
    die("This page cannot be accessed directly.");
}

// Handle feedback messages
$message = $_SESSION['message'] ?? null;
$message_type = $_SESSION['message_type'] ?? 'success';
unset($_SESSION['message'], $_SESSION['message_type']);

// Fetch all destinations
$destinations = [];
try {
    $stmt = $conn->prepare("SELECT id, plaats, beschrijving, prijs, rating FROM booking ORDER BY id DESC");
    $stmt->execute();
    $destinations = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "<div class='alert alert-danger'>Failed to retrieve destinations: " . htmlspecialchars($e->getMessage()) . "</div>";
}
?>

<div class="main-content-header">
    <h1>Manage Destinations</h1>
    <p>Add, edit, or remove travel destinations.</p>
</div>

<?php if ($message): ?>
    <div class="alert alert-<?php echo $message_type; ?>">
        <?php echo htmlspecialchars($message); ?>
    </div>
<?php endif; ?>

<!-- Create Destination Form -->
<div class="card">
    <h2>Add New Destination</h2>
    <form class="crud-form" action="include/admin-actions/destination-create.php" method="post">
        <div class="form-row">
            <div class="form-group">
                <label for="plaats">Destination Name:</label>
                <input type="text" name="plaats" id="plaats" required>
            </div>
            <div class="form-group">
                <label for="prijs">Price per night:</label>
                <input type="number" step="0.01" name="prijs" id="prijs" required>
            </div>
        </div>
        <div class="form-group">
            <label for="beschrijving">Description:</label>
            <textarea name="beschrijving" id="beschrijving" rows="3" required></textarea>
        </div>
        <div class="form-row">
            <div class="form-group">
                <label for="img">Image (URL):</label>
                <input type="text" name="img" id="img">
            </div>
            <div class="form-group">
                <label for="rating">Rating (0.0-5.0):</label>
                <input type="number" step="0.1" name="rating" id="rating" min="0" max="5" required>
            </div>
        </div>
        <input type="submit" value="Add Destination" class="btn-submit">
    </form>
</div>


<!-- List of Destinations -->
<div class="table-container card">
    <h2>Existing Destinations</h2>
    <table class="data-table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Price</th>
                <th>Rating</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php if (empty($destinations)): ?>
                <tr>
                    <td colspan="5">No destinations found. Add one using the form above.</td>
                </tr>
            <?php else: ?>
                <?php foreach ($destinations as $dest): ?>
                    <tr>
                        <td>#<?php echo htmlspecialchars($dest['id']); ?></td>
                        <td><?php echo htmlspecialchars($dest['plaats']); ?></td>
                        <td>€<?php echo htmlspecialchars(number_format((float)$dest['prijs'], 2, ',', '.')); ?></td>
                        <td><?php echo htmlspecialchars($dest['rating']); ?></td>
                        <td class="actions">
                            <a href="admin-dashboard.php?view=destination-edit&id=<?php echo $dest['id']; ?>" class="btn-edit">Edit</a>
                            <form action="include/admin-actions/destination-delete.php" method="POST" style="display:inline;">
                                <input type="hidden" name="id" value="<?php echo $dest['id']; ?>">
                                <button type="submit" class="btn-delete" onclick="return confirm('Are you sure you want to delete this destination?');">Delete</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>
</div>