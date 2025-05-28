<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register</title>
    <link rel="stylesheet" href="../assets/css/auth-style.css">
    <link href="https://fonts.googleapis.com/css2?family=Inknut+Antiqua&display=swap" rel="stylesheet">
</head>
<body>

<video autoplay muted loop>
    <source src="../assets/img/login-background.mp4" type="video/mp4">
    Your browser does not support the video tag.
</video>

<form method="POST" action="#">
    <h2>Reset password</h2>

    <!-- CSRF Token (static placeholder) -->
    <!-- Voegt een verborgen beveiligingsveld toe aan een formulier -->
    <input type="hidden" name="csrf_token" value="">

    <input type="email" name="email" placeholder="Email Address" required>
    <input type="password" name="password" placeholder="Password" required>
    <input type="password" name="confirm_password" placeholder="Confirm Password" required>

    <!-- Buttons -->
    <div class="button-container">
        <button type="submit" class="login-button">Confirm</button>
        <button type="button" onclick="window.history.back();" class="back-button">Back</button>
        <div class="register-button">
            Password sucessfull? <a class="register-text" href="login.php">Login</a>
        </div>
    </div>
</form>
</body>
</html>
