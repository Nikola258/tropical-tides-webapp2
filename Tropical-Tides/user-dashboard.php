<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Redirect to login if user is not logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: auth-views/login.php');
    exit();
}

require_once 'dbcalls/conn.php';

// Determine which page to show
$view = $_GET['view'] ?? 'bookings'; // Default to bookings
$view_path = __DIR__ . '/user-dashboard-views/' . basename($view) . '.php';

// Define a constant that can be checked in the included files
define('IS_USER_DASHBOARD', true);
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>User Dashboard - Tropical Tides</title>
    <link rel="stylesheet" href="assets/css/dashboard-ui.css">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <div class="sidebar">
        <div class="sidebar-user-info">
            <span class="user-name"><?php echo htmlspecialchars($_SESSION['user_name'] ?? 'User'); ?></span>
        </div>
        <ul>
            <li><a href="?view=bookings" class="<?php echo ($view === 'bookings') ? 'active' : ''; ?>">Bookings</a></li>
            <li><a href="?view=destinations" class="<?php echo ($view === 'destinations') ? 'active' : ''; ?>">Destinations</a></li>
            <li><a href="?view=messages" class="<?php echo ($view === 'messages') ? 'active' : ''; ?>">Messages</a></li>
            <li><a href="auth-views/logout.php">Logout</a></li>
        </ul>
    </div>
    <div class="main-content">
        <?php
        if (file_exists($view_path)) {
            include $view_path;
        } else {
            echo "<h1>Page not found</h1><p>The requested page could not be found.</p>";
        }
        ?>
    </div>
</body>
</html>