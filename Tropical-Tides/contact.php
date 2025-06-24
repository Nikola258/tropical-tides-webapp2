<?php
session_start();
include('dbcalls/conn.php');

$page_message = '';
if (isset($_SESSION['page_message'])) {
    $page_message = $_SESSION['page_message'];
    unset($_SESSION['page_message']);
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Contact - Tropical Tides</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/contact-page.css">
</head>
<body>
    <div class="hero-contact">
        <div class="hero-overlay"></div>
        <div class="header-absolute">
            <?php include "include/header.php"; ?>
        </div>
        <div class="hero-content">
            <div class="hero-title">Contact</div>
        </div>
    </div>
    <div class="section founded">
        <div class="founded-text">
            <h2 style="margin-top:0; font-size:1.4em; font-weight:bold; color:#222;">Contact us</h2>
            <?php if ($page_message): ?>
                <div class="alert" style="padding: 10px; background: #e6f7ff; border-left: 4px solid #00C2FF; margin-bottom: 15px;"><?php echo htmlspecialchars($page_message); ?></div>
            <?php endif; ?>
            <form action="include/contact-action.php" method="post" class="crud-form" style="max-width: 500px;">
                <label for="contact_name">Name:</label>
                <input class="contact-form" type="text" name="contact_name" id="contact_name" required>
                <label for="contact_email">E-mail:</label>
                <input class="contact-form" type="email" name="contact_email" id="contact_email" required>
                <label for="contact_message">Message:</label>
                <textarea name="contact_message" id="contact_message" rows="4" style="width:100%; border-radius:6px; padding:8px;"></textarea>
                <input class="send-button" type="submit" name="contact_submit" value="Submit">
            </form>
        </div>
        <div class="founded-img">
            <img src="https://images.unsplash.com/photo-1519125323398-675f0ddb6308?auto=format&fit=crop&w=800&q=80" alt="Contact">
        </div>
    </div>
    <?php include "include/footer.php"; ?>
</body>
</html> 