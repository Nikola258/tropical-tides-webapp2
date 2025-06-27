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
    <?php include "../include/admin-dashboard-sidebar.php";
    include "../dbcalls/conn.php";
    try {
        $stmt = $conn->prepare("SELECT * FROM user_bookings;");
        $stmt->execute();
        $result = $stmt->fetchAll();
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
        $result = [];
    }
    ?>






    <div class="content">
        <h1>Welcome to the Bookings Dashboard</h1>
        <p>Here you can view and manage all customer flight bookings.</p>
    </div>

    <section class="spacing">
    <?php

    foreach ($result as $key => $value) {
        echo "<div class='booking_spacing'>";
        echo '<div>' . $value['naam'] . '</div>';
        echo '<div>' . $value['email'] . '</div>';
        echo '<div>' . $value['plaats'] . '</div>';
        echo '<div>' . $value['adres'] . '</div>';
        echo '<div>' . $value['telefoonnummer'] . '</div>';
        echo '<div>' . $value['personen'] . '</div>';
        echo '<div>' . $value['arrivals_date'] . '</div>';
        echo '<div>' . $value['leaving_date'] . '</div>';
        echo '<div>' . $value['booking_date'] . '</div>';
        echo '</div>';
?>
        <form action="../include/user_delete.php" method="POST" style="margin-top: 8px;">
        <input type="hidden" name="id" value="<?php echo $value['id']; ?>" >
        <input type="submit" value="Verwijderen">
    </form>
        <?php
    }
        ?>
    </section>

</body>
</html>