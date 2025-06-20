<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <?php include "include/admin-dashboard-sidebar.php";
    include('./dbcalls/conn.php');
    include('./dbcalls/read.php');
    ?>

    <div class="content">
        <h1>Welcome to the Admin Dashboard.</h1>
        <p>This is your main content area.</p>
    </div>
    <main>
        <section class="column">
            <h1>admin</h1>

            <form action="./include/create.php" method="post">
                <label for="plaats">type hier uw plaats:</label>
                <input type="text" name="plaats" id="plaats" required>

                <label for="beschrijving">Voer hier de beschrijving in</label>
                <input type="text" name="beschrijving" id="beschrijving" required>

                <label for="personen">Voer hier de hoeveelheid personen in</label>
                <input type="text" name="personen" id="personen" required>

                <label for="prijs">type hier uw prijs:</label>
                <input type="text" name="prijs" id="prijs" required>

                <label for="">typ hier je imagelocatie in:</label>
                <input type="text" name="img" id="img">

                <label for="rating">Voer hier de rating in</label>
                <input type="text" name="rating" id="rating" required>

                <label for="datum">Voer hier de datum in</label>
                <input type="date" name="datum" id="datum" required>
                <input type="submit" value="submit">
            </form>
            <form action="./dbcalls/backToMenu.php" method="post">
                <input type="submit" value="terug naar menu">
            </form>

            <?php
            foreach ($result as $key => $value) {
                ?>

                <div>
                    <form action="./include/update.php" method="post">
                        <input type="hidden" name="id" id="" value="<?php echo $value['id']; ?>" >

                        plaats<input type="text" name="plaats" id="" value="  <?php echo $value['plaats']; ?>">

                        beschrijving<input type="text" name="beschrijving" id="" value=" <?php echo $value['beschrijving']; ?>">

                        personen <input type="text" name="personen" id="" value=" <?php echo $value['personen']; ?>">

                        prijs<input type="text" name="prijs" id="" value="  <?php echo $value['prijs']; ?>">

                        img<input type="text" name="img" id="1" value="  <?php echo $value['img']; ?>">

                        rating<input type="text" name="rating" id="" value=" <?php echo $value['rating']; ?>">

                        omschrijving <input type="date" name="datum" id="" value=" <?php echo $value['datum']; ?>">
                        <button type="submit" class="update-button">Update</button>
                    </form>


                    <form action="./include/delete.php" method="POST">
                        <input type="hidden" name="id" id="" value="<?php echo $value['id']; ?>" >
                        <input type="submit" value="delete">
                    </form>
                </div>
                <?php

            }
            ?>

        </section>
    </main>

</body>
</html>