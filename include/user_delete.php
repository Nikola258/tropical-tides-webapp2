<?php

include('../dbcalls/conn.php');

$id = $_POST['id'];

$stmt = $conn->prepare("DELETE FROM user_bookings WHERE id=:id;");
$stmt->bindparam(":id", $id);
$stmt->execute();

header(header:'location: ../admin-dashboard-views/bookings.php');