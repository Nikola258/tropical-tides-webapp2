<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link href="https://fonts.googleapis.com/css2?family=Inknut+Antiqua&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/auth-style.css">
</head>
<body>

<video autoplay muted loop>
    <source src="../assets/img/login-background.mp4" type="video/mp4">
    Your browser does not support the video tag.
</video>

<form method="POST" action="auth.php">
    <h2>Login</h2>

    <!-- CSRF Token (placeholder for now) -->
    <!-- Voegt een verborgen beveiligingsveld toe aan een formulier -->
    <input type="hidden" name="csrf_token" value="">

    <input type="email" name="email" placeholder="Email Address" required>
    <input type="password" name="password" placeholder="Password" required>

    <!-- Remember me -->
    <div class="remember-me">
        <input type="checkbox" name="remember" id="remember">
        <label for="remember">Keep me logged in</label>
    </div>

    <!-- Buttons -->
    <div class="button-container">
        <button type="submit" class="login-button">Login</button>
        <button type="button" onclick="window.history.back();" class="back-button">Back</button>
        <div class="register-button">
            Forgot password? → <a class="register-text" href="reset-password.php">Reset password</a>
        </div>
        <div class="register-button">
            Need to register? → <a class="register-text" href="register.php">Register</a>
        </div>
    </div>
</form>

</body>
</html>
