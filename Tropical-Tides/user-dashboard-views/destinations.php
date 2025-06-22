<?php
// Prevent direct access to this file.
if (!defined('IS_USER_DASHBOARD')) {
    die("This page cannot be accessed directly. Please go through the user dashboard.");
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="/assets/css/dashboard-ui.css">
</head>
<body>
<?php include "../include/user-dashboard-sidebar.php"; ?>

    <div class="content">
        <div class="main-content-header">
            <h1>Destinations</h1>
            <p>Explore our available destinations.</p>
        </div>

        <div class="table-container">
            <p>Welcome to the Destinations Page.</p>
            <p>Here you can add, update, or remove travel destinations for customers to choose from.</p>
            <!-- Destination content will be added here -->
        </div>
    </div>

</body>
</html>