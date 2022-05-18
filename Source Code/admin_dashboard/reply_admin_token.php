<?php

include('../include/connection.php');

$reply = $_POST['reply'];
$id = $_POST['token_id'];

$sql = "UPDATE admin_request SET reply = '$reply' WHERE id ='$id'";
$res = mysqli_query($con, $sql);

header("location: admin_dashboard.php?type=extraopt&size=99999&subtype=op2");
