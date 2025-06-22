<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="assets/css/dashboard-ui.css">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <?php include "include/admin-dashboard-sidebar.php"; ?>
    <div class="content">
        <div class="admin-dashboard-container">
            <h1>Welcome to the Admin Dashboard</h1>
            <p>This is your main content area.</p>

            <main>
                <section class="column">
                    <h2>Boekingen beheren</h2>

                    <form class="crud-form" action="./include/create.php" method="post">
                        <label for="plaats">Plaats:</label>
                        <input type="text" name="plaats" id="plaats" required>

                        <label for="beschrijving">Beschrijving:</label>
                        <input type="text" name="beschrijving" id="beschrijving" required>

                        <label for="personen">Personen:</label>
                        <input type="text" name="personen" id="personen" required>

                        <label for="prijs">Prijs:</label>
                        <input type="text" name="prijs" id="prijs" required>

                        <label for="img">Afbeelding (URL):</label>
                        <input type="text" name="img" id="img">

                        <label for="rating">Rating:</label>
                        <input type="text" name="rating" id="rating" required>

                        <label for="datum">Datum:</label>
                        <input type="date" name="datum" id="datum" required>
                        <input type="submit" value="Toevoegen">
                    </form>
                    <form action="./dbcalls/backToMenu.php" method="post" style="margin-bottom: 24px;">
                        <input type="submit" value="Terug naar menu">
                    </form>

                    <?php
                    include('./dbcalls/conn.php');
                    include('./dbcalls/read.php');
                    foreach ($result as $key => $value) {
                        ?>
                        <div class="crud-item">
                            <form action="./include/update.php" method="post">
                                <input type="hidden" name="id" value="<?php echo $value['id']; ?>" >

                                <label>Plaats</label>
                                <input type="text" name="plaats" value="<?php echo htmlspecialchars($value['plaats']); ?>">

                                <label>Beschrijving</label>
                                <input type="text" name="beschrijving" value="<?php echo htmlspecialchars($value['beschrijving']); ?>">

                                <label>Personen</label>
                                <input type="text" name="personen" value="<?php echo htmlspecialchars($value['personen']); ?>">

                                <label>Prijs</label>
                                <input type="text" name="prijs" value="<?php echo htmlspecialchars($value['prijs']); ?>">

                                <label>Afbeelding (URL)</label>
                                <input type="text" name="img" value="<?php echo htmlspecialchars($value['img']); ?>">

                                <label>Rating</label>
                                <input type="text" name="rating" value="<?php echo htmlspecialchars($value['rating']); ?>">

                                <label>Datum</label>
                                <input type="date" name="datum" value="<?php echo htmlspecialchars($value['datum']); ?>">
                                <button type="submit" class="update-button">Update</button>
                            </form>

                            <form action="./include/delete.php" method="POST" style="margin-top: 8px;">
                                <input type="hidden" name="id" value="<?php echo $value['id']; ?>" >
                                <input type="submit" value="Verwijderen">
                            </form>
                        </div>
                        <?php
                    }
                    ?>

                </section>
            </main>
        </div>
    </div>
</body>
</html>