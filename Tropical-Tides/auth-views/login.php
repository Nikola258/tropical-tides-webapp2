<?php
include("../dbcalls/conn.php");
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <link href="https://fonts.googleapis.com/css2?family=Inknut+Antiqua&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/auth-style.css">
</head>
<body>

<video autoplay muted loop>
    <source src="../assets/img/login-background.mp4" type="video/mp4">
    Your browser does not support the video tag.
</video>

<section class="login-page">
    <form method="POST" action="./auth-logic/auth.php">
        <h1>LOGIN</h1>
        <input type="hidden" name="csrf_token" value="">

        <div>
            <input type="text" name="email" placeholder="Email Address" required>
            <input type="password" name="password" placeholder="Password" required>
        </div>

        <div class="remember-me">
            <input type="checkbox" name="remember" id="remember">
            <label for="remember">Keep me logged in</label>
        </div>

        <div>
            <input class="login-button" type="submit" value="Login" class="input_box">
        </div>

        <div class="button-container">
            <button type="button" onclick="window.history.back();" class="back-button">Back</button>
            <div class="register-button">
                Forgot password? → <a class="register-text" href="reset-password.php">Reset password</a>
            </div>
            <div class="register-button">
                Need to register? → <a class="register-text" href="register.php">Register</a>
            </div>
        </div>
    </form>
</section>

</body>
</html>
