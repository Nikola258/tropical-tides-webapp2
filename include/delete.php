<?php

include('./dbcalls/conn.php');

$id = $_POST['id'];

$stmt = $conn->prepare("DELETE FROM booking WHERE id=:id;");
$stmt->bindparam(":id", $id);
$stmt->execute();

header(header:'location: ../index.php');