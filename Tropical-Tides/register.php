<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register</title>
    <link rel="stylesheet" href="assets/css/auth-style.css">
    <link rel="stylesheet" href="assets/js/login.js">
    <link href="https://fonts.googleapis.com/css2?family=Inknut+Antiqua&display=swap" rel="stylesheet">
</head>
<body>

<video autoplay muted loop>
    <source src="assets/img/login-background.mp4" type="video/mp4">
    Your browser does not support the video tag.
</video>

<!-- Loginformulier -->
<form method="POST" action="login_handler.php">
    <h2>Register</h2>

    <!-- CSRF bescherming -->
    <input type="hidden" name="csrf_token" value="VEILIGE_TOKEN_HIER">

    <!-- Username -->
    <input type="password" name="password" placeholder="Confirm assword" required value="<?php echo isset($_POST['username']) ? htmlspecialchars($_POST['username']) : ''; ?>">

    <!-- Email -->
    <input type="email" name="email" placeholder="Email Address" required value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''; ?>">

    <!-- Error email -->
    <?php if (isset($errors['email'])): ?>
            <strong><?php echo $errors['email']; ?></strong>
    <?php endif; ?>

    <!-- Password -->
    <input type="password" name="password" placeholder="Password" required>

    <!-- Error password -->
    <?php if (isset($errors['password'])): ?>
            <strong><?php echo $errors['password']; ?></strong>
    <?php endif; ?>

    <!-- Confirm password -->
    <input type="password" name="password" placeholder="Confirm assword" required value="<?php echo isset($_POST['password']) ? htmlspecialchars($_POST['password']) : ''; ?>">


    <!-- Buttons -->
    <div class="button-container">
        <button type="submit" class="login-button">Create</button>
        <button type="button" onclick="window.history.back();" class="back-button">Back</button>
        <div class="register-button" type="button">Need to login? → <a class="register-text" href="login.php">Login</a></div>
    </div>
</form>
</body>
</html>
