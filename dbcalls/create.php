<?php

$plaats = $_POST['plaats'];
$beschrijving = $_POST['beschrijving'];
$datum = $_POST['datum'];
$personen = $_POST['personen'];
$prijs = $_POST['prijs'];
$img = $_POST['img'];
$rating = $_POST['rating'];

$sql = 'INSERT INTO booking(plaats, beschrijving, datum, personen, prijs, img, rating) VALUES (:plaats, :beschrijving, :datum, :personen, :prijs, :img, :rating);';
$stmt = $conn->prepare(query: $sql);
$stmt->bindParam(param:":plaats", var: $plaats);
$stmt->bindParam(param:":beschrijving", var: $beschrijving);
$stmt->bindParam(":datum", $datum);
$stmt->bindParam(":personen", $personen);
$stmt->bindParam(":prijs", $prijs);
$stmt->bindParam(":img", $img);
$stmt->bindParam(":rating", $rating);




$stmt->execute();
