
<h1>create</h1>

<?php
include('./db.php');

$plaats = $_POST['plaats'];
$beschrijving = $_POST['beschrijving'];
$personen = $_POST['personen'];
$prijs = $_POST['prijs'];
$img = $_POST['img'];
$rating = $_POST['rating'];
$datum = $_POST['datum'];


$sql = 'INSERT INTO booking(plaats, beschrijving, personen, prijs, img, rating, datum) VALUES (:plaats, :beschrijving, :personen, :prijs, :img, :rating, :datum);';
$stmt = $conn->prepare(query: $sql);
$stmt->bindParam(param:":plaats", var: $plaats);
$stmt->bindParam(":beschrijving", $beschrijving);
$stmt->bindParam(":personen", $personen);
$stmt->bindParam(":prijs", $prijs);
$stmt->bindParam(":img", $img);
$stmt->bindParam(":rating", $rating);
$stmt->bindParam(":datum", $datum);




$stmt->execute();



?>