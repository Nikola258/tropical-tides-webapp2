<?php
include('../dbcalls/conn.php');
$id = $_POST['id'];
$plaats = $_POST['plaats'];
$beschrijving = $_POST['beschrijving'];
$personen = $_POST['personen'];
$prijs = $_POST['prijs'];
$img = $_POST['img'];
$rating = $_POST['rating'];
$datum = $_POST['datum'];


$sql = 'UPDATE booking SET plaats= :plaats, beschrijving= :beschrijving, personen= :personen, prijs= :prijs, img= :img, rating= :rating, datum= :datum WHERE id = :id;';
$stmt = $conn->prepare(query: $sql);
$stmt->bindParam(param:":id", var: $id);
$stmt->bindParam(param:":plaats", var: $plaats);
$stmt->bindParam(":beschrijving", $beschrijving);
$stmt->bindParam(":personen", $personen);
$stmt->bindParam(":prijs", $prijs);
$stmt->bindParam(":img", $img);
$stmt->bindParam(":rating", $rating);
$stmt->bindParam(":datum", $datum);

$stmt->execute();


header("location: ../admin-dashboard.php");