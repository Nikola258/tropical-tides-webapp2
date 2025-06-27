<?php
session_start();
// check of admin is ingelogd, anders terugsturen
// if (!isset($_SESSION['admin_id'])) {
//     header('Location: ../../auth-views/login.php');
//     exit();
// }

include('../dbcalls/conn.php');
$messages_stmt = $conn->prepare("SELECT name, email, message, created_at FROM messages ORDER BY created_at DESC");
$messages_stmt->execute();
$messages = $messages_stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin - Messages</title>
    <link rel="stylesheet" href="../assets/css/dashboard-ui.css">
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
<?php include "../include/admin-dashboard-sidebar.php"; ?>

    <div class="content">
        <div class="admin-dashboard-container">
            <h1>Contactberichten</h1>
            <p>Hieronder zie je alle berichten die via het contactformulier zijn verzonden.</p>

            <?php if (empty($messages)): ?>
                <p>Er zijn nog geen berichten.</p>
            <?php else: ?>
                <?php foreach ($messages as $msg): ?>
                    <div class="crud-item">
                        <p><strong>Van:</strong> <?php echo htmlspecialchars($msg['name']); ?> (<?php echo htmlspecialchars($msg['email']); ?>)</p>
                        <p><strong>Bericht:</strong></p>
                        <p><?php echo nl2br(htmlspecialchars($msg['message'])); ?></p>
                        <small style="display: block; color: #777; margin-top: 5px;">Verzonden op: <?php echo date('d-m-Y H:i', strtotime($msg['created_at'])); ?></small>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>

</body>
</html>