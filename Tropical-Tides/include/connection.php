<?php
$host = 'mariadb';  // This is the service name in docker-compose
$dbname = 'epic-vacationsdb';
$username = 'admin-dashboard-views';
$password = 'admin-dashboard-views';

try {
    $conn = mysqli_connect($host, $username, $password, $dbname);
    
    if (!$conn) {
        throw new Exception("Connection failed: " . mysqli_connect_error());
    }
} catch (Exception $e) {
    die("Database connection failed: " . $e->getMessage());
}

// Function to insert admin user if not exists
function insertAdminIfNotExists() {
    global $conn;
    $admin_email = 'admin@example.com';
    $admin_password = password_hash('password', PASSWORD_DEFAULT);
    $admin_name = 'admin';

    // Check if admin already exists
    $query = "SELECT * FROM users WHERE email = '$admin_email'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) == 0) {
        // Insert admin user
        $insert_query = "INSERT INTO users (email, password, name) VALUES ('$admin_email', '$admin_password', '$admin_name')";
        if (!mysqli_query($conn, $insert_query)) {
            die("Error inserting admin: " . mysqli_error($conn));
        }
        echo "Admin user created successfully!";
    }
}

// Call the function to insert admin
insertAdminIfNotExists();
?> 