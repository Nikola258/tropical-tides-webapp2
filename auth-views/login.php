<?php
include("../dbcalls/conn.php");
session_start();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="assets/css/style.css">

</head>
<body>

<section class="login_page">
    <h1>login to admin </h1>

    <form method="POST" action="./auth-logic/auth.php">
        <div>
            <input type="text" name="email">
            <input type="text" name="password">
        </div>
        <div class="login_input">
            <input type="submit" value="login" class="input_box">
        </div>
    </form>
</section>

</body>
</html>